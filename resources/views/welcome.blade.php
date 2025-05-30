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
</section>
<div class="gallery">
    <div class="slides">
        <img src="https://webdog.doggywonderland.nl/images/K6A5138-DoggywonderlandhondenopvangkennelvrijroedelKitty3.jpeg" class="slide active">
        <img src="https://www.dierenpensionrenswoude.nl/wp-content/uploads/2022/09/foto-groep-25-1.jpg" class="slide">
        <img src="http://www.deroedelthuis.com/wp-content/uploads/simple_photo_gallery/1/p1040326.jpg" class="slide">
    </div>
</div>
<section class="owner-section">
    <div class="owner-container">
        <div class="owner-image">
            <img src="../images/Yuma1.jpg" alt="Yuma de Koning">
        </div>
        <div class="owner-info">
            <h2>Yuma de Koning</h2>
            <p>Yuma de Koning is de trotse eigenaar en oprichter van Puppy Power Academy. Met meer dan 15 jaar ervaring in hondentraining en -verzorging, heeft Yuma een passie voor het helpen van honden en hun eigenaren om het beste uit elkaar te halen.</p>
            <p>Haar filosofie is gebaseerd op positieve bekrachtiging en het opbouwen van een sterke band tussen hond en eigenaar. Yuma is gecertificeerd in verschillende hondentrainingsmethoden en blijft zich constant bijscholen om de nieuwste inzichten in hondengedrag toe te passen.</p>
            <p>Bij Puppy Power Academy staat Yuma bekend om haar geduld, expertise en liefde voor alle honden, van kleine pups tot volwassen honden met speciale behoeften.</p>
        </div>
    </div>
</section>
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
