@extends('layouts.dashboard')
@section('title', 'HalfmanMedia - Software op maat')
@section('content')
    <div class="flex items-center gap-[0.5rem]">
        <a href="/klantenportaal/dashboard" class="text-[14px] text-[#191919] font-medium opacity-[80%]">Dashboard</a>
        <p class="text-[14px] text-[#191919] font-medium opacity-[80%]">/</p>
        <p class="text-[14px] text-[#191919] font-medium">Account</p>
    </div>
    <div id="account">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Account</h1>
        <div class="bg-white p-[1.5rem] rounded-[10px] mb-[0.5rem]">
            <form id="editData-contactgegevens-form" action="{{ route('klantenportaal.account.contactgegevensupdate') }}" method="POST" class="flex flex-col gap-[0.5rem]">
                @csrf
                @if(session('success_contact'))
                    <p class="text-green-600 text-sm mb-4 bg-green-100 p-3 rounded border border-green-300">
                        {{ session('success') }}
                    </p>
                @endif
                @if($errors->has('naam') || $errors->has('email'))
                    <ul class="text-red-600 text-sm mb-4 bg-red-100 p-3 rounded border border-red-300 list-disc pl-5">
                        @foreach($errors->all() as $error)
                            @if(str_contains($error, 'naam') || str_contains($error, 'email'))
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <div>
                    <label for="naam" class="block text-sm text-[#191919] font-semibold mb-1">Uw naam</label>
                    <input type="text" name="naam" placeholder="bijv: Jan Jansen"
                        value="{{ old('name') ?? $gebruiker->name }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                </div>
                <div>
                    <label for="naam" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Uw e-mailadres</label>
                    <input type="email" name="email" placeholder="bijv: info@halfmanmedia.nl"
                        value="{{ old('email') ?? $gebruiker->email }}"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" />
                </div>
                <button type="submit"
                class="mt-[1rem] bg-[#E4AB6C] w-fit flex items-center justify-center py-[0.75rem] px-[3rem] text-[15px] text-white font-medium rounded-[5px]">Opslaan</button>
            </form>
        </div>
    </div>
    <div id="change-password">
        <h1 class="text-2xl text-[#191919] font-bold leading-[1] mb-4">Wachtwoord wijzigen</h1>
        <div class="bg-white p-[1.5rem] rounded-[10px]">
            @if(session('success_password'))
                <p class="text-green-600 text-sm mb-4 bg-green-100 p-3 rounded border border-green-300">
                    Wachtwoord is succesvol bijgewerkt!
                </p>
            @endif
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                <p class="text-red-600 text-sm mb-4 bg-red-100 p-3 rounded border border-red-300">
                    Oei... er is iets misgegaan. Controleer de velden.
                </p>
            @endif
            <form id="editData-wachtwoord-form" action="{{ route('klantenportaal.account.passwordupdate') }}" method="POST" class="flex flex-col gap-[0.5rem]">
                @csrf
                <div>
                    <label for="current_password" class="block text-sm text-[#191919] font-semibold mb-1">Huidig wachtwoord</label>
                    <input type="password" name="current_password"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" required />
                </div>
                <div>
                    <label for="new_password" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Nieuw wachtwoord</label>
                    <input type="password" name="new_password"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" required />
                </div>
                <div>
                    <label for="new_password_confirmation" class="block text-sm text-[#191919] font-semibold mb-1 mt-2">Herhaal nieuw wachtwoord</label>
                    <input type="password" name="new_password_confirmation"
                        class="w-full p-[0.75rem] rounded border border-gray-300 focus:border-[#E4AB6C] outline-none min-w-[300px]" required />
                </div>
                <button type="submit"
                    class="mt-[1rem] bg-[#E4AB6C] w-fit flex items-center justify-center py-[0.75rem] px-[3rem] text-[15px] text-white font-medium rounded-[5px]">Bijwerken</button>
            </form>
        </div>
    </div>
@endsection