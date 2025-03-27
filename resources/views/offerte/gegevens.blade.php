@extends('layouts.offerte')
@section('title', 'Offerte Gegevens')
@section('content')
    <a href="/" class="fixed z-[1] left-[1.5rem] top-[1.5rem]">
        <img src="/assets/halfmanmedia-logo-gold-white.png" alt="HalfmanMedia" class="max-w-[30px]">
    </a>
    <form action="{{ route('offerte.gegevens.store') }}" method="POST" class="w-full h-screen flex items-center justify-center">
        @csrf
        <div class="bg-white rounded-[20px] p-[1.5rem] min-w-[400px] flex flex-col gap-[1rem] w-[90%] max-w-[500px]">
            <h1 class="text-xl font-medium"><span class="text-[#E4AB6C] mr-2">2.</span>Gegevens</h1>
            <input type="text" name="first_name" placeholder="Voornaam" required class="w-full px-[0.75rem] py-[0.75rem] rounded-[5px] border focus:border-[#E4AB6C] outline-none"
                value="{{ old('first_name', $formData['first_name'] ?? '') }}"/>
            <input type="text" name="last_name" placeholder="Achternaam" required class="w-full px-[0.75rem] py-[0.75rem] rounded-[5px] border focus:border-[#E4AB6C] outline-none"
                value="{{ old('last_name', $formData['last_name'] ?? '') }}"/>
            <input type="email" name="email" placeholder="E-mailadres" required class="w-full px-[0.75rem] py-[0.75rem] rounded-[5px] border focus:border-[#E4AB6C] outline-none"
                value="{{ old('email', $formData['email'] ?? '') }}"/>
            <input type="tel" name="phone" placeholder="Telefoonnummer" required class="w-full px-[0.75rem] py-[0.75rem] rounded-[5px] border focus:border-[#E4AB6C] outline-none"
                value="{{ old('phone', $formData['phone'] ?? '') }}"/>
        </div>
        <button type="submit"
            class="fixed z-[1] bottom-[1.5rem] left-0 right-0 ml-auto mr-auto px-[3rem] py-[0.75rem] w-fit bg-[#E4AB6C] hover:bg-[#FFF8F0] hover:text-black transition rounded-[5px] text-base font-medium text-white">
            Volgende
        </button>
    </form>
    <a href="{{ route('offerte.index') }}" id="backButton" class="fixed z-[1] left-[1.5rem] bottom-[1rem]">
        <lord-icon
            src="https://cdn.lordicon.com/whtfgdfm.json"
            trigger="hover"
            colors="primary:#ffffff"
            style="width:30px;height:30px;transform:rotate(180deg);">
        </lord-icon>
    </a>
@endsection
