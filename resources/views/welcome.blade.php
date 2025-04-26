@extends('layouts.app')
@section('title', 'Puppy Power Academy - Home')
@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


<section class="hero">
    <h2>Welkom bij Puppy Power Academy!</h2>
    <p>Dé plek voor puppytrainingen, hondenspullen en professionele dagopvang.</p>
    <a href="/shop">Bekijk onze Shop</a>
</section>
<div class="gallery">
    <div class="slides">
        <img src="https://webdog.doggywonderland.nl/images/K6A5138-DoggywonderlandhondenopvangkennelvrijroedelKitty3.jpeg" class="slide active">
        <img src="https://www.dierenpensionrenswoude.nl/wp-content/uploads/2022/09/foto-groep-25-1.jpg" class="slide">
        <img src="http://www.deroedelthuis.com/wp-content/uploads/simple_photo_gallery/1/p1040326.jpg" class="slide">
    </div>
</div>

<div class="container">
    <a href="/shop">
        <div class="inhoud">
            <h1><i class="fa-solid fa-cart-shopping"></i></h1>
            <h3>Shop voor hondenproduct</h3>
        </div>
    </a>
    <a href="/dagopvang">
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
