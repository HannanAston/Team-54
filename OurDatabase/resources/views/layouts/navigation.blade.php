<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Revival Threads | Gear Up</title>
</head>

<body style="font-family: sans-serif; margin: 0; background: #f5f5f5;">

    <header class="header" style="
        position: sticky;
        top: 0;
        z-index: 1000;">
        <nav style="
        background: white;
        border-bottom: 1px solid #ddd;
        color: white;
        width: 100%;
        padding: 5px 0;">

            <div style="
            max-width: 95vw;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;">

                <!-- Left Icons -->
                <div style="flex: 1; display: flex; align-items: center;">
                <a href="/dashboard">     <img src="user.png" style="color: #c19a6b; padding-right: 20px">       </a>

                    <div style="
                        flex: 1;
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                        column-gap: 10px;
                        flex-wrap: wrap;">
                        @auth
                            <a href="{{ url('/dashboard') }}" style="background: #f0f0f0; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                                Dashboard
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="route('logout')" style="background: #c19a6b; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                        @else
                            <a href="{{ route('login') }}" style="background: #333; color: #f0f0f0; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" style="background: #c19a6b; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>

            </div>

            <!-- Center: Logo -->
            <div style="display: flex; justify-content: center; align-items: center;">
                <a href="/"><img src="revival_threads_text_transparent_logo.png"
                    alt=""
                    style="width: 250px; height: auto;">
                </a>
            </div>

                <!-- Right Buttons -->
                <div style="
                    flex: 1;
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    column-gap: 20px;
                    flex-wrap: wrap;
                ">
                    @auth
                        @if (auth()->user()->is_admin)
                            <div>@include('components.notifications')</div>
                        @endif
                    @endauth

                    <a href=""> <img src="heart.png" alt=""> </a>

                    <a href="/cart"> <img src="shopping-cart.png" alt=""> </a>



                </div>

            </div>
        </nav>

        <nav style="
        background: white;
        border-bottom: 1px solid #ddd;
        color: white;
        width: 100%;
        padding: 5px 0;">

            <div class="nav__menu">

                <ul class="nav__list" style="
                    display:flex;
                    justify-content: space-evenly;
                    padding: 5px;
                    margin: 0;
                    text-decoration: none;">
                    <li> <a href="/" class="nav__link" style="padding: 5px; text-decoration: none; color: #333 "> Home </a></li>
                    <li> <a href="products" class="nav__link" style="padding: 5px; text-decoration: none; color: #333"> Products  </a></li>
                    <li> <a href="#" class="nav__link" style="padding: 5px; text-decoration: none; color: #333"> NEW  </a></li>
                    <li> <a href="contact" class="nav__link" style="padding: 5px; text-decoration: none; color: #333"> Contact </a></li>
                    <li> <a href="aboutus" class="nav__link" style="padding: 5px; text-decoration: none; color: #333"> About Us  </a></li>
                </ul>

            </div>

        </nav>