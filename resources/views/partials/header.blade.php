<header>
    <div class="logo">
        <h1 class="logo"><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
        @if (Auth::check())
            <a> Welkom {{ Auth::user()->name }}! </a>
            <div>
                <x-responsive-nav-link :href="route('profile')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
        @endif
    </div>

    <nav>
        <a href="/">Home</a>
        <a href="/shop" class="active">Shop</a>
        <a href="/training">Training</a>
        <a href="/dagopvang">Dagopvang</a>
        <a href="/contact">Contact</a>
        <a href="/login">Inloggen</a>
        <a href="/register">Register</a>

        <!-- Winkelmandje in de navigatie -->
        <div id="winkelmandje" style="position: relative; cursor: pointer; padding: 8px 12px; border-radius: 8px; background-color: #026556; color: white;">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cart-count" style="background: red; color: white; border-radius: 50%; padding: 2px 8px; font-size: 14px; margin-left: 5px;">0</span>
        </div>
    </nav>
</header>

<!-- Winkelmandje popup bovenaan rechts -->
<div id="cart-popup" style="position: fixed; top: 20px; right: 20px; background: rgba(255, 255, 255, 0.9); padding: 15px; border-radius: 8px; width: 200px; z-index: 999; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: none;">
    <h4 style="margin: 0; display: flex; align-items: center;">
        🛒
        <span id="cart-count-popup" style="background: red; color: white; border-radius: 50%; padding: 2px 8px; font-size: 14px; margin-left: 8px;">0</span>
    </h4>

    <ul id="cart-items" style="list-style: none; padding: 10px 0 0 0; margin: 0; display: none;"></ul>

    <p id="total-price" style="margin-top: 10px; font-weight: bold; display: none;">Totaal: €0,00</p>

    <button id="checkout-button" style="margin-top: 10px; background: green; color: white; border: none; padding: 10px; border-radius: 8px; width: 100%; display: none; cursor: pointer;">
        Bestelling afronden
    </button>
</div>

<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #026556;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        position: relative;
    }

    .logo h1 {
        font-size: 24px;
        display: flex;
        align-items: center;
        color: inherit;
    }

    .logo h1 i {
        margin-right: 10px;
    }

    nav {
        display: flex;
        gap: 20px;
    }

    nav a {
        text-decoration: none;
        color: inherit;
        font-weight: 500;
    }

    nav a:hover {
        text-decoration: underline;
    }

    .active {
        font-weight: bold;
    }

    /* Winkelmandje styling */
    #winkelmandje {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: #026556;
        color: white;
    }

    #winkelmandje:hover {
        background-color: #034d40;
    }

    /* Winkelmandje popup styling */
    #cart-popup {
        display: none;
    }

    #cart-popup ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    #cart-popup button {
        background: green;
        color: white;
        padding: 10px;
        border-radius: 8px;
        width: 100%;
        cursor: pointer;
        border: none;
    }

    #cart-popup button:hover {
        background: darkgreen;
    }
</style>

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
