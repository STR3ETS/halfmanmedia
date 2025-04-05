<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestandenController extends Controller
{
    public function index()
    {
        $gebruiker = Auth::user();
        return view('klantenportaal.bestanden', compact('gebruiker'));
    } 
}
