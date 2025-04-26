@extends('layouts.app')
@section('content')
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}" class="registration-form">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
@endsection

<style>
    /* Algemene stijlen voor het formulier */
    .registration-form {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Velden voor input */
    .registration-form input[type="text"],
    .registration-form input[type="email"],
    .registration-form input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .registration-form input[type="text"]:focus,
    .registration-form input[type="email"]:focus,
    .registration-form input[type="password"]:focus {
        outline: none;
        border-color: #4C6FFF;
        box-shadow: 0 0 8px rgba(76, 111, 255, 0.3);
    }

    /* Knopstijl */
    .registration-form .primary-button {
        background-color: #4C6FFF;
        color: white;
        padding: 12px 16px;
        font-size: 16px;
        width: 100%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .registration-form .primary-button:hover {
        background-color: #365cbd;
    }

    /* Mobiele aanpassingen */
    @media (max-width: 768px) {
        .registration-form {
            padding: 20px;
            margin: 20px;
        }
    }
</style>
