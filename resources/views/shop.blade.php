@extends('layouts.app')

@section('content')
    @php
        // Check of de ingelogde gebruiker een admin is
            $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    @endphp
    {{-- Succesmelding --}}
    <main class="shop-page">
        @if(session('success'))
            <div class="alert alert-success" style=".alert-danger {
            background-color: #3e5c47;
            color: #070707;
            border: 1px solid #f5c6cb;
        }">
                {{ session('success') }}
            </div>
        @endif

            {{-- Foutmelding --}}
        @if(session('error'))
            <div class="alert alert-danger" style="color: #ffffff; font-weight: bold; text-align: center; background: red; padding: 10px 20px; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Shop secties -->
        <section class="shop-section">
            <h2 class="shop-heading">Cursussen</h2>
            <div class="shop-container">
                @foreach ($courses as $course)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}">
                        <h4 class="product-title">{{ $course->title }}</h4>
                        <p>{{ $course->description }}</p>
                        <p class="prijs">€{{ $course->price }}</p>
                        <button class="bestellen-button">Bestellen</button>
                        {{-- Admin opties: bewerken en verwijderen --}}
                        @if ($isAdmin)
                            <button class="edit-toggle" onclick="toggleEditForm({{ $course->id }})">Bewerken</button>
                            <form action="{{ route('shop.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Verwijderen</button>
                            </form>
                            {{-- Bewerken formulier (standaard verborgen) --}}
                            <form method="POST" action="{{ route('shop.update', $course->id) }}" enctype="multipart/form-data" class="shop-edit" id="edit-form-{{ $course->id }}" style="display:none;">
                                @csrf
                                @method('PUT')
                                <label for="title-{{ $course->id }}">Titel</label>
                                <input type="text" name="title" value="{{ $course->title }}" required>
                                <label for="description-{{ $course->id }}">Beschrijving</label>
                                <textarea name="description" id="description-{{ $course->id }}" required>{{ $course->description }}</textarea>

                                <label for="price-{{ $course->id }}">Prijs</label>
                                <input type="number" name="price" step="1.0" value="{{ $course->price }}" required>
                                <label for="image-{{ $course->id }}">Afbeelding</label>
                                <input type="file" name="image">
                                <button type="submit">Bewerken</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
            {{-- Sectie DIY-pakketten --}}
        <section class="shop-section">
            <h2 class="shop-heading">DIY-pakketten</h2>
            <div class="shop-container">
                @foreach ($diys as $diy)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $diy->image) }}" alt="{{ $diy->title }}">
                        <h4 class="product-title">{{ $diy->title }}</h4>
                        <p>{{ $diy->description }}</p>
                        <p class="prijs">€{{ $diy->price }}</p>
                        <button class="bestellen-button">Bestellen</button>

                        @if ($isAdmin)
                            {{-- Admin opties: bewerken en verwijderen --}}
                            <button class="edit-toggle" onclick="toggleEditForm({{ $diy->id }})">Bewerken</button>
                            <form action="{{ route('shop.destroy', $diy->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Verwijderen</button>
                            </form>
                            {{-- Bewerken formulier (standaard verborgen) --}}
                            <form method="POST" action="{{ route('shop.update', $diy->id) }}" enctype="multipart/form-data" class="shop-edit" id="edit-form-{{ $diy->id }}" style="display:none;">
                                @csrf
                                @method('PUT')
                                <label for="title-{{ $diy->id }}">Titel</label>
                                <input type="text" name="title" value="{{ $diy->title }}" required>
                                <label for="description-{{ $diy->id }}">Beschrijving</label>
                                <textarea name="description" id="description-{{ $diy->id }}" required>{{ $diy->description }}</textarea>

                                <label for="price-{{ $diy->id }}">Prijs</label>
                                <input type="number" name="price" step="1.0" value="{{ $diy->price }}" required>
                                <label for="image-{{ $diy->id }}">Afbeelding</label>
                                <input type="file" name="image">
                                <button type="submit">Bewerken</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        @if ($isAdmin)
                {{-- Knop om het formulier om een nieuw item toe te voegen te tonen --}}
            <button id="show-add-form" onclick="toggleAddForm()">Voeg een nieuw item toe</button>

            <section class="shop-add" id="add-form" style="display:none;">
                <h3>Nieuw item toevoegen</h3>
                <form method="POST" action="{{ route('shop.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="type">Type</label>
                    <select name="type" id="type" required>
                        <option value="" disabled selected>Kies een type</option>
                        <option value="course">Cursus</option>
                        <option value="diy">DIY-pakket</option>
                    </select>

                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title" placeholder="Titel" required>

                    <label for="description">Beschrijving</label>
                    <textarea name="description" id="description" placeholder="Beschrijving" required></textarea>

                    <label for="price">Prijs</label>
                    <input type="number" step="0.01" name="price" id="price" placeholder="Prijs (€)" required>

                    <label for="image">Afbeelding</label>
                    <input type="file" name="image" id="image" required>

                    <button type="submit">Toevoegen</button>
                </form>
            </section>
        @endif
    </main>

    {{-- Script om edit en add formulieren te togglen --}}
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
