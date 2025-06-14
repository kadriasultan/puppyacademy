@extends('layouts.app')
@section('title', 'Puppy Power Academy - Home')
@section('content')
    <!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF-token voor beveiliging van formulieren en AJAX-verzoeken -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<!-- Hero sectie met welkomsttekst -->
<section class="hero">
    <h2>Welkom bij Puppy Power Academy!</h2>
    <p>Dé plek voor puppytrainingen, hondenspullen en professionele dagopvang.</p>
</section>

<!-- Afbeeldingengalerij met slides -->
<div class="gallery">
    <div class="slides">
        <!-- Actieve slide begint hier -->
        <img src="https://webdog.doggywonderland.nl/images/K6A5138-DoggywonderlandhondenopvangkennelvrijroedelKitty3.jpeg" class="slide active">
        <img src="https://www.dierenpensionrenswoude.nl/wp-content/uploads/2022/09/foto-groep-25-1.jpg" class="slide">
        <img src="http://www.deroedelthuis.com/wp-content/uploads/simple_photo_gallery/1/p1040326.jpg" class="slide">
    </div>
</div>

@php
    // Check of de ingelogde gebruiker een admin is
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

    <!-- Owner sectie alleen tonen als er een $owner is -->
@if($owner)
    <section class="owner-section">
        <div class="owner-container">
            <div class="owner-image">
                <!-- Owner afbeelding -->
                <img id="owner-image-preview" src="{{ asset($owner->image) }}" alt="{{ $owner->name }}" style="max-width: 200px;">

                @if($isAdmin)
                    <!-- Upload knop voor admin (verborgen standaard) -->
                    <input type="file" id="owner-image-upload" data-id="{{ $owner->id }}" style="display: none" onchange="uploadOwnerImage(this)">
                @endif
            </div>

            <div class="owner-info">
                <div id="owner-display">
                    <!-- Owner gegevens zichtbaar voor alle gebruikers -->
                    <h2 id="display-name">{{ $owner->name }}</h2>
                    <p id="display-p1">{{ $owner->paragraph_1 }}</p>
                    <p id="display-p2">{{ $owner->paragraph_2 }}</p>
                    <p id="display-p3">{{ $owner->paragraph_3 }}</p>
                </div>

                @if($isAdmin)
                    <!-- Edit formulier verborgen standaard, alleen voor admin -->
                    <div id="owner-edit-form" style="display: none;">
                        <input type="text" id="edit-name" class="form-control" value="{{ $owner->name }}"><br>
                        <textarea id="edit-p1" class="form-control">{{ $owner->paragraph_1 }}</textarea><br>
                        <textarea id="edit-p2" class="form-control">{{ $owner->paragraph_2 }}</textarea><br>
                        <textarea id="edit-p3" class="form-control">{{ $owner->paragraph_3 }}</textarea><br>
                    </div>

                    <!-- Knoppen om te bewerken en op te slaan, alleen voor admin -->
                    <div class="admin-controls mt-2">
                        <button id="edit-button" onclick="toggleEdit()">Bewerken</button>
                        <button id="save-button" onclick="saveOwnerSection({{ $owner->id }})" style="display: none;">Opslaan</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

<!-- Navigatieblokken naar verschillende pagina's -->
<div class="container">
    <a href="/shop">
        <div class="inhoud">
            <h1><i class="fa-solid fa-cart-shopping"></i></h1>
            <h3>Shop voor hondenproduct</h3>
        </div>
    </a>
    <a href="/dagopvang">
        <div class="inhoud">
            <h1><i class="fa-solid fa-house-chimney"></i></h1>
            <h3>Dagopvang</h3>
        </div>
    </a>
    <a href="/training">
        <div class="inhoud">
            <h1><i class="fa-solid fa-shield-dog"></i></h1>
            <h3>Training</h3>
        </div>
    </a>
</div>

</body>

@if($isAdmin)
    <!-- JavaScript functies voor admin bewerkingen -->
    <script>
        // Wissel tussen tonen van display en bewerkformulier
        function toggleEdit() {
            document.getElementById('owner-display').style.display = 'none';
            document.getElementById('owner-edit-form').style.display = 'block';
            document.getElementById('edit-button').style.display = 'none';
            document.getElementById('owner-image-upload').style.display = 'block';
            document.getElementById('save-button').style.display = 'inline-block';
        }

        // Opslaan van aangepaste owner gegevens via AJAX PUT request
        function saveOwnerSection(id) {
            const data = {
                name: document.getElementById('edit-name').value,
                paragraph_1: document.getElementById('edit-p1').value,
                paragraph_2: document.getElementById('edit-p2').value,
                paragraph_3: document.getElementById('edit-p3').value,
            };

            fetch('/admin/owner-section/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(response => {
                    // Bij succes update de zichtbare content met nieuwe data
                    document.getElementById('display-name').innerText = data.name;
                    document.getElementById('display-p1').innerText = data.paragraph_1;
                    document.getElementById('display-p2').innerText = data.paragraph_2;
                    document.getElementById('display-p3').innerText = data.paragraph_3;

                    // Wissel weer terug naar weergave modus
                    document.getElementById('owner-display').style.display = 'block';
                    document.getElementById('owner-edit-form').style.display = 'none';
                    document.getElementById('owner-image-upload').style.display = 'none';
                    document.getElementById('edit-button').style.display = 'inline-block';
                    document.getElementById('save-button').style.display = 'none';

                    alert('Inhoud succesvol opgeslagen!');
                })
                .catch(error => {
                    console.error('Fout bij opslaan:', error);
                    alert('Er is iets misgegaan bij het opslaan.');
                });
        }
    </script>
@endif

<!-- Upload functie voor owner afbeelding -->
<script>
    function uploadOwnerImage(input) {
        const id = input.dataset.id;
        const file = input.files[0];

        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        fetch('/admin/owner-section/upload-image/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update de afbeelding preview na succesvolle upload
                    document.getElementById('owner-image-preview').src = data.image_url;
                    alert('Afbeelding succesvol geüpload!');
                } else {
                    alert('Fout bij uploaden van afbeelding.');
                }
            })
            .catch(error => {
                console.error('Uploadfout:', error);
                alert('Er is een fout opgetreden.');
            });
    }
</script>

</html>
@endsection
