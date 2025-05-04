@extends('layouts.app')

@section('content')
    @php
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    @endphp

    <main class="shop-page">
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

                        @if ($isAdmin)
                            <button class="edit-toggle" onclick="toggleEditForm({{ $course->id }})">Bewerken</button>
                            <form action="{{ route('shop.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Verwijderen</button>
                            </form>

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
                            <button class="edit-toggle" onclick="toggleEditForm({{ $diy->id }})">Bewerken</button>
                            <form action="{{ route('shop.destroy', $diy->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Verwijderen</button>
                            </form>

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
            <button id="show-add-form" onclick="toggleAddForm()">Voeg een nieuwe cursus of pakket toe</button>

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


    <script>
        function toggleEditForm(id) {
            const form = document.getElementById(`edit-form-${id}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleAddForm() {
            const form = document.getElementById('add-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
