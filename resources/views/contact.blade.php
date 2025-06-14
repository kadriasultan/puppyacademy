@extends('layouts.app')

@section('content')
    <section class="hero">
        <h2>Contacteer Ons</h2>
        <p>We horen graag van je! Vul het onderstaande formulier in en wij nemen zo snel mogelijk contact met je op.</p>
    </section>
    <!-- Succesmelding tonen als sessie 'success' bestaat -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="contact-form-container">
        <form action="{{ route('contact.send') }}" method="POST">

        @csrf

            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefoonnummer</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required pattern="[0-9+\s\-()]{7,15}">
                @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="onderwerp">Onderwerp</label>
                <input type="text"  id="onderwerp" name="onderwerp" required class="form-control">

            </div>
            <div class="form-group">
                <label for="message">Bericht</label>
                <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                @error('message')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Verstuur Bericht</button>
        </form>
    </div>


@endsection
