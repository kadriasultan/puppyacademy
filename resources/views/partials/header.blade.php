<header>
    <h1 class="logo"><i class="fa-solid fa-paw"></i> Puppy Power Academy</h1>
    <div class="logo"> @if (Auth::check())
            <a> Welkom {{ Auth::user()->name }}! </a>

            <div>
                <x-responsive-nav-link :href="route('profile')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div >Welkom Gast!</div>
            <div><a href="/login">Inloggen</a></div>
            <div><a href="/register">Register</a></div>
        @endif
    </div>


    <nav>
        <a href="/">Home</a>
        <a href="/shop" class="active">Shop</a>
        <a href="/training">Training</a>
        <a href="/dagopvang">Dagopvang</a>
        <a href="/contact">Contact</a>



    </nav>

</header>
