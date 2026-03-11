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

    </header>

        <div>
            <img src="horse-lead-cropped.jpg" alt="" style="width: 100%;justify-content: center;">
        </div>

        <section>


            <div class="productStrip" style="
                padding:40px;
                gap:15px;
                display:flex;
                justify-content:flex-start;
                ">

                <div class="sectionHeader" style="
                width:150px;
                display: flex;
                justify-content: center;
                align-items: center;
                ">

                        <p style="
                        font-size: 20px;
                        text-align: center;
                        text-
                        ">

                            Men's New </p>
                    <!-- <img src="close-up.jpg" alt="" style="width: 20%; padding: 25px 10px"> -->
                </div>

                <div class="productGrid" style="display:flex; flex-wrap:wrap; justify-content:flex-start; gap: 15px;">

                    <div style="height: 200px; width: 150px; display:flex; justify-content: center; align-content:flex-end; flex-wrap: wrap; background: white; padding: 15px; border-radius: 5px;">
                        <img src="" alt="product" style="">
                        <h3 style="margin: 5px">PRODUCT X</h3>
                        <p style="color: #c19a6b; font-weight: bold; margin: 0">X GBP</p>
                    </div>

                    <div style="height: 200px; width: 150px; background: white; padding: 15px; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                        <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                        <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                        <img src="" alt="product">
                    </div>

                    <div style="height: 200px; width: 150px; background: white; padding: 15px; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                        <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                        <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                        <img src="" alt="product">
                    </div>

                    <div style="height: 200px; width: 150px; background: white; padding: 15px; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                        <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                        <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                        <img src="" alt="product">
                    </div>

                    <div style="height: 200px; width: 150px; background: white; padding: 15px; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                        <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                        <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                        <img src="" alt="product">
                    </div>

                    <div style="height: 200px; width: 150px; background: white; padding: 15px; border-radius: 10px;">
                        <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                        <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                        <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                        <img src="" alt="product">
                </div>

            </div>

        </section>

    <main style="max: width 90%; padding: 20px;">

        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #222;">Quality Clothing for Everyday</h2>
            <p style="color: #555;">Simple, Sturdy, Sustainable</p>
        </div>

        <div class="productGrid" style="display:flex; flex-wrap:wrap; justify-content:flex-start; gap: 15px;">

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>

                <div style="height: 300px; width: 200px; background: white; padding: 15px; border-radius: 10px;">
                    <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                    <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                    <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                    <img src="" alt="product">
                </div>
            </div>

        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="/products" style="background: #c19a6b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                Shop All Products
            </a>
        </div>
    </main>

    <footer style="background: #333; color: white; text-align: center; padding: 10px;">
        <p style="margin: 0;">&copy; {{ date('Y') }} Revival Threads </p>
    </footer>

</body>
</html>
