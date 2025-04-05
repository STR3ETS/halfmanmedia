<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offerte;
use App\Http\Controllers\OfferteController;
use App\Http\Controllers\OfferteAanvullenController;
use App\Http\Controllers\FacturatieController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BestandenController;
use App\Http\Controllers\HandleidingController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\AuthController;


// PAGINA'S
Route::get('/', function () { return view('welcome'); });
Route::get('/website', function () { return view('website'); });
Route::get('/webshop', function () { return view('webshop'); });
// EINDE PAGINA'S


// KLANTENPORTAAL
Route::get('/klantenportaal/login', [AuthController::class, 'index'])->name('klantenportaal.login');
Route::post('/klantenportaal/login', [AuthController::class, 'login'])->name('klantenportaal.login.submit');
Route::get('/login', function () { return redirect()->route('klantenportaal.login'); })->name('login');

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


Route::get('/klantenportaal/offerte/{id}', [OfferteController::class, 'show'])->name('offerte.show');
Route::post('/klantenportaal/offerte/{id}/update', [OfferteAanvullenController::class, 'update'])->middleware('auth')->name('offerte.update');


Route::get('/klantenportaal/facturatie', [FacturatieController::class, 'index'])->middleware('auth')->name('klantenportaal.facturatie');


Route::get('/klantenportaal/bestanden', [BestandenController::class, 'index'])->middleware('auth')->name('klantenportaal.bestanden');


Route::get('/klantenportaal/handleiding', [HandleidingController::class, 'index'])->middleware('auth')->name('klantenportaal.handleiding');


Route::get('/klantenportaal/support', [SupportController::class, 'index'])->middleware('auth')->name('klantenportaal.support');
Route::post('/klantenportaal/support/ticket/create', [SupportController::class, 'create'])->middleware('auth')->name('klantenportaal.support.ticket.create');
Route::post('/klantenportaal/support/{ticket}/message', [SupportController::class, 'addMessage'])->middleware('auth')->name('klantenportaal.support.message');
Route::get('/klantenportaal/support/ticket/{id}', [SupportController::class, 'show'])->middleware('auth')->name('klantenportaal.ticket.show');


Route::get('/klantenportaal/account', [AccountController::class, 'index'])->middleware('auth')->name('klantenportaal.account');
Route::post('/klantenportaal/account/wachtwoord-wijzigen', [AccountController::class, 'updatePassword'])->middleware('auth')->name('klantenportaal.account.passwordupdate');
Route::post('/klantenportaal/account/contactgegevens-wijzigen', [AccountController::class, 'updateContactgegevens'])->middleware('auth')->name('klantenportaal.account.contactgegevensupdate');

Route::post('/logout', function (Request $request) {
    \Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/klantenportaal/login');
})->name('logout');
// EINDE KLANTENPORTAAL


// OFFERTE
Route::get('/gratis-offerte', [OfferteController::class, 'index'])->name('offerte.index');
Route::post('/gratis-offerte', [OfferteController::class, 'store'])->name('offerte.store');
Route::get('/gratis-offerte/gegevens', [OfferteController::class, 'gegevens'])->name('offerte.gegevens');
Route::post('/gratis-offerte/gegevens', [OfferteController::class, 'gegevensStore'])->name('offerte.gegevens.store');
Route::get('/gratis-offerte/overzicht', [OfferteController::class, 'finish'])->name('offerte.finish');
Route::post('/gratis-offerte/verzenden', [OfferteController::class, 'verzenden'])->name('offerte.send');
// EINDE OFFERTE