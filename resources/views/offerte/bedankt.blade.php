@extends('layouts.offerte')
@section('title', 'Aanvraag verstuurd')
@section('content')
    <div class="w-full h-screen flex items-center justify-center bg-[#241B12] text-white px-4">
        <div class="text-center max-w-[600px] flex flex-col items-center gap-[2rem]">
            <h1 class="text-3xl sm:text-4xl font-bold text-[#E4AB6C]">Aanvraag succesvol verstuurd</h1>
            <div class="-mt-[0.5rem]">
                <h2 class="text-xl sm:text-2xl font-semibold mb-[0.5rem]">
                    Wat nu?
                </h2>
                <p class="text-base text-[15px] leading-[2] opacity-80">
                    Je ontvangt van ons binnen enkele seconden een e-mail met jouw inloggegevens.<br>Hiermee kan je inloggen in het klantenportaal.
                </p>
            </div>
            <div class="flex justify-center items-center gap-4 flex-wrap">
                <a href="/klantenportaal/login"
                   class="bg-[#E4AB6C] hover:bg-[#FFF8F0] hover:text-black text-white font-medium px-[1.5rem] py-[0.75rem] rounded transition">
                    Klantenportaal
                </a>
                <a href="/" class="text-white opacity-80 hover:opacity-100 transition font-medium">Afsluiten</a>
            </div>
        </div>
    </div>
@endsection
