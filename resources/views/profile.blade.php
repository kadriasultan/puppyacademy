@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Your Profile</h1>
<div class="in">
    <h2>Personal Information</h2>

</div>
        <div class="user-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <div class="dogs-info">
            <h2>Your Dogs</h2>
            @foreach($user->dogs as $dog)
                <div class="dog-card">
                    <p><strong>Naam:</strong>{{ $dog->name }}</p>
                    <p><strong>Roepnaam hond:</strong> {{ $dog->nickname }}</p>
                    <p><strong>Hondenras:</strong> {{ $dog->breed }}</p>
                    <p><strong>leeftijd:</strong> {{ $dog->age }} years</p>
                </div>
            @endforeach
        </div>

        @if($intake)
            <h2>Intake Gegevens</h2>
            <p><strong>Naam hond:</strong> {{ $intake->naam_hond }}</p>
            <p><strong>Geboortedatum:</strong> {{ $intake->geboortedatum }}</p>
            <p><strong>Ras:</strong> {{ $intake->ras }}</p>
            <p><strong>Geslacht:</strong> {{ $intake->geslacht }}</p>

            @if($intake->foto)
                <p><strong>Foto hond:</strong></p>
                <img src="{{ asset('storage/' . $intake->foto) }}" alt="Foto van de hond" style="max-width: 250px; border-radius: 10px;">
            @endif
        @else
            <p>Er is nog geen intake ingevuld.</p>
        @endif


    @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>

            <form action="{{ route('profile.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete your account?');">
                @csrf
                @method('DELETE')

            </form>
        </div>
        <h3>Mijn Dagopvang Reserveringen</h3>
        <ul>
            @forelse($inschrijvingen as $inschrijving)
                <li>
                    <strong>{{ $inschrijving->voorkeursdatum }}</strong> - {{ $inschrijving->naam_hond }} ({{ $inschrijving->roepnaam }})
                </li>
            @empty
                <li>Je hebt nog geen dagopvang reserveringen.</li>
            @endforelse
        </ul>

    </div>


@endsection
