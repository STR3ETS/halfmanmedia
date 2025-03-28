<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $gebruiker = Auth::user();
        return view('klantenportaal.account', compact('gebruiker'));
    } 
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed'],
        ]);

        $gebruiker = Auth::user();

        if (!Hash::check($request->current_password, $gebruiker->password)) {
            return back()->withErrors(['current_password' => 'Huidige wachtwoord is onjuist.']);
        }

        $gebruiker->password = Hash::make($request->new_password);
        $gebruiker->save();

        return redirect()->back()->with('success_password', 'Wachtwoord succesvol gewijzigd.');
    }
    public function updateContactgegevens(Request $request)
    {
        $request->validate([
            'naam'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $gebruiker = Auth::user();
        $gebruiker->name = $request->input('naam');
        $gebruiker->email = $request->input('email');
        $gebruiker->save();

        return redirect()->back()->with('success_contact', 'Contactgegevens succesvol bijgewerkt.');
    }
}
