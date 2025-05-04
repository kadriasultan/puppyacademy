@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('POST') <!-- Dit kan ook 'PUT' zijn, afhankelijk van je voorkeur -->

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div>
            <label for="password">Password (leave blank to keep current password)</label>
            <input type="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <label for="role">Role</label>
            <input type="text" name="role" value="{{ $user->role }}" required>
        </div>

        <button type="submit">Update User</button>
    </form>
@endsection
