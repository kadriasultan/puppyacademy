@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Dog</h1>
        <form method="POST" action="{{ route('dogs.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            {{-- Inputveld voor de roepnaam of bijnaam --}}
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" required>
            </div>
            {{-- Inputveld voor het hondenras --}}
            <div class="form-group">
                <label for="breed">Breed</label>
                <input type="text" class="form-control" id="breed" name="breed" required>
            </div>
            {{-- Inputveld voor de leeftijd van de hond --}}
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" required min="1">
            </div>
            {{-- Knop om het formulier te verzenden (hond opslaan in database) --}}
            <button type="submit" class="btn btn-primary">Save Dog</button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
