@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Your Profile</h1>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Edit Profile Button -->
        <a href="{{ route('profile.edit') }}" class="btn-primary">Edit Profile</a>

        <!-- Delete Account Form -->
        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">

        @csrf
            @method('DELETE')

            @if (auth()->id() === $user->id)
                <input type="password" name="password" required placeholder="Confirm password">
            @endif

            <button type="submit">Delete Account</button>
        </form>

    </div>
@endsection
