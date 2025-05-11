
@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Welkom bij het admin-dashboard!</p>

    <div class="admin-links">
        <h2>Beheerder Pagina's</h2>
        <ul>
            <li><a href="{{ route('admin.manageDagopvang') }}">Dagopvang Beheren</a></li>
            <li><a href="{{ route('shop') }}">Winkel Beheren</a></li>
            <li><a href="{{ route('training') }}">Trainingen Beheren</a></li>
            <li><a href="{{ route('contact') }}">Contact Pagina Beheren</a></li>
            <li><a href="{{ route('profile') }}">Profiel Beheren</a></li>
        </ul>
    </div>
@endsection
