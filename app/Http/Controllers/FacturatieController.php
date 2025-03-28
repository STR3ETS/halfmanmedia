<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturatieController extends Controller
{
    public function index()
    {
        $gebruiker = Auth::user();
        return view('klantenportaal.facturatie', compact('gebruiker'));
    } 
}
