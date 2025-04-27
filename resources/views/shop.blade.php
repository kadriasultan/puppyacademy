@extends('layouts.app')

@section('content')
    <main class="shop-page">



        <!-- Shop secties -->
        <section class="shop-section">
            <h2 class="shop-heading">Cursussen</h2>
            <div class="shop-container">
                @foreach ([
                    ['img' => 'course1.jpg', 'title' => 'Puppy Start', 'desc' => 'Leer de basiscommando’s en socialisatie voor pups.', 'prijs' => '29,99'],
                    ['img' => 'course2.jpg', 'title' => 'Vuurwerkangst Training', 'desc' => 'Train je hond om kalm te blijven bij harde geluiden.', 'prijs' => '34,99'],
                    ['img' => 'course3.jpg', 'title' => 'Gedragstraining', 'desc' => 'Focus op blaffen, trekken aan de lijn en ander ongewenst gedrag.', 'prijs' => '39,99'],
                ] as $course)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $course['img']) }}" alt="{{ $course['title'] }}">
                        <h4 class="product-title">{{ $course['title'] }}</h4>
                        <p>{{ $course['desc'] }}</p>
                        <p class="prijs">€{{ $course['prijs'] }}</p>
                        <button class="bestellen-button">Bestellen</button>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="shop-section">
            <h2 class="shop-heading">DIY-pakketten</h2>
            <div class="shop-container">
                @foreach ([
                    ['img' => 'diy1.jpg', 'title' => 'Snuffelmat', 'desc' => 'Zelf maken en gebruiken om mentaal bezig te zijn.', 'prijs' => '15,99'],
                    ['img' => 'diy2.jpg', 'title' => 'Voerbal maken', 'desc' => 'Een speelbal waarin snoepjes verstopt zitten.', 'prijs' => '16,99'],
                    ['img' => 'diy3.jpg', 'title' => 'Hersenwerk Starterskit', 'desc' => 'Instructies en materialen voor zoekspelletjes.', 'prijs' => '17,99'],
                ] as $diy)
                    <div class="product-card">
                        <img src="{{ asset('images/' . $diy['img']) }}" alt="{{ $diy['title'] }}">
                        <h4 class="product-title">{{ $diy['title'] }}</h4>
                        <p>{{ $diy['desc'] }}</p>
                        <p class="prijs">€{{ $diy['prijs'] }}</p>
                        <button class="bestellen-button">Bestellen</button>
                    </div>
                @endforeach
            </div>
        </section>

    </main>

@endsection
