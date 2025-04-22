<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Puppy Power Academy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<header>
    <h1 class="logo"><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/shop" class="active">Shop</a>
        <a href="/training">Training</a>
        <a href="/opvang">Dagopvang</a>
        <a href="/contact">Contact</a>
    </nav>
</header>

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

<footer>
    &copy; {{ date('Y') }} Puppy Power Academy. Alle rechten voorbehouden.
</footer>

</body>
</html>
