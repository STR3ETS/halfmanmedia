@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <style>
        #bedrijfsinformatie-bg, #contactgegevens-bg {
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
        }
        #bedrijfsinformatie-bg.active, #contactgegevens-bg.active {
            opacity: 50%;
            pointer-events: all !important;
        }
        #bedrijfsinformatie-content, #contactgegevens-content {
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }
        #bedrijfsinformatie-content.active, #contactgegevens-content.active {
            opacity: 100%;
            pointer-events: all !important;
        }
        #bedrijfsinformatie-overlay, #contactgegevens-overlay {
            pointer-events: none;
        }
    </style>
    <div class="w-full h-screen fixed z-[499] top-0 left-0 flex" id="contactgegevens-overlay">
        <div id="contactgegevens-bg" class="flex-1 bg-black opacity-50 transition z-[500]"></div>
        <div id="contactgegevens-content"
            class="w-[400px] max-w-full px-[2rem] py-[3rem] border-l border-[#ffffff20] flex flex-col gap-[1rem] h-screen bg-white transition z-[501]">
            <h1 class="text-lg text-[#191919] font-bold leading-[1]">Contactgegevens</h1>
            <form action="{{ route('contactgegevens.opslaan') }}" method="POST" class="flex flex-col gap-[0.5rem]">
                @csrf
                <input type="text" name="naam" placeholder="Naam" required
                    value="{{ old('name', $gebruiker->name) }}"
                    class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                <input type="email" name="email" placeholder="E-mailadres" required
                    value="{{ old('email', $gebruiker->email) }}"
                    class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                <button type="submit"
                    class="mt-[0.5rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
        </div>
    </div>
    <div class="w-full h-screen fixed z-[499] top-0 left-0 flex" id="bedrijfsinformatie-overlay">
        <div id="bedrijfsinformatie-bg" class="flex-1 bg-black opacity-50 transition z-[500]"></div>
        <div id="bedrijfsinformatie-content"
            class="w-[400px] max-w-full px-[2rem] py-[3rem] border-l border-[#ffffff20] flex flex-col gap-[1rem] h-screen bg-white transition z-[501]">
            <h1 class="text-lg text-[#191919] font-bold leading-[1]">Bedrijfsinformatie</h1>
            <form action="{{ route('bedrijfsinformatie.opslaan') }}" method="POST" class="flex flex-col gap-[0.5rem]">
                @csrf
                <input type="text" name="bedrijfsnaam" placeholder="Bedrijfsnaam" required
                    value="{{ old('bedrijfsnaam', $gebruiker->bedrijfsnaam) }}"
                    class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                <input type="text" name="branche" placeholder="Type branche" required
                    value="{{ old('branche', $gebruiker->branche) }}"
                    class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                <textarea name="omschrijving" placeholder="Bedrijfsomschrijving" required
                    class="w-full min-h-[200px] max-h-[400px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]">{{ old('omschrijving', $gebruiker->omschrijving) }}</textarea>
                <input type="text" name="kvk" placeholder="KVK-nummer" required
                    value="{{ old('kvk', $gebruiker->kvk) }}"
                    class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                <button type="submit"
                    class="mt-[0.5rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
        </div>
    </div>

    <div class="flex items-center gap-[0.5rem]">
        <a href="#" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Home</p>
    </div>
    <div id="tasks">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] -mb-[0.5rem]">
            Aan te leveren gegevens
        </h1>
        <div class="flex flex-col gap-[0.5rem] mt-[1.5rem]">
            <div id="task-contactgegevens" class="border-[1px] border-gray-200 hover:border-[#e4ab6c] transition cursor-pointer w-full p-[1rem] rounded-[10px] bg-white flex items-center justify-between">
                <h2 class="text-lg text-[#191919] font-bold leading-[1]">Contactgegevens</h2>
                <lord-icon
                    src="https://cdn.lordicon.com/lomfljuq.json"
                    colors="primary:#08A045"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div id="task-bedrijfsinformatie" class="border-[1px] {{ $bedrijfsinfoCompleet ? 'border-gray-200 hover:border-[#e4ab6c]' : 'border hover:border-[#e4ab6c]' }} transition cursor-pointer w-full p-[1rem] rounded-[10px] bg-white flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    <h2 class="text-lg text-[#191919] font-bold leading-[1]">Bedrijfsinformatie</h2>
                    @if(!$bedrijfsinfoCompleet)
                        <lord-icon
                            src="https://cdn.lordicon.com/keaiyjcx.json"
                            trigger="loop"
                            delay="5000"
                            colors="primary:#E83151"
                            style="width:20px;height:20px">
                        </lord-icon>
                    @endif
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/lomfljuq.json"
                    trigger="hover"
                    colors="primary:{{ $bedrijfsinfoCompleet ? '#08A045' : '#e4e4e4' }}"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div class="border-[1px] border-gray-200 hover:border-[#e4ab6c] transition cursor-pointer w-full p-[1rem] rounded-[10px] bg-white flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    <h2 class="text-lg text-[#191919] font-bold leading-[1]">Hosting informatie</h2>
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#E83151"
                        style="width:20px;height:20px">
                    </lord-icon>    
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/lomfljuq.json"
                    trigger="hover"
                    colors="primary:#e4e4e4"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div class="border-[1px] border-gray-200 hover:border-[#e4ab6c] transition cursor-pointer w-full p-[1rem] rounded-[10px] bg-white flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    <h2 class="text-lg text-[#191919] font-bold leading-[1]">Doel</h2>
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#E83151"
                        style="width:20px;height:20px">
                    </lord-icon>    
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/lomfljuq.json"
                    trigger="hover"
                    colors="primary:#e4e4e4"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
        </div>
    </div>
    <div id="offertes">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Offertes</h1>
        <div class="bg-white px-[1rem] pt-[1rem] pb-[0.25rem] rounded-[10px]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="text-[16px] pb-[0.75rem]">Offertenummer</th>
                        <th class="text-[16px] pb-[0.75rem]">Status</th>
                        <th class="text-[16px] pb-[0.75rem]">Laatste update</th>
                        <th class="text-[16px] text-right pb-[0.75rem]">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offertes as $offerte)
                        <tr class="{{ !$loop->last ? 'border-b border-[#ffffff10] border-b-[#19191920] border-b-[1px]' : '' }} text-[#191919]">
                            <td class="py-[1rem] text-[15px]">2025{{ $offerte->id }}</td>
                            <td class="py-[1rem]">
                                @if($offerte->status === 'In behandeling')
                                    <p class="px-2 py-1 bg-orange-100 border-[1px] border-orange-500 text-orange-500 w-fit text-[12px] rounded-lg">
                                        In behandeling
                                    </p>
                                @elseif($offerte->status === 'Te ondertekenen')
                                    <p class="px-2 py-1 bg-cyan-100 border-[1px] border-cyan-500 text-cyan-500 w-fit text-[12px] rounded-lg">
                                        Te ondertekenen
                                    </p>
                                @elseif($offerte->status === 'Ondertekend')
                                    <p class="px-2 py-1 bg-green-100 border-[1px] border-green-500 text-green-500 w-fit text-[12px] rounded-lg">
                                        Ondertekend
                                    </p>
                                @else
                                    <p class="px-2 py-1 bg-[#E83151] bg-opacity-10 border-[1px] border-[#E83151] text-[#E83151] w-fit text-[12px] rounded-lg">
                                        Meer gegevens nodig
                                    </p>
                                @endif
                            </td>
                            <td class="py-[1rem] text-[15px]">{{ $offerte->updated_at }}</td>
                            <td class="py-[1rem] text-right">
                                <a href="#" class="py-[0.5rem] px-[0.9rem] rounded-[5px] bg-[#E4AB6C] text-white font-medium text-[15px] opacity-50 cursor-not-allowed">Offerte bekijken</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-white opacity-70">Geen offertes gevonden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('task-bedrijfsinformatie').addEventListener('click', function() {
            document.getElementById('bedrijfsinformatie-bg').classList.add('active');
            document.getElementById('bedrijfsinformatie-content').classList.add('active');
        });
        document.getElementById('bedrijfsinformatie-bg').addEventListener('click', function() {
            document.getElementById('bedrijfsinformatie-bg').classList.remove('active');
            document.getElementById('bedrijfsinformatie-content').classList.remove('active');
        });

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