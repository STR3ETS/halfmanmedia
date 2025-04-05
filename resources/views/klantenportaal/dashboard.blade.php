@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <div class="flex items-center gap-[0.5rem]">
        <a href="#" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Home</p>
    </div>

    <div id="offertes">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Offertes</h1>
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
                                        Te ondertekenen
                                    </p>
                                @elseif($offerte->status === 'Ondertekend')
                                    <p class="px-2 py-1 bg-green-100 border-[1px] border-green-500 text-green-500 w-fit text-[12px] rounded-lg">
                                        Ondertekend
                                    </p>
                                @else
                                    <div class="flex items-center gap-[0.5rem]">
                                        <lord-icon
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