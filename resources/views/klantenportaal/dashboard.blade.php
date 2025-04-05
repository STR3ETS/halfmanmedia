@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <div class="flex items-center gap-[0.5rem]">
        <a href="#" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Home</p>
    </div>

    <div>
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">👋 Goededag, {{ $gebruiker->name }}</h1>
        <p class="text-[#191919] opacity-80 max-w-[25rem] text-[15px] mb-4">Dit is jouw centrale plek voor alles rondom jouw project bij HalfmanMedia. Hulp nodig? We staan voor je klaar.</p>
        <div class="flex flex-col gap-[0.5rem]">
            @foreach($offertes as $offerte)
                @if($offerte->status === 'Meer gegevens nodig')
                    <p class="px-2 py-1 bg-orange-100 border-[1px] border-orange-500 text-orange-500 w-fit text-[12px] rounded-lg font-semibold">
                        🔔 Voor offertenummer {{ $offerte->id }} hebben wij nog wat enkele informatie van u nodig.
                    </p>
                @elseif($offerte->status === 'Te ondertekenen')
                    <p class="px-2 py-1 bg-orange-100 border-[1px] border-orange-500 text-orange-500 w-fit text-[12px] rounded-lg font-semibold">
                        🔔 Uw offerte met offertenummer {{ $offerte->id }} staat voor u klaar.
                    </p>
                @endif
            @endforeach
        </div>
    </div>

    <div id="offertes">
        <h2 class="text-2xl text-[#191919] font-bold leading-[1] mb-4 mt-2">Offertes</h2>
        <div class="bg-white rounded-[10px]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-md text-[#191919] font-bold leading-[1] pl-4 py-5">Offertenummer</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] py-5">Status</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] py-5">Laatste update</th>
                        <th class="text-md text-[#191919] font-bold leading-[1] pr-4 py-5 text-right">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offertes as $offerte)
                        <tr class="cursor-pointer hover:bg-gray-100 transition duration-300 {{ !$loop->last ? 'border-b border-[#ffffff10] border-b-[#19191920] border-b-[1px]' : '' }} text-[#191919]" 
                            onclick="window.location.href='{{ route('offerte.show', $offerte->id) }}'">
                            <td class="py-[1rem] text-[15px] pl-4">2025{{ $offerte->id }}</td>
                            <td class="py-[1rem]">
                                @if($offerte->status === 'In behandeling')
                                    <p class="px-2 py-1 bg-orange-100 border-[1px] border-orange-500 text-orange-500 w-fit text-[12px] rounded-lg">
                                        In behandeling
                                    </p>
                                @elseif($offerte->status === 'Te ondertekenen')
                                    <p class="px-2 py-1 bg-cyan-100 border-[1px] border-cyan-500 text-cyan-500 w-fit text-[12px] rounded-lg">
                                        <strong>Uw offerte staat klaar!</strong> Bekijk hem nu
                                    </p>
                                @elseif($offerte->status === 'Ondertekend')
                                    <p class="px-2 py-1 bg-green-100 border-[1px] border-green-500 text-green-500 w-fit text-[12px] rounded-lg">
                                        Ondertekend
                                    </p>
                                @else
                                    <div class="flex items-center gap-[0.5rem] relative">
                                        <lord-icon class="absolute z-[1] -left-6"
                                            src="https://cdn.lordicon.com/keaiyjcx.json"
                                            trigger="loop"
                                            delay="5000"
                                            colors="primary:#e83151"
                                            style="width:20px;height:20px">
                                        </lord-icon>
                                        <p class="px-2 py-1 bg-[#E83151] bg-opacity-10 border-[1px] border-[#E83151] text-[#E83151] w-fit text-[12px] rounded-lg">
                                            Klik om ontbrekende gegevens toe te voegen
                                        </p>
                                    </div>
                                @endif
                            </td>
                            <td class="py-[1rem] text-[15px]">{{ $offerte->updated_at }}</td>
                            <td class="flex justify-end mt-[5%] gap-[0.5rem] pr-4">
                                <a href="#" class="cursor-not-allowed min-w-[30px] min-h-[30px] hover:bg-gray-100 transition rounded-[5px] w-fit flex items-center justify-center">
                                    <lord-icon class="opacity-40"
                                        src="https://cdn.lordicon.com/yrlmakse.json"
                                        colors="primary:#191919"
                                        style="width:20px;height:20px">
                                    </lord-icon>
                                </a>
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
                            <td colspan="3" class="px-4 py-4 text-[#191919] opacity-80 text-sm">U heeft nog geen factuur aangevraagd.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const greetings = [
            'Hallo',       // Nederlands
            'Hello',       // Engels
            'Hola',        // Spaans
            'Bonjour',     // Frans
            'Ciao',        // Italiaans
            'Olá',         // Portugees
            'Привет',      // Russisch
            'Merhaba'      // Turks
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

        document.getElementById('task-contactgegevens').addEventListener('click', function() {
            document.getElementById('contactgegevens-bg').classList.add('active');
            document.getElementById('contactgegevens-content').classList.add('active');
        });
        document.getElementById('contactgegevens-bg').addEventListener('click', function() {
            document.getElementById('contactgegevens-bg').classList.remove('active');
            document.getElementById('contactgegevens-content').classList.remove('active');
        });
    </script>
@endsection