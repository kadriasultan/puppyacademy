@extends('layouts.app')
@section('title', 'Puppy Power Academy - Home')
@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>


<section class="hero">
    <h2>Welkom bij Puppy Power Academy!</h2>
    <p>Dé plek voor puppytrainingen, hondenspullen en professionele dagopvang.</p>
</section>
<div class="gallery">
    <div class="slides">
        {{-- Afbeeldingen slideshow --}}
        <img src="https://webdog.doggywonderland.nl/images/K6A5138-DoggywonderlandhondenopvangkennelvrijroedelKitty3.jpeg" class="slide active">
        <img src="https://www.dierenpensionrenswoude.nl/wp-content/uploads/2022/09/foto-groep-25-1.jpg" class="slide">
        <img src="http://www.deroedelthuis.com/wp-content/uploads/simple_photo_gallery/1/p1040326.jpg" class="slide">
    </div>
</div>
@php
    // Controle of ingelogde gebruiker admin is (voor beheerdersrechten)
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

@if($owner)
    <section class="owner-section">
        <div class="owner-container">
            <div class="owner-image">
                {{-- Afbeelding van de eigenaar --}}
                <img id="owner-image-preview" src="{{ asset($owner->image) }}" alt="{{ $owner->name }}" style="max-width: 200px;">

                @if($isAdmin)
                    {{-- Alleen admin mag eigenaar-afbeelding uploaden --}}
                    <input type="file" id="owner-image-upload" data-id="{{ $owner->id }}" style="display: none" onchange="uploadOwnerImage(this)">
                @endif
            </div>

            <div class="owner-info">
                <div id="owner-display">
                    {{-- Alleen admin mag eigenaar-afbeelding uploaden --}}
                    <h2 id="display-name">{{ $owner->name }}</h2>
                    <p id="display-p1">{{ $owner->paragraph_1 }}</p>
                    <p id="display-p2">{{ $owner->paragraph_2 }}</p>
                    <p id="display-p3">{{ $owner->paragraph_3 }}</p>
                </div>

                @if($isAdmin)
                    {{-- Formulier voor admin om eigenaarsteksten te bewerken --}}
                    <div id="owner-edit-form" style="display: none;">
                        <input type="text" id="edit-name" class="form-control" value="{{ $owner->name }}"><br>
                        <textarea id="edit-p1" class="form-control">{{ $owner->paragraph_1 }}</textarea><br>
                        <textarea id="edit-p2" class="form-control">{{ $owner->paragraph_2 }}</textarea><br>
                        <textarea id="edit-p3" class="form-control">{{ $owner->paragraph_3 }}</textarea><br>
                    </div>

                    {{-- Knoppen om te bewerken en op te slaan --}}
                    <div class="admin-controls mt-2">
                        <button id="edit-button" onclick="toggleEdit()">Bewerken</button>
                        <button id="save-button" onclick="saveOwnerSection({{ $owner->id }})" style="display: none;">Opslaan</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
{{-- Navigatie naar andere onderdelen van de site --}}
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
    <script>
        // Functie om het bewerkingsformulier te tonen en het display-formulier te verbergen
        function toggleEdit() {
            document.getElementById('owner-display').style.display = 'none';
            document.getElementById('owner-edit-form').style.display = 'block';
            document.getElementById('edit-button').style.display = 'none';
            document.getElementById('owner-image-upload').style.display = 'block';
            document.getElementById('save-button').style.display = 'inline-block';
        }
        // Functie om de gewijzigde eigenaargegevens via AJAX op te slaan
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

                    document.getElementById('display-name').innerText = data.name;
                    document.getElementById('display-p1').innerText = data.paragraph_1;
                    document.getElementById('display-p2').innerText = data.paragraph_2;
                    document.getElementById('display-p3').innerText = data.paragraph_3;


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
<script>
    // Uploadfunctie voor eigenaar-afbeelding via AJAX
    function uploadOwnerImage(input) {
        const id = input.dataset.id;
        const file = input.files[0];

        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        fetch('/admin/owner-section/upload-image/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Beveiligingstoken
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Bij succesvolle upload wordt de afbeelding geüpdatet op de pagina
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
