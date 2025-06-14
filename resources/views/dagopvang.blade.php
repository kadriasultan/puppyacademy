@extends('layouts.app')

@section('content')
    {{-- ntroductie van de dagopvang --}}
    <section class="hero">
        <h2>Dagopvang voor Honden</h2>
        <p>Een veilige, speelse en liefdevolle plek voor je hond wanneer jij er even niet kunt zijn.</p>
    </section>
    {{-- Fotogalerij slider met afbeeldingen van de opvang --}}
    <div class="foto-galerij">
        <h3>Een kijkje in onze dagopvang</h3>
        <div class="slider" id="fotoSlider">
            <img src="https://webdog.doggywonderland.nl/images/K6A5138-DoggywonderlandhondenopvangkennelvrijroedelKitty3.jpeg" alt="Hond 1">
            <img src="https://www.dierenpensionrenswoude.nl/wp-content/uploads/2022/09/foto-groep-25-1.jpg" alt="Hond 2">
            <img src="https://th.bing.com/th/id/R.6946ffc8943aad3ad2bf9ae8ec91b81b?rik=EACNYbNqKf3HYw&riu=http%3a%2f%2fwww.deroedelthuis.com%2fwp-content%2fuploads%2fsimple_photo_gallery%2f1%2fp1040326.jpg&ehk=NEtl0hGS58EGroLHiIbLfLopLO4qQyvdBAWbnb4lpuw%3d&risl=&pid=ImgRaw&r=0" alt="Hond 3">
            <img src="https://placedog.net/600/400?id=1" alt="Hond 4">
            <img src="https://placedog.net/600/400?id=2" alt="Hond 5">
            <img src="https://placedog.net/600/400?id=3" alt="Hond 6">
            <img src="https://placedog.net/600/400?id=4" alt="Hond 7">
        </div>
    </div>


    <div class="dagopvang-container">
        <div class="intro">
            <h3>Waarom kiezen voor onze dagopvang?</h3>
            <p>Onze professionele begeleiders zorgen voor structuur, beweging en ontspanning. Perfect voor honden die niet graag alleen zijn of gewoon een dagje uit verdienen.</p>
        </div>

        <div class="details">
            <h4>Wat bieden wij?</h4>
            <ul>
                <li>Individuele aandacht en socialisatie in kleine groepen</li>
                <li>Grote speelweides en rustruimtes</li>
                <li>Activiteiten afgestemd op leeftijd en energieniveau</li>
                <li>Updates met foto's en video's via WhatsApp</li>
            </ul>
        </div>

        <div class="praktisch">
            <h4>Praktische informatie</h4>
            <p><strong>Openingstijden:</strong> Maandag t/m Vrijdag, 08:00 - 18:00</p>
            <p><strong>Locatie:</strong> Hondencentrum Dierenrijk, Dagopvangstraat 12, 1234 AB Hondenstad</p>
            <p><strong>Prijs:</strong> €25 per dag, inclusief snacks en verzorging</p>
        </div>
        {{-- Inschrijfformulier voor intake wandeling --}}
        <div class="inschrijf-formulier">
            <h4>aanmelden voor een Intake</h4>

            {{-- Succesmelding na succesvolle inschrijving --}}
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif



            <form action="{{ route('dagopvang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf {{-- CSRF beveiliging --}}

                {{-- Gegevens eigenaar --}}
                <h2>Eigenaar Gegevens</h2>

                <label>Naam:
                    <input type="text" id="naam" name="naam" value="{{ old('naam', optional($user)->name) }}" required>
                </label><br>

                <label>E-mailadres:
                    <input type="email" id="email"  name="email" value="{{ old('email', optional($user)->email) }}" required>
                </label><br>

                <label>Telefoonnummer:
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', optional($user)->phone) }}" class="form-control @error('phone') is-invalid @enderror" required pattern="[0-9+\s\-()]{7,15}">
                    @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </label><br>
                {{-- Dropdown om hond te selecteren als deze aanwezig zijn --}}
                @if($dogs->count())
                    <label for="dog_select">Selecteer een hond (indien van toepassing):</label>
                    <select id="dog_select" name="dog_id">
                        <option value="">-- Selecteer een hond --</option>
                        @foreach($dogs as $dog)
                            {{-- Opties met data-attributen om formulier automatisch te vullen --}}
                            <option value="{{ $dog->id }}"
                                    ras="{{ $dog->ras }}"
                                    naam_hond="{{ $dog->naam_hond }}"
                                    geboortedatum="{{ $dog->geboortedatum }}"
                                    geslacht="{{ $dog->geslacht }}"
                                    foto="{{ asset($dog->foto) }}">
                                {{ $dog->naam_hond }} ({{ $dog->ras }})
                            </option>
                        @endforeach
                    </select><br>
                @endif


                <h2>Hond Gegevens voor Intake Wandeling</h2>

                <label>Naam van de hond:
                    <input type="text" id="naam_hond" name="naam_hond" value="{{ old('naam_hond') }}" required>
                </label><br>

                <label>Geboortedatum hond:
                    <input type="date" id="geboortedatum_hond" name="geboortedatum_hond" value="{{ old('geboortedatum_hond') }}" required>
                </label><br>

                <label>Ras:
                    <input type="text" id="ras" name="ras" value="{{ old('ras') }}" required>
                </label><br>

                <label>Geslacht:
                    <select id="geslacht" name="geslacht" required>
                        <option value="">-- Kies geslacht --</option>
                        <option value="Reu" {{ old('geslacht') == 'Reu' ? 'selected' : '' }}>Reu</option>
                        <option value="Teef" {{ old('geslacht') == 'Teef' ? 'selected' : '' }}>Teef</option>
                    </select>
                </label><br>

                <label>Foto hond uploaden:
                    <input type="file" id="foto_hond" name="foto_hond" accept="image/*" required>
                </label><br>
                {{-- Preview van geüploade hondfoto, standaard verborgen --}}
                <img id="hond_foto_preview" src="" alt="Foto van de hond" style="max-width: 250px; border-radius: 10px; display: none; margin-top: 1em;">

                <p style="margin-top: 1em; font-size: 0.9em; color: #555;">
                    Kosten inplannen kennismaking wandeling zijn <strong>€10,-</strong>.<br>
                    Deze moeten vooraf online voldaan worden.<br>
                    Daarna kun je zelf via mijn agenda je kennismaking wandeling inplannen.<br>
                    Duur wandeling: ongeveer 30 minuten.
                </p>

                <button type="submit">Intake Wandeling Boeken & Betalen</button>
            </form>


        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dogSelect = document.getElementById('dog_select');
            const naamHondInput = document.getElementById('naam_hond');
            const geboortedatumInput = document.getElementById('geboortedatum_hond');
            const rasInput = document.getElementById('ras');
            const geslachtInput = document.getElementById('geslacht');
            const hondFotoPreview = document.getElementById('hond_foto_preview');

            if (dogSelect) {
                dogSelect.addEventListener('change', function () {
                    const selectedOption = dogSelect.options[dogSelect.selectedIndex];

                    const naam_hond = selectedOption.getAttribute('naam_hond') || '';
                    const geboortedatum = selectedOption.getAttribute('geboortedatum') || '';
                    const ras = selectedOption.getAttribute('ras') || '';
                    const geslacht = selectedOption.getAttribute('geslacht') || '';
                    const foto = selectedOption.getAttribute('foto') || '';

                    naamHondInput.value = naam_hond;
                    geboortedatumInput.value = geboortedatum;
                    rasInput.value = ras;
                    geslachtInput.value = geslacht;

                    if(foto){
                        hondFotoPreview.src = foto;
                        hondFotoPreview.style.display = 'block';
                    } else {
                        hondFotoPreview.src = '';
                        hondFotoPreview.style.display = 'none';
                    }
                });
            }
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('voorkeursdatum');

            dateInput.addEventListener('input', function () {
                const selectedDate = new Date(this.value);
                const day = selectedDate.getDay(); // 0=zo, 1=ma, ..., 6=za

                // Toegestane dagen: maandag (1), dinsdag (2), donderdag (4)
                if (![1, 2, 4].includes(day)) {
                    alert('Kies een maandag, dinsdag of donderdag.');
                    this.value = '';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('#fotoSlider img');
            let index = 0;

            function showSlide(i) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[i].classList.add('active');
            }

            showSlide(index);

            setInterval(() => {
                index = (index + 1) % slides.length;
                showSlide(index);
            }, 4000); // elke 4 seconden
        });
    </script>
@endsection
