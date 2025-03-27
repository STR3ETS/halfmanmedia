@extends('layouts.offerte')
@section('title', 'Offerte Overzicht')
@section('content')
    <a href="/" class="fixed z-[1] left-[1.5rem] top-[1.5rem]">
        <img src="/assets/halfmanmedia-logo-gold-white.png" alt="HalfmanMedia" class="max-w-[30px]">
    </a>
    <div class="w-full h-screen flex items-center justify-center">
        <div class="bg-white rounded-[20px] p-[1.5rem] min-w-[400px] w-[90%] max-w-[500px] flex flex-col gap-[1rem]">
            <div>
                <h1 class="text-xl font-medium"><span class="text-[#E4AB6C] mr-2 mb-2">3.</span>Gegevens ter controle</h1>
            </div>
            <form action="{{ route('offerte.send') }}" method="POST">
                @csrf
                <div>
                    <div class="w-full flex items-center justify-between pb-[1rem] border-b text-base font-medium"><span class="opacity-50">Gekozen dienst:</span> {{ ucfirst($data['dienst']) }}</div>
                    <div class="w-full flex items-center justify-between py-[1rem] border-b text-base font-medium"><span class="opacity-50">Contactpersoon:</span> {{ $data['first_name'] }} {{ $data['last_name'] }}</div>
                    <div class="w-full flex items-center justify-between py-[1rem] border-b text-base font-medium"><span class="opacity-50">E-mailadres:</span> {{ $data['email'] }}</div>
                    <div class="w-full flex items-center justify-between pt-[1rem] text-base font-medium"><span class="opacity-50">Telefoonnummer:</span> {{ $data['phone'] }}</div>
                </div>
                <button type="submit"
                    class="fixed z-[1] bottom-[1.5rem] left-0 right-0 ml-auto mr-auto px-[3rem] py-[0.75rem] w-fit bg-[#E4AB6C] hover:bg-[#FFF8F0] hover:text-black transition rounded-[5px] text-base font-medium text-white">
                    Aanvraag versturen
                </button>
            </form>
        </div>
    </div>
    <a href="/gratis-offerte/gegevens" class="fixed z-[1] left-[1.5rem] bottom-[1rem]">
        <lord-icon
            src="https://cdn.lordicon.com/whtfgdfm.json"
            trigger="hover"
            colors="primary:#ffffff"
            style="width:30px;height:30px;transform:rotate(180deg);">
        </lord-icon>
    </a>
@endsection
