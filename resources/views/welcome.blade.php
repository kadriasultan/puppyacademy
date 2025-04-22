@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puppy Power Academy - Home</title>
</head>

<body>


<section class="hero">
    <h2>Welkom bij Puppy Power Academy!</h2>
    <p>Dé plek voor puppytrainingen, hondenspullen en professionele dagopvang.</p>
    <a href="/shop">Bekijk onze Shop</a>
</section>
<div class="container">
    <a href="/shop">
        <div class="inhoud">
            <h1><i class="fa-solid fa-cart-shopping"></i></h1>
            <h3>Shop voor hondenproduct</h3>
        </div>
    </a>
    <a href="/opvang">
    <div class="inhoud">
        <h1><i class="fa-solid fa-house-chimney"></i></h1>
        <h3>Dagopvang</h3>
    </div>
    </a>
    <a href="/training">
    <div class="inhoud">
        <h1><i class="fa-solid fa-shield-dog"></i></h1>
        <h3>Training</h3>
    </div>
    </a>
</div>




</body>
</html>
@endsection
