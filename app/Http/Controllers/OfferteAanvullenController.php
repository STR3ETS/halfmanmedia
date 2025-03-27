<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offerte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OfferteAanvullenController extends Controller
{
    public function update(Request $request, $id)
    {
        $offerte = Offerte::findOrFail($id);

        if ($request->has('bedrijfsnaam')) {
            $offerte->bedrijfsnaam = $request->input('bedrijfsnaam');
            $offerte->bedrijfsomschrijving = $request->input('bedrijfsomschrijving');
            $offerte->kvk = $request->input('kvk');
            $offerte->vestigingsadres = $request->input('vestigingsadres');
        }

        if ($request->has('doel')) {
            $offerte->doel = $request->input('doel');
            $offerte->doelgroep = $request->input('doelgroep');
            $offerte->extra_wensen = $request->input('extra-wensen');
        }

        if ($request->has('budget')) {
            $offerte->budget = $request->input('budget');
            $offerte->verwachting = $request->input('verwachting');
            $offerte->flexibel = $request->input('flexibel') ?? false;
        }

        $offerte->save();

        $gebruiker = Auth::user();
        $this->checkOfferteStatus($offerte, $gebruiker);

        return redirect()->back()->with('success', 'Offerte bijgewerkt!');
    }

    private function checkOfferteStatus(Offerte $offerte, $gebruiker)
    {
        $isContactgegevensCompleet = $gebruiker->name && $gebruiker->email;
        $isBedrijfsinfoCompleet = $offerte->bedrijfsnaam && $offerte->bedrijfsomschrijving && $offerte->kvk && $offerte->vestigingsadres;
        $isDoelCompleet = $offerte->doel && $offerte->doelgroep && $offerte->extra_wensen;
        $isBudgetCompleet = $offerte->budget && $offerte->verwachting && $offerte->flexibel !== null;

        if ($isContactgegevensCompleet && $isBedrijfsinfoCompleet && $isDoelCompleet && $isBudgetCompleet) {
            $offerte->status = 'In behandeling';
        } else {
            $offerte->status = 'Meer gegevens nodig';
        }

        $offerte->save();
    }
}
