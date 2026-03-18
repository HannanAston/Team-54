<style>
    .nav-link {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        color: #555;
        border-bottom: 2px solid transparent;
        transition: all 0.2s ease-in-out;
    }

    .nav-link:hover {
        color: #333;
        border-bottom: 2px solid #c19a6b;
    }

    .nav-link.active {
        color: #111;
        border-bottom: 2px solid #c19a6b;
    }

    /* Buttons (login/register/dashboard/logout) */
    .nav-btn {
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .nav-btn-dark {
        background: #333;
        color: #f0f0f0;
    }

    .nav-btn-dark:hover {
        background: #555;
    }

    .nav-btn-gold {
        background: #c19a6b;
        color: white;
    }

    .nav-btn-gold:hover {
        background: #a67c52;
    }

    /* Icon hover */
    .nav-icon img {
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .nav-icon:hover img {
        transform: scale(1.1);
        opacity: 0.8;
    }
</style>

<nav
    style="
        background: white;
        border-bottom: 1px solid #ddd;
        color: white;
        width: 100%;
        padding: 5px 0;">

    <div
        style="
            max-width: 95vw;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;">

        <!-- Left Icons -->
        <div style="flex: 1; display: flex; align-items: center;">
            <a href="/dashboard"> <img src="user.png" style="color: #c19a6b; padding-right: 20px"> </a>

            <div
                style="
                        flex: 1;
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                        column-gap: 10px;
                        flex-wrap: wrap;">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-btn nav-btn-dark">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')" class="nav-btn nav-btn-gold"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-dark">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-btn nav-btn-gold">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

        </div>

        <!-- Center: Logo -->
        <div style="display: flex; justify-content: center; align-items: center;">
            <a href="/"><img src="revival_threads_text_transparent_logo.png" alt=""
                    style="width: 250px; height: auto;">
            </a>
        </div>

        <!-- Right Buttons -->
        <div
            style="
                    flex: 1;
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    column-gap: 20px;
                    flex-wrap: wrap;
                ">

            <a href="" class="nav-icon">
                <img src="heart.png" alt="">
            </a>

            <a href="/cart" class="nav-icon">
                <img src="shopping-cart.png" alt="">
            </a>



        </div>

    </div>
</nav>

<nav
    style="
        background: white;
        border-bottom: 1px solid #ddd;
        color: white;
        width: 100%;
        padding: 5px 0;">

    <div class="nav__menu">

        <ul class="nav__list"
            style="
                    display:flex;
                    justify-content: space-evenly;
                    padding: 5px;
                    margin: 0;
                    text-decoration: none;">

            <li>
                <a href="#" class="nav-link">
                    NEW
                </a>
            </li>

            <li>
                <a href="products" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                    Products
                </a>
            </li>

            <li>
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                    Contact
                </a>
            </li>

            <li>
                <a href="aboutus" class="nav-link {{ request()->is('aboutus') ? 'active' : '' }}">
                    About Us
                </a>
            </li>
        </ul>

    </div>

</nav>
