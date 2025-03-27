@extends('layouts.offerte')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <style>
        @keyframes logoScale {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.3);
            }
        }
        @keyframes fadeSlideUp {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                transform: translateY(-100%);
            }
        }
        #loading-logo {
            animation: logoScale 2s ease-in-out forwards;
        }
        #loading {
            transition: background-color 0.5s ease-in-out;
        }
        .bg-transition {
            background-color: #c2915b !important;
        }
        .fade-slide-up {
            animation: fadeSlideUp 0.6s ease-in-out forwards;
        }
    </style>
    <div class="w-full h-screen fixed z-[100] bg-[#241B12] flex items-center justify-center" id="loading">
        <img src="assets/halfmanmedia-logo-gold-white.png" alt="HalfmanMedia" class="max-w-[50px]" id="loading-logo">
    </div>

    <a href="/" class="fixed z-[1] left-[1.5rem] top-[1.5rem]">
        <img src="assets/halfmanmedia-logo-gold-white.png" alt="HalfmanMedia" class="max-w-[30px]">
    </a>
    <form action="{{ route('offerte.store') }}" method="POST" class="w-full h-screen flex items-center justify-center">
        @csrf
        <div class="bg-white rounded-[20px] p-[1.5rem] min-w-[400px] flex flex-col gap-[1rem]">
            <h1 class="text-xl font-medium"><span class="text-[#E4AB6C] mr-2">1.</span>Diensten</h1>
            <select name="dienst" id="dienst" required
                class="w-full px-[0.75rem] py-[0.75rem] rounded-[5px] border focus:border-[#E4AB6C] outline-none">
                <option value="" disabled {{ $selectedDienst ? '' : 'selected' }}>Kies een dienst</option>
                <option value="website" {{ $selectedDienst === 'website' ? 'selected' : '' }}>Website</option>
                <option value="webshop" {{ $selectedDienst === 'webshop' ? 'selected' : '' }}>Webshop</option>
            </select>
        </div>
        <button type="submit" id="nextButton"
            class="fixed z-[1] bottom-[1.5rem] left-0 right-0 ml-auto mr-auto px-[3rem] py-[0.75rem] w-fit bg-[#E4AB6C] hover:bg-[#FFF8F0] hover:text-black transition rounded-[5px] text-base font-medium text-white">
            Volgende
        </button>
    </form>

    <script>
    setTimeout(() => {
        document.getElementById('loading').classList.add('bg-transition');
    }, 2000);
    setTimeout(() => {
        document.getElementById('loading').classList.add('fade-slide-up');
    }, 4000);
    setTimeout(() => {
        document.getElementById('loading').style.display = 'none';
    }, 6000);
</script>
@endsection
