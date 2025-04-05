<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Offerte;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use OpenAI\Laravel\Facades\OpenAI;

class OfferteController extends Controller
{
    public function index()
    {
        $selectedDienst = session('dienst');
        
        return view('offerte.start', compact('selectedDienst'));
    }    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dienst' => 'required|in:website,webshop',
        ]);

        session(['dienst' => $validated['dienst']]);
        return redirect()->route('offerte.gegevens');
    }

    public function gegevens()
    {
        $dienst = session('dienst');
        $formData = [
            'first_name' => session('first_name'),
            'last_name' => session('last_name'),
            'email' => session('email'),
            'phone' => session('phone'),
            'kvk' => session('kvk'),
        ];

        return view('offerte.gegevens', compact('dienst', 'formData'));
    }      

    public function gegevensStore(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
        ]);

        session($validated);
        return redirect()->route('offerte.finish');
    }

    public function finish()
    {
        $data = [
            'dienst'     => session('dienst'),
            'first_name' => session('first_name'),
            'last_name'  => session('last_name'),
            'email'      => session('email'),
            'phone'      => session('phone'),
        ];

        return view('offerte.finish', compact('data'));
    }

    public function verzenden()
    {
        $data = [
            'dienst'     => session('dienst'),
            'first_name' => session('first_name'),
            'last_name'  => session('last_name'),
            'email'      => session('email'),
            'phone'      => session('phone'),
        ];

        Offerte::create($data);
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            $password = Str::random(16);
            User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($password),
            ]);
            \Mail::to($data['email'])->send(new \App\Mail\AccountCreated(
                $data['first_name'] . ' ' . $data['last_name'],
                $data['email'],
                $password
            ));
        }   

        session()->forget(['dienst', 'first_name', 'last_name', 'email', 'phone']);
        return view('offerte.bedankt', ['name' => $data['first_name']]);
    }

    public function show($id)
    {
        $offerte = Offerte::findOrFail($id);
        $gebruiker = Auth::user();
        $statusContactgegevens = [ 'contactgegevens' => $gebruiker->name && $gebruiker->email !== null ];
        $statusBedrijfsinformatie = [ 'bedrijfsinformatie' => $offerte->bedrijfsnaam && $offerte->bedrijfsomschrijving && $offerte->kvk && $offerte->vestigingsadres !== null ];
        $statusDoel = [ 'doel' => $offerte->doel && $offerte->doelgroep && $offerte->extra_wensen !== null ];
        $statusBudget = [ 'budget' => $offerte->budget && $offerte->verwachting && $offerte->flexibel !== null ];
        return view('klantenportaal.offerte-gegevens', compact('gebruiker', 'offerte', 'statusContactgegevens', 'statusBedrijfsinformatie', 'statusDoel', 'statusBudget'));
    }
}
