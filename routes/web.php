<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offerte;
use App\Http\Controllers\OfferteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BedrijfsinformatieController;
use App\Http\Controllers\ContactgegevensController;

Route::get('/', function () { return view('welcome'); });
Route::get('/website', function () { return view('website'); });
Route::get('/webshop', function () { return view('webshop'); });


Route::get('/klantenportaal/login', [AuthController::class, 'index'])->name('klantenportaal.login');
Route::post('/klantenportaal/login', [AuthController::class, 'login'])->name('klantenportaal.login.submit');

Route::get('/klantenportaal/dashboard', function () {
    $gebruiker = Auth::user();
    $offertes = Offerte::where('email', $gebruiker->email)->get();
    $bedrijfsinfoCompleet = 
        $gebruiker->bedrijfsnaam && 
        $gebruiker->branche && 
        $gebruiker->omschrijving && 
        $gebruiker->kvk;
        return view('klantenportaal.dashboard', compact('gebruiker', 'offertes', 'bedrijfsinfoCompleet'));
    })->middleware('auth')->name('klantenportaal.dashboard');

Route::post('/logout', function (Request $request) {
    \Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/klantenportaal/login');
})->name('logout');

Route::post('/klantenportaal/bedrijfsinformatie/opslaan', [BedrijfsinformatieController::class, 'store'])->middleware('auth')->name('bedrijfsinformatie.opslaan');
Route::post('/klantenportaal/contactgegevens/opslaan', [ContactgegevensController::class, 'store'])->middleware('auth')->name('contactgegevens.opslaan');


Route::get('/gratis-offerte', [OfferteController::class, 'index'])->name('offerte.index');
Route::post('/gratis-offerte', [OfferteController::class, 'store'])->name('offerte.store');
Route::get('/gratis-offerte/gegevens', [OfferteController::class, 'gegevens'])->name('offerte.gegevens');
Route::post('/gratis-offerte/gegevens', [OfferteController::class, 'gegevensStore'])->name('offerte.gegevens.store');
Route::get('/gratis-offerte/overzicht', [OfferteController::class, 'finish'])->name('offerte.finish');
Route::post('/gratis-offerte/verzenden', [OfferteController::class, 'verzenden'])->name('offerte.send');
