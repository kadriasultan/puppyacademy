<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puppy Power Academy - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

<header>

    <h1 class="logo"><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/shop">Shop</a>
        <a href="/training">Training</a>
        <a href="/opvang">Dagopvang</a>
        <a href="/contact">Contact</a>
    </nav>
</header>
<section class="hero">
    <h2>Welkom bij Puppy Power Academy!</h2>
    <p>Dé plek voor puppytrainingen, hondenspullen en professionele dagopvang.</p>
    <a href="/shop">Bekijk onze Shop</a>
</section>
<div class="container">
    <div class="inhoud">
        <h1><i class="fa-solid fa-cart-shopping"></i></h1>
        <h3>Shop voor hondenproduct</h3>
    </div>
    <div class="inhoud">
        <h1><i class="fa-solid fa-house-chimney"></i></h1>
        <h3>Dagopvang</h3>
    </div>
    <div class="inhoud">
        <h1><i class="fa-solid fa-shield-dog"></i></h1>
        <h3>Training</h3>
    </div>
</div>


<footer>
    &copy; {{ date('Y') }} Puppy Power Academy. Alle rechten voorbehouden.
</footer>

</body>
</html>
