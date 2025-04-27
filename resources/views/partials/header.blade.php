<header>
    <div class="logo">
        <h1 class="logo"><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
        @if (Auth::check())
            <a> Welkom {{ Auth::user()->name }}! </a>

        @else
        @endif
    </div>

    <nav>
        <a href="/">Home</a>
        <a href="/shop" class="active">Shop</a>
        <a href="/training">Training</a>
        <a href="/dagopvang">Dagopvang</a>
        <a href="/contact">Contact</a>
        @if (!Auth::check())
        <a href="/login">Inloggen</a>
        <a href="/register">Register</a>
        @else
                <a href="/profile">
                    {{ __('Profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="/logout"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>

        @endif
        <!-- Winkelmandje in de navigatie -->
        <div id="winkelmandje" >
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cart-count">0</span>
        </div>
    </nav>
</header>

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

        // Winkelmandje knop in menu
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
            window.location.href = '{{ route("payment") }}'; // Redirect naar betaalpagina
        });

        // Init winkelmandje bij pagina laden
        updateCart();
    });
</script>
