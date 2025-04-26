@extends('layouts.app')

@section('content')
    <main class="shop-page">

        <!-- Winkelmandje bovenaan rechts -->
        <div id="winkelmandje" style="position: fixed; top: 20px; right: 20px; background: rgba(255, 255, 255, 0.9); border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 240px; z-index: 999; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h4 style="margin: 0; display: flex; align-items: center;">
                🛒
                <span id="cart-count" style="background: red; color: white; border-radius: 50%; padding: 2px 8px; font-size: 14px; margin-left: 8px;">0</span>
            </h4>

            <!-- Productenlijst -->
            <ul id="cart-items" style="list-style: none; padding: 10px 0 0 0; margin: 0; display: none;"></ul>

            <!-- Totaalprijs -->
            <p id="total-price" style="margin-top: 10px; font-weight: bold; display: none;">Totaal: €0,00</p>

            <!-- Bestelling afronden knop -->
            <button id="checkout-button" style="margin-top: 10px; background: green; color: white; border: none; padding: 10px; border-radius: 8px; width: 100%; display: none; cursor: pointer;">
                Bestelling afronden
            </button>
        </div>

        <!-- Shop secties -->
        <section class="shop-section">
            <h2 class="shop-heading">🐶 Cursussen</h2>
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
            <h2 class="shop-heading">🧠 DIY-pakketten</h2>
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

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.bestellen-button');
            const cartItems = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const winkelmandje = document.getElementById('winkelmandje');
            const totalPriceElement = document.getElementById('total-price');
            const checkoutButton = document.getElementById('checkout-button');

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function updateCart() {
                cartItems.innerHTML = '';
                let total = 0;
                cart.forEach((item, index) => {
                    const li = document.createElement('li');
                    li.style.marginBottom = '10px';
                    li.innerHTML = `
                <strong>${item.title}</strong><br>€${item.price.toFixed(2).replace('.', ',')}
                <button style="background: red; color: white; border: none; border-radius: 5px; margin-top: 5px; cursor: pointer;">Verwijderen</button>
            `;

                    li.querySelector('button').addEventListener('click', function (e) {
                        e.stopPropagation();
                        cart.splice(index, 1);
                        saveCart();
                        updateCart();
                    });

                    cartItems.appendChild(li);
                    total += item.price;
                });

                cartCount.innerText = cart.length;

                if (cart.length > 0) {
                    totalPriceElement.innerText = `Totaal: €${total.toFixed(2).replace('.', ',')}`;
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const productCard = button.closest('.product-card');
                    const title = productCard.querySelector('.product-title').innerText;
                    const priceText = productCard.querySelector('.prijs').innerText.replace('€', '').replace(',', '.');
                    const price = parseFloat(priceText);

                    cart.push({ title, price });
                    saveCart();
                    updateCart();
                });
            });

            winkelmandje.addEventListener('click', function () {
                if (cartItems.style.display === 'none' || cartItems.style.display === '') {
                    cartItems.style.display = 'block';
                    if (cart.length > 0) {
                        totalPriceElement.style.display = 'block';
                        checkoutButton.style.display = 'block';
                    }
                } else {
                    cartItems.style.display = 'none';
                    totalPriceElement.style.display = 'none';
                    checkoutButton.style.display = 'none';
                }
            });

            checkoutButton.addEventListener('click', function (e) {
                e.stopPropagation();
                window.location.href = '{{ route("payment") }}'; // 👉 Redirect to payment page
            });

            // Init winkelmandje bij pagina laden
            updateCart();
        });
    </script>

@endsection
