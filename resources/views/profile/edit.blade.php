@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <h3>Your Dogs</h3>
        @foreach($dogs as $dog)
            <div class="dog-fields mt-4">
                <!-- Dog Name -->
                <x-input-label for="dog_name" :value="__('Dog Name')" />
                <x-text-input id="dog_name" class="block mt-1 w-full" type="text" name="dog_name[]" :value="old('dog_name.'.$loop->index, $dog->name)" required />
                <x-input-error :messages="$errors->get('dog_name.'.$loop->index)" class="mt-2" />

                <!-- Dog Nickname -->
                <x-input-label for="dog_roepnaam" :value="__('Dog Nickname')" />
                <x-text-input id="dog_roepnaam" class="block mt-1 w-full" type="text" name="dog_roepnaam[]" :value="old('dog_roepnaam.'.$loop->index, $dog->nickname)" required />
                <x-input-error :messages="$errors->get('dog_roepnaam.'.$loop->index)" class="mt-2" />

                <!-- Dog Breed -->
                <x-input-label for="dog_soort" :value="__('Dog Breed')" />
                <x-text-input id="dog_soort" class="block mt-1 w-full" type="text" name="dog_soort[]" :value="old('dog_soort.'.$loop->index, $dog->breed)" required />
                <x-input-error :messages="$errors->get('dog_soort.'.$loop->index)" class="mt-2" />

                <!-- Dog Age -->
                <x-input-label for="dog_age" :value="__('Dog Age')" />
                <x-text-input id="dog_age" class="block mt-1 w-full" type="number" name="dog_age[]" :value="old('dog_age.'.$loop->index, $dog->age)" required />
                <x-input-error :messages="$errors->get('dog_age.'.$loop->index)" class="mt-2" />
            </div>
        @endforeach

        <x-primary-button class="mt-4">
            {{ __('Save Changes') }}
        </x-primary-button>
    </form>
@endsection
