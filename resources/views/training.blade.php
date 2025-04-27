@extends('layouts.app')

@section('content')
    <div class="training-platform-page">
        <section class="training-header">
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600" style="color: green" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1>Trainingsplatform</h1>
            <h2>Trainingen</h2>
        </section>

        <div class="training-cards-container">
            <div class="training-card">
                <h3>Puppytraining</h3>
                <p>Leer je pup de basiscommando's op een speelse manier.</p>
            </div>

            <div class="training-card">
                <h3>Vuurwerkangst</h3>
                <p>Training om je hond te helpen bij geluiden zoals vuurwerk.</p>
            </div>

            <div class="training-card">
                <h3>Gedragstraining</h3>
                <p>Voor honden met gedragsproblemen of extra begeleiding nodig hebben.</p>
            </div>
        </div>

        <h2>Training Videos</h2>
        <section class="training-form-section">
            <h2>Inschrijven</h2>

            <form class="training-form" method="POST" action="{{ route('training.register') }}">
                @csrf

                <div class="form-group">
                    <label for="training">Kies je training</label>
                    <select id="training" name="training" required class="form-control">
                        <option value="puppytraining">Puppytraining</option>
                        <option value="vuurwerkangst">Vuurwerkangst</option>
                        <option value="gedragstraining">Gedragstraining</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" id="name" name="name" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>

                <button type="submit" class="btn-primary">Inschrijven</button>
            </form>
        </section>
    </div>
@endsection
