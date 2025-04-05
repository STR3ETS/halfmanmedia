@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <style>
        #createTicket-bg {
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
        }
        #createTicket-bg.active {
            opacity: 50%;
            pointer-events: all !important;
        }
        #createTicket-content {
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }
        #createTicket-content.active {
            opacity: 100%;
            pointer-events: all !important;
        }
        #createTicket-overlay {
            pointer-events: none;
        }
    </style>
    <div class="w-full h-screen fixed z-[499] top-0 left-0 flex" id="createTicket-overlay">
        <div id="createTicket-bg" class="flex-1 bg-black opacity-50 transition z-[500]"></div>
        <div id="createTicket-content"
            class="w-[400px] max-w-full px-[2rem] py-[3rem] border-l border-[#ffffff20] flex flex-col gap-[1rem] h-screen bg-white transition z-[501]">
            <h1 class="text-lg text-[#191919] font-bold leading-[1]">Support ticket aanmaken</h1>
            <form id="createTicket-form" action="{{ route('klantenportaal.support.ticket.create') }}" method="POST" class="flex flex-col gap-[0.5rem]">
                @csrf
                <div>
                    <label for="title" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Onderwerp</label>
                    <input type="text" name="title" placeholder="bijv: Website/webshop aanpassingen"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]"/>
                </div>
                <div>
                    <label for="message" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Bericht</label>
                    <textarea name="message" placeholder="Beschrijf zo uitgebreid mogelijk wat er aan de hand is of gedaan moet worden." class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]"></textarea>
                </div>
                <button type="submit"
                    class="mt-[1rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Support ticket aanmaken</button>
            </form>
        </div>
    </div>


    <div class="flex items-center gap-[0.5rem]">
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium opacity-[80%]">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Support</p>
    </div>
    <div id="support" class="flex flex-col gap-[1rem]">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Support</h1>
        <div>
            <h3 class="text-xl text-[#191919] font-bold leading-[1] mb-4">🙋‍♂️ Stel gerust uw vraag!</h3>
            <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px] mb-6">Heb je hulp nodig met je website, webshop of facturatie of wil je aanpassingen door laten voeren? Bekijk hieronder veelgestelde vragen of neem direct contact op.</p>
            <div class="flex flex-col gap-[1rem]">
                <a id="createTicket-button" class="w-fit cursor-pointer px-[1.5rem] py-[0.65rem] rounded-[5px] bg-[#E4AB6C] hover:bg-[#FFF8F0] hover:text-black transition text-[15px] text-[#FFF8F0] font-semibold">Support ticket aanmaken</a>
                <p class="text-[#191919] text-[12px]">Op werkdagen van 09:00 tot 17:00 bereikbaar op: <strong>+31 (0) 6 33 77 02 99</strong></p>
            </div>
        </div>
    </div>
    <div>
        <h2 class="text-2xl text-[#191919] font-bold leading-[1] mb-4 mt-8">Tickets</h2>
        <div class="w-full bg-white rounded-[10px]">
        <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-md text-[#191919] font-bold leading-[1] pl-4 py-5">Ticket ID</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] py-5">Status</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] py-5">Onderwerp</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] pr-4 py-5 text-right">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="cursor-pointer hover:bg-gray-100 transition duration-300 {{ !$loop->last ? 'border-b border-[#ffffff10] border-b-[#19191920] border-b-[1px]' : '' }} text-[#191919]"
                            onclick="window.location.href='{{ route('klantenportaal.ticket.show', $ticket->id) }}'">
                            <td class="py-[1rem] text-[15px] pl-4">{{ $ticket->id }}</td>
                            <td class="py-[1rem]">
                                @if($ticket->status === 'in_behandeling')
                                    <p class="px-2 py-1 bg-orange-100 border-[1px] border-orange-500 text-orange-500 w-fit text-[12px] rounded-lg">
                                        Open
                                    </p>
                                @elseif($ticket->status === 'opgelost')
                                    <p class="px-2 py-1 bg-red-100 border-[1px] border-red-500 text-red-500 w-fit text-[12px] rounded-lg">
                                        Gesloten
                                    </p>
                                @else
                                    <p class="px-2 py-1 bg-gray-100 bg-opacity-10 border-[1px] border-gray-500 text-gray-500 w-fit text-[12px] rounded-lg">
                                        Onbekend
                                    </p>
                                @endif
                            </td>
                            <td class="py-[1rem] text-[15px]"><p class="max-w-[500px]">{{ $ticket->title }}</p></td>
                            <td class="flex justify-end items-center gap-[0.5rem] pr-4">
                                <a href="#" class="cursor-pointer min-w-[30px] min-h-[30px] hover:bg-gray-100 transition rounded-[5px] w-fit flex items-center justify-center">
                                    <lord-icon class="opacity-60"
                                        src="https://cdn.lordicon.com/skkahier.json"
                                        trigger="hover"
                                        colors="primary:#191919"
                                        style="width:20px;height:20px">
                                    </lord-icon>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-[#191919] opacity-80 text-sm">U heeft nog geen support ticket geopend.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full h-auto">
    <h2 class="text-2xl text-[#191919] font-bold leading-[1] -mb-5 mt-8">Veelgestelde vragen</h2>
        <div class="elfsight-app-2174fea6-9523-4755-8f6b-d016f80ce402" data-elfsight-app-lazy></div>
    </div>
    <script>
        function createTicket() {
            document.getElementById('createTicket-form').classList.remove('hidden');
            document.getElementById('createTicket-bg').classList.add('active');
            document.getElementById('createTicket-content').classList.add('active');
        }
        document.getElementById('createTicket-bg').addEventListener('click', function() {
            document.getElementById('createTicket-bg').classList.remove('active');
            document.getElementById('createTicket-content').classList.remove('active');
        });
        document.getElementById('createTicket-button').addEventListener('click', function () {
            createTicket();
        });
    </script>
@endsection