@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <div class="flex items-center gap-[0.5rem]">
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium opacity-[80%]">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Handleiding</p>
    </div>
    <div id="handleiding" class="flex flex-col gap-[1rem]">
        <div>
            <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Handleiding</h1>
            <h2 class="text-xl text-[#191919] font-bold leading-[1] mb-4">📝 Welkom bij de handleidingen!</h2>
            <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px]">Hier vind je uitleg, stappenplannen en video's die je helpen bij het beheren van je website, webshop of eventuele vragen die je hebt.</p>
        </div>
    </div>
@endsection