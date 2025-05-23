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

            <!-- Dogs Information -->
            <div id="dogs-container">
                <div class="dog-fields mt-4">
                    <!-- Naam van de hond -->
                    <x-input-label for="dog_name" :value="__('Naam van de Hond')" />
                    <x-text-input id="dog_name" class="block mt-1 w-full" type="text" name="dog_name[]" :value="old('dog_name.0')" required />
                    <x-input-error :messages="$errors->get('dog_name.0')" class="mt-2" />

                    <!-- Roepnaam van de hond -->
                    <x-input-label for="dog_roepnaam" :value="__('Roepnaam van de Hond')" />
                    <x-text-input id="dog_roepnaam" class="block mt-1 w-full" type="text" name="dog_roepnaam[]" :value="old('dog_roepnaam.0')" required />
                    <x-input-error :messages="$errors->get('dog_roepnaam.0')" class="mt-2" />

                    <!-- Soort van de hond -->
                    <x-input-label for="dog_soort" :value="__('Soort van de Hond')" />
                    <x-text-input id="dog_soort" class="block mt-1 w-full" type="text" name="dog_soort[]" :value="old('dog_soort.0')" required />
                    <x-input-error :messages="$errors->get('dog_soort.0')" class="mt-2" />

                    <!-- Leeftijd van de hond -->
                    <x-input-label for="dog_age" :value="__('Leeftijd van de Hond')" />
                    <x-text-input id="dog_age" class="block mt-1 w-full" type="number" name="dog_age[]" :value="old('dog_age.0')" required />
                    <x-input-error :messages="$errors->get('dog_age.0')" class="mt-2" />
                </div>
            </div>

            <!-- Button to add more dogs -->
            <button type="button" id="add-dog" class="mt-4">Voeg meer honden toe</button>

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

<script>
    document.getElementById('add-dog').addEventListener('click', function() {
        let dogFields = document.querySelector('.dog-fields').cloneNode(true);
        let container = document.getElementById('dogs-container');
        container.appendChild(dogFields);
    });
</script>

