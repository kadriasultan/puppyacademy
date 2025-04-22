@extends('layouts.app')

@section('content')
    <div class="contact-page">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Contacteer Ons</h1>
        <p>Hebt u een vraag? Neem contact met ons op.</p>

        <form method="POST" action="{{ route('contact.send') }}" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Uw vraag</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit">Verzenden</button>
        </form>

        <div class="contact-info">
            <h2>Onze locatie:</h2>

            <div class="info-grid">
                <div class="info-column">
                    <h3>Contactgegevens</h3>
                    <p>Telefoon: 012-3456789</p>
                    <p>Email: info@puppyacademy.nl</p>
                </div>

                <div class="info-column">
                    <h3>Locatie</h3>
                    <p>Hondenstraat 123</p>
                    <p>1234AB Amsterdam</p>
                </div>

                <div class="info-column">
                    <h3>Openingstijden</h3>
                    <p>Ma-Vr: 9:00 - 18:00</p>
                    <p>Za: 10:00 - 16:00</p>
                    <p>Zo: Gesloten</p>
                </div>
            </div>
        </div>
    </div>
@endsection
