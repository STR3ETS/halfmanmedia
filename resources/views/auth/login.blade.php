@extends('layouts.offerte') {{-- Of je eigen layout --}}
@section('title', 'Inloggen klantenportaal')
@section('content')
    <a href="/" class="fixed z-[1] left-[1.5rem] top-[1.5rem]">
        <img src="/assets/halfmanmedia-logo-gold-white.png" alt="HalfmanMedia" class="max-w-[30px]">
    </a>
    <div class="w-full h-screen flex flex-col items-center justify-center text-white px-4">
        <h1 id="greeting" class="text-2xl font-bold text-center text-white mb-[1.5rem] transition">Hallo!</h1>
        <form method="POST" action="{{ route('klantenportaal.login.submit') }}" class="bg-white rounded-[20px] p-[1.5rem] max-w-[400px] w-full text-black flex flex-col gap-[0.5rem]">
            @csrf
            @error('email')
                <p class="text-red-600 text-sm w-full p-[0.75rem] bg-red-200 border-red-600 border-[1px] rounded-[5px]">Helaas, deze gegevens kloppen niet.</p>
            @enderror
            <input type="email" name="email" placeholder="E-mailadres" required
                value="{{ old('email') }}"
                class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none" />
            <input type="password" name="password" placeholder="Wachtwoord" required
                class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none mb-4" />
            <button type="submit"
                    class="w-full bg-[#E4AB6C] text-white font-semibold py-[0.75rem] rounded hover:bg-[#241B12] transition mb-[0.25rem]">
                Inloggen
            </button>
            <div class="w-full flex items-center justify-between">
                <a href="/gratis-offerte" class="text-[14px] opacity-50 text-center text-[#191919] hover:underline">Account aanmaken</a>
                <a href="#" class="text-[14px] opacity-50 text-center text-[#191919] hover:underline">Wachtwoord vergeten?</a>
            </div>
        </form>
    </div>
    <script>
        const greetings = [
            'Hallo!',       // Nederlands
            'Hello!',       // Engels
            'Hola!',        // Spaans
            'Bonjour!',     // Frans
            'Ciao!',        // Italiaans
            'Olá!',         // Portugees
            'Привет!',      // Russisch
            'Merhaba!'      // Turks
        ];

        let index = 0;
        const greetingEl = document.getElementById('greeting');

        setInterval(() => {
            // Fade out
            greetingEl.classList.remove('opacity-100');
            greetingEl.classList.add('opacity-0');

            setTimeout(() => {
                // Change text after fade out
                index = (index + 1) % greetings.length;
                greetingEl.textContent = greetings[index];

                // Fade back in
                greetingEl.classList.remove('opacity-0');
                greetingEl.classList.add('opacity-100');
            }, 500); // match with .duration-500
        }, 3000); // every 3 seconds
    </script>
@endsection
