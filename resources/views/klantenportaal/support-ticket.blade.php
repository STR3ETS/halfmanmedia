@extends('layouts.dashboard')
@section('title', 'Support Ticket')
@section('content')
    <div class="flex items-center gap-[0.5rem]">
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium opacity-[80%]">/</p>
        <a href="/klantenportaal/support" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Support</a>
        <p class="text-[14px] text-[#191919] font-medium">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Ticket</p>
    </div>
    <div id=ticket>
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-2">Onderwerp: {{ $ticket->title }}</h1>
        <h2 class="text-lg text-[#191919] font-semibold leading-[1] opacity-50 mb-4">Ticket ID: {{ $ticket->id }}</h2>
        @if($ticket->status !== 'opgelost')
            <div class="max-w-[500px] border-[1px] transition cursor-pointer bg-white p-[1.5rem] rounded-[10px]">
                <form action="{{ route('klantenportaal.support.message', $ticket->id) }}" method="POST" class="flex flex-col gap-[0.5rem]">
                    @csrf
                    <div>
                        <label for="message" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Extra bericht toevoegen</label>
                        <textarea name="message" placeholder="Beschrijf zo uitgebreid mogelijk wat er aan de hand is of gedaan moet worden." class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]"></textarea>
                    </div>
                    <button type="submit"
                        class="mt-[1rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Toevoegen</button>
                </form>
            </div>
        @else
        <p class="text-red-500 text-sm font-semibold mb-4">Deze ticket is gesloten<br><span class="text-xs font-sembold text-[#191919]">Klik <a href="/klantenportaal/support" class="underline">hier</a> om terug te keren.</span></p>
        @endif
    </div>
    <div class="flex flex-col gap-[0.5rem]">
        <h2 class="text-2xl text-[#191919] font-bold leading-[1] mb-2">Berichten</h2>
        <div class="p-4 border-[1px] border-gray-300 rounded-[10px]">
            <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px]"><strong>{{ $ticket->user->name }}</strong> op {{ $ticket->created_at->format('d-m-Y H:i') }}</p>
            <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px] mt-2">{{ $ticket->message }}</p>
        </div>
        @foreach ($ticket->messages as $message)
            <div class="p-4 border-[1px] border-gray-300 rounded-[10px]">
                <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px]"><strong>{{ $message->user->name }}</strong> op {{ $message->created_at->format('d-m-Y H:i') }}</p>
                <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px] mt-2">{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <!-- {{ $ticket->title }}
    {{ $ticket->message }} -->
@endsection