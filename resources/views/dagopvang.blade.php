@extends('layouts.app')

@section('content')

    <section class="hero">
        <h2>Dagopvang voor Honden</h2>
        <p>Een veilige, speelse en liefdevolle plek voor je hond wanneer jij er even niet kunt zijn.</p>
    </section>
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

        <div class="inschrijf-formulier">
            <h4>Inschrijven voor de dagopvang</h4>


            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <form action="{{ route('dagopvang.store') }}" method="POST">
                @csrf
                <div class="voorkeursdag-selectie">
                    <label for="voorkeursdatum">Kies een voorkeursdatum voor dagopvang:</label><br>
                    <input type="date" id="voorkeursdatum" name="voorkeursdatum" required>
                    <small style="color: gray;">Let op: alleen maandag, dinsdag of donderdag is mogelijk.</small>
                </div><br>
                <b2 for="eigenaar">Eigenaar Gegevens:</b2>
                {{-- Automatisch ingevulde gegevens als ingelogd --}}
                <label>Naam:
                    <input type="text" name="naam" value="{{ old('naam', optional($user)->name) }}" required>
                </label><br>

                <label>E-mailadres:
                    <input type="email" name="email" value="{{ old('email', optional($user)->email) }}" required>
                </label><br>
                <label>Telefoonnummer:
                    <input type="text" name="telefoon" value="{{ old('telefoon', optional($user)->phone) }}" required>
                </label><br>
                {{-- Alleen als gebruiker honden heeft --}}
                @if($dogs->count())
                    <label for="dog_select">Hond Gegevens:</label>
                    <select id="dog_select" name="dog_id">
                        <option value="">-- Selecteer een hond --</option>
                        @foreach($dogs as $dog)
                            <option value="{{ $dog->id }}"
                                    data-breed="{{ $dog->breed }}"
                                    data-name="{{ $dog->name }}"
                                    data-nickname="{{ $dog->nickname }}"
                                    age="{{ $dog->age }}">
                                {{ $dog->name }} ({{ $dog->breed }})

                            </option>
                        @endforeach
                    </select><br>
                @endif

                {{-- Altijd zichtbaar, eventueel automatisch ingevuld --}}
                <label>Soort hond:
                    <input type="text" id="soort_hond" name="soort_hond" value="{{ old('soort_hond') }}" required>
                </label><br>
                <label>Naam van de hond:
                    <input type="text" id="naam_hond" name="naam_hond" value="{{ old('naam_hond') }}" required>
                </label><br>
                <label>Roepnaam:
                    <input type="text" id="roepnaam" name="roepnaam" value="{{ old('roepnaam') }}" required>
                </label><br>
                <div class="form-group">
                    <label for="age">Leeftijd</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required min="1">
                </div>

                <label>Adres en postcode:
                    <input type="text" name="adres" value="{{ old('adres') }}" required>
                </label><br>

                <label>Woonplaats:
                    <input type="text" name="woonplaats" value="{{ old('woonplaats') }}" required>
                </label><br>


                <button type="submit">Inschrijven</button>
            </form>

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dogSelect = document.getElementById('dog_select');
            if (dogSelect) {
                dogSelect.addEventListener('change', function () {
                    const selected = this.options[this.selectedIndex];
                    document.getElementById('soort_hond').value = selected.dataset.breed || '';
                    document.getElementById('naam_hond').value = selected.dataset.name || '';
                    document.getElementById('roepnaam').value = selected.dataset.nickname || '';
                    document.getElementById('age').value = selected.getAttribute('age') || '';
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
