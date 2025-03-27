<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BedrijfsinformatieController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bedrijfsnaam'  => 'required|string|max:255',
            'branche'       => 'required|string|max:255',
            'omschrijving'  => 'required|string',
            'kvk'           => 'required|string|max:50',
        ]);

        $user = Auth::user();

        $user->update([
            'bedrijfsnaam'  => $request->bedrijfsnaam,
            'branche'       => $request->branche,
            'omschrijving'  => $request->omschrijving,
            'kvk'           => $request->kvk,
        ]);

        return redirect()->back()->with('success', 'Bedrijfsinformatie succesvol opgeslagen.');
    }
}

