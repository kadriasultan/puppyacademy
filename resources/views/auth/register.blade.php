@extends('layouts.app')
@section('content')
    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}" class="registration-form" enctype="multipart/form-data">

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
            </div><br><br>

            <!-- Dogs Information -->
            <div id="dogs-container">
                <div class="dog-fields mt-4">
                    <!-- Naam van de hond -->
                    <x-input-label for="naam_hond" :value="__('Naam van de Hond')" />
                    <x-text-input id="naam_hond" class="block mt-1 w-full" type="text" name="naam_hond" :value="old('naam_hond.0')" required />
                    <x-input-error :messages="$errors->get('naam_hond.0')" class="mt-2" />


                    <label>Geboortedatum hond:
                        <input type="date" id="geboortedatum_hond" name="geboortedatum_hond" value="{{ old('geboortedatum_hond') }}" required>
                    </label><br><br>

                    <label>Ras:
                        <input type="text" id="ras" name="ras" value="{{ old('ras') }}" required>
                    </label><br><br>

                    <label>Geslacht:
                        <select id="geslacht" name="geslacht" required>
                            <option value="">-- Kies geslacht --</option>
                            <option value="Reu" {{ old('geslacht') == 'Reu' ? 'selected' : '' }}>Reu</option>
                            <option value="Teef" {{ old('geslacht') == 'Teef' ? 'selected' : '' }}>Teef</option>
                        </select>
                    </label><br><br>

                    <label>Foto hond uploaden:

                        <input type="file" id="foto_hond" name="foto_hond" accept="image/*" required>

                    </label><br><br>
            </div><br>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            </div>
        </form>
    </x-guest-layout>
@endsection

