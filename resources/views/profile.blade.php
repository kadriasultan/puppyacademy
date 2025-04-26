@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Your Profile</h1>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Edit Profile Button -->
        <a href="{{ route('profile.edit') }}" class="btn-primary">Edit Profile</a>

        <!-- Delete Account Form -->
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete Account</button>
        </form>
    </div>
@endsection
