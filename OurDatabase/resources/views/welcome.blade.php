<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Revival Threads | Gear Up</title>
</head>
<body style="font-family: sans-serif; margin: 0; padding: 0; background: #f5f5f5;">

    <!-- Header with Navbar -->
    <header style="background: white; padding: 20px; border-bottom: 1px solid #ddd;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0; color: #333;">Revival Threads</h1>
                <p style="color: #666; margin: 5px 0 0 0;">Premium Clothing</p>
            </div>

            <div style="display: flex; gap: 10px;">
                @auth
                    <a href="{{ url('/dashboard') }}" style="background: #f0f0f0; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" style="background: #f0f0f0; color: #333; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
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
    </header>

    <!-- Main Content -->
    <main style="max-width: 800px; margin: 40px auto; padding: 20px;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #222;">Quality Clothing for Everyday</h2>
            <p style="color: #555;">Simple, Sturdy, Sustainable</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div style="background: white; padding: 15px; border-radius: 5px;">
                <h3 style="margin: 0 0 10px 0;"> Grey Hoodie </h3>
                <p style="color: #666; margin: 0 0 10px 0;">Grey Hoodie for general wear</p>
                <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                <img src="" alt="hoodie">
            </div>

            <div style="background: white; padding: 15px; border-radius: 5px;">
                <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                <img src="" alt="product">
            </div>

            <div style="background: white; padding: 15px; border-radius: 5px;">
                <h3 style="margin: 0 0 10px 0;">PRODUCT X</h3>
                <p style="color: #666; margin: 0 0 10px 0;">PRODUCT DESCRIPTION</p>
                <p style="color: #c19a6b; font-weight: bold;">X GBP</p>
                <img src="" alt="product">
            </div>

        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="/products" style="background: #c19a6b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                Shop All Products
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: #333; color: white; text-align: center; padding: 20px; margin-top: 40px;">
        <p style="margin: 0;">&copy; {{ date('Y') }} Revival Threads </p>
    </footer>

</body>
</html>
