@extends('layouts.app')

@section('title', 'Puppy Power Academy - Home')

@section('content')
    <div class="contact-form-container">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ben je je wachtwoord vergeten? Geen probleem. Laat ons gewoon je e-mailadres weten en we sturen je een link om je wachtwoord opnieuw in te stellen, waarmee je een nieuw wachtwoord kunt kiezen.') }}
        </div>



        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="contact-form-container">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" /> <br><br>
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600" style="color: green" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="contact-form-container">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
