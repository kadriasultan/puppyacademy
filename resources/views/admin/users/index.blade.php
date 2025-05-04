@extends('layouts.app')

@section('content')
    <h1>Users</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                    <!-- Je kunt hier ook een delete link toevoegen -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.users.create') }}">Create New User</a>
@endsection
