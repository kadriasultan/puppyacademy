@extends('layouts.app')

@section('content')
    @php
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    @endphp
    <div class="training-platform-page">
        <section class="training-header">
            {{-- Toon een statusbericht als er een in de sessie zit --}}
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600" style="color: green" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1>Trainingsplatform</h1>
            <h2>Trainingen</h2>
        </section>

        <div class="training-cards-container">
            {{-- Loop door alle trainingen en toon ze --}}
            @foreach ($courses as $course)
                <div class="product-card">
                    <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}">
                    <h4 class="product-title">{{ $course->title }}</h4>
                    <p>{{ $course->description }}</p>


                    {{-- Alleen admin mag trainingen bewerken/verwijderen --}}
                    @if ($isAdmin)
                        <button class="edit-toggle" onclick="toggleEditForm({{ $course->id }})">Bewerken</button>
                        <form action="{{ route('training.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze training wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Verwijderen</button>
                        </form>

                        <form method="POST" action="{{ route('training.update', $course->id) }}" enctype="multipart/form-data" class="shop-edit" id="edit-form-{{ $course->id }}" style="display:none;">
                            @csrf
                            @method('PUT')
                            <label for="title-{{ $course->id }}">Titel</label>
                            <input type="text" name="title" value="{{ $course->title }}" required>
                            <label for="description-{{ $course->id }}">Beschrijving</label>
                            <textarea name="description" id="description-{{ $course->id }}" required>{{ $course->description }}</textarea>


                            <label for="image-{{ $course->id }}">Afbeelding</label>
                            <input type="file" name="image">
                            <button type="submit">Bewerken</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <h2>Training Videos</h2>

        <div class="shop-container">
            @foreach ($videos as $video)
                <div class="product-card">
                        <div class="course-item">

                                <video width="100%" controls>
                                    <source src="{{ asset('videos/' . $video->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>

                        </div>



                    <h4 class="product-title">{{ $video->title }}</h4>
                    <p>{{ $video->description }}</p>

                    @if ($isAdmin)
                        <button class="edit-toggle" onclick="toggleEditForm({{ $video->id }})">Bewerken</button>

                        {{-- Verwijderknop --}}
                        <form action="{{ route('training.destroy', $video->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze video wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Verwijderen</button>
                        </form>

                        {{-- Bewerkformulier --}}
                        <form method="POST" action="{{ route('training.update', $video->id) }}" enctype="multipart/form-data" class="shop-edit" id="edit-form-{{ $video->id }}" style="display:none;">
                            @csrf
                            @method('PUT')

                            <label for="title-{{ $video->id }}">Titel</label>
                            <input type="text" name="title" value="{{ $video->title }}">

                            <label for="description-{{ $video->id }}">Beschrijving</label>
                            <textarea name="description" id="description-{{ $video->id }}">{{ $video->description }}</textarea>


                            <label for="video">Video Bestand (MP4)</label>
                            <input type="file" name="video" id="video" accept="video/mp4">

                            <button type="submit">Opslaan</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <section class="training-form-section">
            <h2>Inschrijven</h2>
            {{-- Inschrijfformulier voor trainingen --}}
            <form class="training-form" method="POST" action="{{ route('training.register') }}">
                @csrf

                <div class="form-group">
                    <label for="training">Kies je training</label>
                    <select id="training" name="training" required class="form-control">
                        <option value="" disabled selected>Kies een training</option>
                        {{-- Vul dropdown met trainingen --}}
                        @foreach ($courses as $course)
                        <option value="{{ $course->title }}">{{ $course->title }}</option>
                        @endforeach

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
    @if ($isAdmin)
        {{-- Alleen voor admin: knop en formulier om nieuwe trainingen of video's toe te voegen --}}
        <button id="show-add-form" onclick="toggleAddForm()">Voeg een nieuwe training of video toe</button>

        <section class="shop-add" id="add-form" style="display:none;">
            <h3>Inhoud toevoegen</h3>
            <form method="POST" action="{{ route('training.store') }}" enctype="multipart/form-data">
                @csrf
                <label for="type">Type</label>
                <select name="type" id="type" required>
                    <option value="" disabled selected>Kies een type</option>
                    <option value="course">Training</option>
                    <option value="video">Video</option>
                </select>

                <label for="title">Titel</label>
                <input type="text" name="title" id="title" placeholder="Titel">

                <label for="description">Beschrijving</label>
                <textarea name="description" id="description" placeholder="Beschrijving"></textarea>

                {{-- Alleen afbeelding of video invoer afhankelijk van type --}}
                <div id="image-container">
                <label for="image">Afbeelding</label>
                <input type="file" name="image" id="image">
                </div>
                <div id="video-container">
                    <label for="video">Video Bestand (MP4)</label>
                    <input type="file" name="video" id="video" accept="video/mp4">
                </div>

                <button type="submit">Toevoegen</button>
            </form>
        </section>
    @endif
    {{-- Laad JavaScript voor toggles van formulieren --}}
    <script src="{{ asset('js/script.js') }}"></script>

@endsection
