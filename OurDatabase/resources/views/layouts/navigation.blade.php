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

    .nav-btn {
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        font-size: 14px;
        font-weight: 500;
    }

    .nav-btn-dark {
        background: #333;
        color: #f0f0f0;
    }

    .nav-btn-dark:hover {
        background: #555;
        color: #f0f0f0;
    }

    .nav-btn-gold {
        background: #c19a6b;
        color: white;
    }

    .nav-btn-gold:hover {
        background: #a67c52;
        color: white;
    }

    .nav-icon img {
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .nav-icon:hover img {
        transform: scale(1.1);
        opacity: 0.8;
    }

    /* ── Top Nav ── */
    .nav-top {
        background: white;
        border-bottom: 1px solid #ddd;
        width: 100%;
        padding: 10px 0;
    }

    .nav-top-inner {
        max-width: 95vw;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-left {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .nav-left-icon {
        padding-right: 20px;
    }

    .nav-left-actions {
        flex: 1;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        column-gap: 10px;
        flex-wrap: wrap;
    }

    .nav-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-logo {
        width: 250px;
        height: auto;
    }

    .nav-right {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        column-gap: 20px;
        flex-wrap: wrap;
    }

    /* ── Bottom Nav ── */
    .nav-bottom {
        background: white;
        border-bottom: 1px solid #ddd;
        width: 100%;
        padding: 3px 0;
    }

    .nav-list {
        display: flex;
        justify-content: space-evenly;
        padding: 5px;
        margin: 0;
        list-style: none;
    }
</style>

{{-- Top Nav: Auth + Logo + Icons --}}
<nav class="nav-top">
    <div class="nav-top-inner">

        {{-- Left: Auth Buttons --}}
        <div class="nav-left">
            <a href="/dashboard" class="nav-left-icon">
                <img src="{{ asset('user.png') }}" alt="User">
            </a>

            <div class="nav-left-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-btn nav-btn-dark">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-btn nav-btn-gold"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-dark">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-btn nav-btn-gold">Register</a>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Center: Logo --}}
        <div class="nav-center">
            <a href="/">
                <img src="{{ asset('revivalthreadsdarksimple.png') }}" alt="Revival Threads" class="nav-logo">
            </a>
        </div>

        {{-- Right: Icons --}}
        <div class="nav-right">
            @if(auth()->check() && auth()->user()->is_admin)
                @include('components.notifications')
            @endif

            <a href="/cart" class="nav-icon">
                <img src="{{ asset('shopping-cart.png') }}" alt="Cart">
            </a>
        </div>

    </div>
</nav>

{{-- Bottom Nav: Page Links --}}
<nav class="nav-bottom">
    <div class="nav__menu">
        <ul class="nav-list">
            <li>
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="/products" class="nav-link {{ request()->is('products') ? 'active' : '' }}">Products</a>
            </li>
            <li>
                <a href="/orders" class="nav-link {{ request()->is('orders') ? 'active' : '' }}">Orders</a>
            </li>
            <li>
                <a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            </li>
            <li>
                <a href="/aboutus" class="nav-link {{ request()->is('aboutus') ? 'active' : '' }}">About Us</a>
            </li>
        </ul>
    </div>
</nav>
