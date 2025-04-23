@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>DAGOPVANG VOOR HONDEN</h1>

        <div class="features">
            <ul>
                <li>Veilige, speelse omgeving</li>
                <li>Professionele begeleiding</li>
                <li>Flexibele tijden (halve/dagopvang)</li>
                <li>Live updates via app</li>
            </ul>
        </div>

        <div class="schedule">
            <h2>PLANNINGSOVERZICHT</h2>
            <p>Kees de tijd</p>
        </div>

        <div class="registration-form">
            <h2>Aanmelden</h2>
            <form method="POST" action="{{ route('dagopvang.store') }}">

            @csrf
                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="dog">Hond:</label>
                    <input type="text" id="dog" name="dog" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefoon:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="notes">Opmerkingen:</label>
                    <textarea id="notes" name="notes"></textarea>
                </div>

                <button type="submit" class="submit-btn">Verzend</button>
            </form>
        </div>

        <footer>
            <div class="footer-links">
                <a href="#">Contactgegevens</a>
                <a href="#">Locatie</a>
                <a href="#">Openingstijden</a>
            </div>
        </footer>
    </div>
@endsection
