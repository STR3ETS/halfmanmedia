<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactgegevensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'naam'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->update([
            'name'  => $request->naam,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Contactgegevens succesvol opgeslagen.');
    }
}

