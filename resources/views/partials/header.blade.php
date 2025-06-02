<header>
    <div class="logo">
        <h1><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
        @if (Auth::check())
            <a>Welkom {{ Auth::user()->name }}!</a>
        @endif
    </div>

    <button class="burger" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav id="main-nav" >
        <a href="/" class="auth-btn">Home</a>
        <a href="/shop" class="auth-btn">Shop</a>
        <a href="/training" class="auth-btn">Training</a>
        <a href="/dagopvang" class="auth-btn">Dagopvang</a>
        <a href="/contact" class="auth-btn">Contact</a>

        @if (!Auth::check())
            <a href="/login" class="auth-btn">Inloggen</a>
            <a href="/register" class="auth-btn">Register</a>
        @else
            <a href="/profile">{{ __('Profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        @endif

        <div id="winkelmandje">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cart-count">0</span>
        </div>
    </nav>
</header>
<style>
    nav a {
        color: white;
    }

    @media (max-width: 768px) {
        nav.show a {
            color: black;
        }
    }

</style>




<!-- Winkelmandje -->
<div id="cart-popup">
        🛒
        <span id="cart-count-popup"></span>


    <ul id="cart-items" style="list-style: none; padding: 10px 0 0 0; margin: 0; display: none;"></ul>

    <p id="total-price" style="margin-top: 10px; font-weight: bold; display: none;">Totaal: €0,00</p>

    <button id="checkout-button">
        Bestelling afronden
    </button>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartButton = document.getElementById('winkelmandje');
        const cartPopup = document.getElementById('cart-popup');
        const cartItemsList = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');
        const totalPriceElement = document.getElementById('total-price');
        const checkoutButton = document.getElementById('checkout-button');

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function updateCart() {
            cartItemsList.innerHTML = '';
            let total = 0;
            cart.forEach((item, index) => {
                const li = document.createElement('li');
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

                cartItemsList.appendChild(li);
                total += item.price;
            });

            cartCount.innerText = cart.length;
            if (cart.length > 0) {
                totalPriceElement.innerText = `Totaal: €${total.toFixed(2).replace('.', ',')}`;
            }
        }

        // Winkelmandje in menu
        cartButton.addEventListener('click', function () {
            if (cartPopup.style.display === 'none' || cartPopup.style.display === '') {
                cartPopup.style.display = 'block';
                updateCart();
            } else {
                cartPopup.style.display = 'none';
            }
        });

        // Checkout knop
        checkoutButton.addEventListener('click', function () {
            window.location.href = '{{ route("payment") }}';
        });

        // Init winkelmandje bij pagina laden
        updateCart();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.bestellen-button');
        const cartItems = document.getElementById('cart-items');
        const cartpopup = document.getElementById('cart-popup');
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

        document.addEventListener('click', function (event) {
            const isClickInside = winkelmandje.contains(event.target) || cartItems.contains(event.target);
            if (!isClickInside) {
                cartpopup.style.display = 'none';
            }
        });


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
            }
        });

        checkoutButton.addEventListener('click', function (e) {
            e.stopPropagation();
            window.location.href = '{{ route("payment") }}';
        });

        // Init winkelmandje bij pagina laden
        updateCart();
    });
</script>
<script>
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('nav');

    burger.addEventListener('click', () => {
        nav.classList.toggle('show');
    });

    document.addEventListener('click', (event) => {
        const isClickInside = nav.contains(event.target) || burger.contains(event.target);
        if (!isClickInside) {
            nav.classList.remove('show');
        }
    });
</script>


