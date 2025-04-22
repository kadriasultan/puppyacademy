@extends('layouts.app')
    @section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Puppy Power Academy</title>

</head>
<body>



<main class="shop-page">

    <section class="shop-section">
        <h2 class="shop-heading">🐶 Cursussen</h2>
        <div class="shop-container">
            <div class="product-card">
                <img src="{{ asset('images/course1.jpg') }}" alt="Puppy Start">
                <h4>Puppy Start</h4>
                <p>Leer de basiscommando’s en socialisatie voor pups.</p>
                <p class="prijs">€29,99</p>
                <button>Bestellen</button>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/course2.jpg') }}" alt="Vuurwerkangst Training">
                <h4>Vuurwerkangst Training</h4>
                <p>Train je hond om kalm te blijven bij harde geluiden.</p>
                <p class="prijs">€34,99</p>
                <button>Bestellen</button>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/course3.jpg') }}" alt="Gedragstraining">
                <h4>Gedragstraining</h4>
                <p>Focus op blaffen, trekken aan de lijn en ander ongewenst gedrag.</p>
                <p class="prijs">€39,99</p>
                <button>Bestellen</button>
            </div>
        </div>
    </section>

    <section class="shop-section">
        <h2 class="shop-heading">🧠 DIY-pakketten</h2>
        <div class="shop-container">
            <div class="product-card">
                <img src="{{ asset('images/diy1.jpg') }}" alt="Snuffelmat DIY">
                <h4>Snuffelmat</h4>
                <p>Zelf maken en gebruiken om mentaal bezig te zijn.</p>
                <p class="prijs">€15,99</p>
                <button>Bestellen</button>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/diy2.jpg') }}" alt="Voerbal maken">
                <h4>Voerbal maken</h4>
                <p>Een speelbal waarin snoepjes verstopt zitten.</p>
                <p class="prijs">€16,99</p>
                <button>Bestellen</button>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/diy3.jpg') }}" alt="Hersenwerk kit">
                <h4>Hersenwerk Starterskit</h4>
                <p>Instructies en materialen voor zoekspelletjes.</p>
                <p class="prijs">€17,99</p>
                <button>Bestellen</button>
            </div>
        </div>
    </section>

</main>


</body>
</html>
@endsection
