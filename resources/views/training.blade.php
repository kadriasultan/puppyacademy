@extends('layouts.app')

@section('content')
    <div class="training-platform-page">


        <section class="training-header">
            <h1>Trainingsplatform</h1>
            <h2>Trainingen</h2>
        </section>

        <div class="training-cards-container">
            <div class="training-card">
                <h3>Puppytraining</h3>
                <p>Leer je pup de basiscommando's op een speelse manier.</p>
            </div>

            <div class="training-card">
                <h3>Vuurwerkangst</h3>
                <p>Training om je hond te helpen bij geluiden zoals vuurwerk.</p>
            </div>

            <div class="training-card">
                <h3>Gedragstraining</h3>
                <p>Voor honden met gedragsproblemen of extra begeleiding nodig hebben.</p>
            </div>
        </div>

        <section class="training-form-section">
            <h2>Trainingveldos</h2>
            <div class="kees-training-toggle">
                <h3 class="toggle-title">Kees de training <span class="toggle-icon">+</span></h3>
                <div class="training-list" style="display: none;">
                    <div class="training-item">
                        <h4>Puppytraining</h4>
                        <p>Leer je pup de basiscommando's op een speelse manier.</p>
                    </div>
                    <div class="training-item">
                        <h4>Vuurwerkangst</h4>
                        <p>Training om je hond te helpen bij geluiden zoals vuurwerk.</p>
                    </div>
                    <div class="training-item">
                        <h4>Gedragstraining</h4>
                        <p>Voor honden met gedragsproblemen of extra begeleiding nodig hebben.</p>
                    </div>
                </div>
            </div>

            <form class="training-form">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-primary">Inschrijven</button>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleTitle = document.querySelector('.toggle-title');
            const trainingList = document.querySelector('.training-list');
            const toggleIcon = document.querySelector('.toggle-icon');

            toggleTitle.addEventListener('click', function() {
                if (trainingList.style.display === 'none') {
                    trainingList.style.display = 'block';
                    toggleIcon.textContent = '-';
                } else {
                    trainingList.style.display = 'none';
                    toggleIcon.textContent = '+';
                }
            });
        });
    </script>
@endsection
