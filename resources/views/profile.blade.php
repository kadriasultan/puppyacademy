@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Your Profile</h1>

        <div class="user-info">
            <h2>Personal Information</h2>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <div class="dogs-info">
            <h2>Your Dogs</h2>
            @foreach($user->dogs as $dog)
                <div class="dog-card">
                    <h3>{{ $dog->name }}</h3>
                    <p><strong>Roepnaam hond:</strong> {{ $dog->nickname }}</p>
                    <p><strong>Hondenras:</strong> {{ $dog->breed }}</p>
                    <p><strong>leeftijd:</strong> {{ $dog->age }} years</p>
                </div>
            @endforeach
        </div>

        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>

            <form action="{{ route('profile.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete your account?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>


@endsection
