@extends('layouts.dashboard')
@section('title', 'Offerte Details')
@section('content')
    <style>
        #editData-bg {
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
        }
        #editData-bg.active {
            opacity: 50%;
            pointer-events: all !important;
        }
        #editData-content {
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }
        #editData-content.active {
            opacity: 100%;
            pointer-events: all !important;
        }
        #editData-overlay {
            pointer-events: none;
        }
    </style>
    <div class="w-full h-screen fixed z-[499] top-0 left-0 flex" id="editData-overlay">
        <div id="editData-bg" class="flex-1 bg-black opacity-50 transition z-[500]"></div>
        <div id="editData-content"
            class="w-[400px] max-w-full px-[2rem] py-[3rem] border-l border-[#ffffff20] flex flex-col gap-[1rem] h-screen bg-white transition z-[501]">
            <h1 id="editData-h1" class="text-lg text-[#191919] font-bold leading-[1]"></h1>
            <form id="editData-contactgegevens-form" class="hidden flex flex-col gap-[0.5rem]">
                <div>
                    <label for="naam" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Waarmee mogen we u aanspreken?</label>
                    <input readonly type="text" name="naam" placeholder="bijv: Jan Jansen"
                        value="{{ old('name') ?? $gebruiker->name }}"
                        class="opacity-50 cursor-not-allowed w-full p-[0.75rem] rounded border border-gray-300 outline-none min-w-[300px]" />
                </div>
                <div>
                    <label for="naam" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat is uw e-mailadres?</label>
                    <input readonly type="email" name="email" placeholder="bijv: info@halfmanmedia.nl"
                        value="{{ old('email') ?? $gebruiker->email }}"
                        class="opacity-50 cursor-not-allowed w-full p-[0.75rem] rounded border border-gray-300 outline-none min-w-[300px]" />
                </div>
            </form>
            <form id="editData-bedrijfsinformatie-form" action="{{ route('offerte.update', $offerte->id) }}" method="POST" class="hidden flex flex-col gap-[0.5rem]">
                @csrf
                <div>
                    <label for="bedrijfsnaam" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat is uw bedrijfsnaam?</label>
                    <input type="text" name="bedrijfsnaam" placeholder="bijv: HalfmanMedia"
                        value="{{ old('bedrijfsnaam') ?? $offerte->bedrijfsnaam }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                </div>
                <div>
                    <label for="bedrijfsomschrijving" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Beschrijf in het kort uw bedrijf</label>
                    <textarea name="bedrijfsomschrijving" placeholder="bijv: Webagency voor ontwikkeling van websites & webshops" class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]">{{ old('bedrijfsomschrijving') ?? $offerte->bedrijfsomschrijving }}</textarea>
                </div>
                <div>
                    <label for="kvk" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">KVK-nummer</label>
                    <input type="text" name="kvk" placeholder="bijv: 123456789"
                        value="{{ old('kvk') ?? $offerte->kvk }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                </div>
                <div>
                    <label for="vestigingsadres" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Vestigingsadres</label>
                    <input type="text" name="vestigingsadres" placeholder="bijv: Prinsengracht 1, 9999AA Amsterdam"
                        value="{{ old('vestigingsadres') ?? $offerte->vestigingsadres }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none" />
                </div>
                <button type="submit"
                    class="mt-[1rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
            <form id="editData-doel-form" method="POST" action="{{ route('offerte.update', $offerte->id) }}" class="hidden flex flex-col gap-[0.5rem]">
                @csrf
                <div>
                    <label for="doel" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat wilt u bereiken met de {{ $offerte->dienst }}</label>
                    <textarea name="doel" placeholder="bijv: meer conversie" class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]">{{ old('doel') ?? $offerte->doel }}</textarea>
                </div>
                <div>
                    <label for="doelgroep" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat is de belangrijkste doelgroep?</label>
                    <input type="text" name="doelgroep" placeholder="bijv: jongeren"
                        value="{{ old('doelgroep') ?? $offerte->doelgroep }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                </div>
                <div>
                    <label for="extra-wensen" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Heeft u nog extra wensen?</label>
                    <textarea name="extra-wensen" placeholder="bijv: inlogsysteem" class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]">{{ old('extra_wensen') ?? $offerte->extra_wensen }}</textarea>
                </div>
                <button type="submit"
                    class="mt-[1rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
            <form id="editData-budget-form" method="POST" action="{{ route('offerte.update', $offerte->id) }}" class="hidden flex flex-col gap-[0.5rem]">
                @csrf
                <div>
                    <label for="budget" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat is u geschatte budget?</label>
                    <input
                        type="range"
                        id="budget"
                        name="budget"
                        min="500"
                        max="10000"
                        step="250"
                        value="{{ old('budget', $offerte->budget ?? 2500) }}"
                        class="w-full accent-[#E4AB6C]"
                        oninput="budgetValue.innerText = '€' + this.value"
                    >
                    <p class="text-xs text-[#191919] opacity-80">Huidige budget: <span id="budgetValue">€{{ $offerte->budget ?? 2500 }}</span></p>
                </div>
                <div>
                    <label for="verwachting" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Wat verwacht u te kunnen realiseren met dit budget?</label>
                    <textarea name="verwachting" placeholder="Bijv: een professionele website met 5 pagina's en contactformulier" class="-mb-[0.4rem] w-full min-h-[100px] max-h-[200px] p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]">{{ old('verwachting') ?? $offerte->verwachting }}</textarea>
                </div>
                <div>
                    <label for="flexibel" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Is uw budget flexibel?</label>
                    <select name="flexibel" id="flexibel"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none">
                        <option value="1" {{ old('flexibel', $offerte->flexibel ?? '') == '1' ? 'selected' : '' }}>Ja</option>
                        <option value="0" {{ old('flexibel', $offerte->flexibel ?? '') == '0' ? 'selected' : '' }}>Nee</option>
                    </select>
                </div>
                <button type="submit"
                    class="mt-[1rem] bg-[#E4AB6C] w-full flex items-center justify-center py-[0.75rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
        </div>
    </div>

    <div class="flex items-center gap-[0.5rem]">
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium opacity-[80%]">/</p>
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Home</a>
        <p class="text-[14px] text-[#191919] font-medium">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Offerte aanvullen</p>
    </div>
    <div id="gegevens">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-2">Gegevens aanvullen</h1>
        <h2 class="text-lg text-[#191919] font-semibold leading-[1] opacity-50 mb-4">Offerte 2025{{ $offerte->id }}</h2>
        @if($statusContactgegevens['contactgegevens'] && $statusBedrijfsinformatie['bedrijfsinformatie'] && $statusDoel['doel'] && $statusBudget['budget'])
        <p class="text-[#16c72e] text-sm font-semibold mb-4">Alle gegevens zijn compleet! Tijd om te relaxen.<br><span class="text-xs font-sembold text-[#191919]">Klik <a href="/klantenportaal/dashboard" class="underline">hier</a> om de status van je offerte te zien.</span></p>
        @else
        <p class="text-red-500 text-sm font-semibold mb-4">Om je offerte af te ronden hebben we nog een paar details nodig. Dit kost je maar 1-2 minuten.</p>
        @endif
        <ul class="flex flex-col gap-[0.5rem]">
            <li onclick="editContactgegevens()" class="border-[1px] hover:border-[#E4AB6C] transition cursor-pointer bg-white p-[1.5rem] rounded-[10px] flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    @if(!$statusContactgegevens['contactgegevens'])
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#e83151"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @else
                    <lord-icon
                        src="https://cdn.lordicon.com/lomfljuq.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#16c72e"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @endif
                    <h3 class="text-md text-[#191919] font-bold leading-[1]">Contactgegevens</h3>
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/whtfgdfm.json"
                    trigger="hover"
                    colors="primary:#E4AB6C"
                    style="width:30px;height:30px">
                </lord-icon>
            </li>
            <li onclick="editBedrijfsinformatie()" class="border-[1px] hover:border-[#E4AB6C] transition cursor-pointer bg-white p-[1.5rem] rounded-[10px] flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    @if(!$statusBedrijfsinformatie['bedrijfsinformatie'])
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#e83151"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @else
                    <lord-icon
                        src="https://cdn.lordicon.com/lomfljuq.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#16c72e"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @endif
                    <h3 class="text-md text-[#191919] font-bold leading-[1]">Bedrijfsinformatie</h3>
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/whtfgdfm.json"
                    trigger="hover"
                    colors="primary:#E4AB6C"
                    style="width:30px;height:30px">
                </lord-icon>
            </li>
            <li onclick="editDoel()" class="border-[1px] hover:border-[#E4AB6C] transition cursor-pointer bg-white p-[1.5rem] rounded-[10px] flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    @if(!$statusDoel['doel'])
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#e83151"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @else
                    <lord-icon
                        src="https://cdn.lordicon.com/lomfljuq.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#16c72e"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @endif
                    <h3 class="text-md text-[#191919] font-bold leading-[1]">Doel</h3>
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/whtfgdfm.json"
                    trigger="hover"
                    colors="primary:#E4AB6C"
                    style="width:30px;height:30px">
                </lord-icon>
            </li>
            <li onclick="editBudget()" class="border-[1px] hover:border-[#E4AB6C] transition cursor-pointer bg-white p-[1.5rem] rounded-[10px] flex items-center justify-between">
                <div class="flex items-center gap-[0.5rem]">
                    @if(!$statusBudget['budget'])
                    <lord-icon
                        src="https://cdn.lordicon.com/keaiyjcx.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#e83151"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @else
                    <lord-icon
                        src="https://cdn.lordicon.com/lomfljuq.json"
                        trigger="loop"
                        delay="5000"
                        colors="primary:#16c72e"
                        style="width:20px;height:20px">
                    </lord-icon>
                    @endif
                    <h3 class="text-md text-[#191919] font-bold leading-[1]">Budget</h3>
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/whtfgdfm.json"
                    trigger="hover"
                    colors="primary:#E4AB6C"
                    style="width:30px;height:30px">
                </lord-icon>
            </li>
        </ul>
    </div>
    <script>
        function resetAllForms() {
            document.getElementById('editData-contactgegevens-form').classList.add('hidden');
            document.getElementById('editData-bedrijfsinformatie-form').classList.add('hidden');
            document.getElementById('editData-doel-form').classList.add('hidden');
            document.getElementById('editData-budget-form').classList.add('hidden');
        }
        function editContactgegevens() {
            resetAllForms()
            document.getElementById('editData-contactgegevens-form').classList.remove('hidden');
            document.getElementById('editData-h1').innerHTML = 'Contactgegevens';
            document.getElementById('editData-bg').classList.add('active');
            document.getElementById('editData-content').classList.add('active');
        }
        function editBedrijfsinformatie() {
            resetAllForms()
            document.getElementById('editData-bedrijfsinformatie-form').classList.remove('hidden');
            document.getElementById('editData-h1').innerHTML = 'Bedrijfsinformatie';
            document.getElementById('editData-bg').classList.add('active');
            document.getElementById('editData-content').classList.add('active');
        }
        function editDoel() {
            resetAllForms()
            document.getElementById('editData-doel-form').classList.remove('hidden');
            document.getElementById('editData-h1').innerHTML = 'Doel';
            document.getElementById('editData-bg').classList.add('active');
            document.getElementById('editData-content').classList.add('active');
        }
        function editBudget() {
            resetAllForms()
            document.getElementById('editData-budget-form').classList.remove('hidden');
            document.getElementById('editData-h1').innerHTML = 'Budget';
            document.getElementById('editData-bg').classList.add('active');
            document.getElementById('editData-content').classList.add('active');
        }
        document.getElementById('editData-bg').addEventListener('click', function() {
            document.getElementById('editData-bg').classList.remove('active');
            document.getElementById('editData-content').classList.remove('active');
        });
    </script>
@endsection
