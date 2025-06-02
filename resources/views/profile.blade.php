@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Mijn Profile</h1>
<div class="in">
    <h2>Personal Informatie</h2>

</div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="user-info">
            <p><strong>Naam:</strong> {{ $user->name }}</p>
            <p><strong>E-mail:</strong> {{ $user->email }}</p>
        </div>

        <div class="dogs-info">
            <h2>Mijn Honden</h2>
            @foreach($user->dogs as $dog)
                <div class="dog-card">
                    <p><strong>Naam:</strong> {{ $dog->naam_hond }}</p>
                    <p><strong>Hondenras:</strong> {{ $dog->ras }}</p>
                    <p><strong>Geboortedatum:</strong>
                        {{ \Carbon\Carbon::parse($dog->geboortedatum)->format('d/m/Y') }}
                    </p>
                    <p><strong>Geslacht:</strong> {{ $dog->geslacht }}</p>
                @if($dog->foto)
                        <p><strong>Foto hond:</strong></p>
                        <img src="{{ asset( $dog->foto) }}" alt="Foto van de hond" style="max-width: 250px; border-radius: 10px;">
                    @endif
                </div>
            @endforeach

        </div>

        @if($intake)
            <h2>Intake Gegevens</h2>
            <p><strong>Naam hond:</strong> {{ $intake->naam_hond }}</p>
            <p><strong>Geboortedatum:</strong> {{ \Carbon\Carbon::parse($intake->geboortedatum)->format('d/m/Y') }}</p>
            <p><strong>Ras:</strong> {{ $intake->ras }}</p>
            <p><strong>Geslacht:</strong> {{ $intake->geslacht }}</p>

            @if($intake->foto)
                <p><strong>Foto hond:</strong></p>
                <img src="{{ asset( $intake->foto) }}" alt="Foto van {{ $dog->naam_hond }}" style="max-width: 250px; border-radius: 10px;">
            @endif
        @else
            <p>Er is nog geen intake ingepland.</p>
        @endif

        <form action="{{ route('profile.destroy', $user->id) }}" method="POST"
              onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen?');">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                Verwijder account
            </button>

        </form>




    </div>


@endsection
