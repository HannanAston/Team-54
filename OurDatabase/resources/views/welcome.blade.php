@section('title', 'Home')

<x-app-layout>

    <!-- ================= HERO bANNER ================= -->

    <section style="position:relative; background:#000; color:white;">

        <img src="far-cowboy.jpg" style="width:100%; height:650px; object-fit:cover; opacity:0.75;" alt="Revival Threads">

        <div
            style="
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        text-align:center;
        max-width:700px;
    ">

            <h1
                style="
            font-size:64px;
            letter-spacing:4px;
            margin-bottom:10px;
            font-weight:700;
        ">
                REVIVAL THREADS
            </h1>

            <p style="
            font-size:20px;
            color:#ddd;
            margin-bottom:30px;
        ">
                Resurrected. Restored. Reborn.
            </p>

            <a href="/products"
                style="
            background:#fff;
            color:#000;
            padding:14px 36px;
            text-decoration:none;
            font-weight:bold;
            letter-spacing:1px;
           ">
                SHOP COLLECTION
            </a>

        </div>
    </section>

    <!-- ================= PRODUCT CAROUSEL ================= -->


    <section style="background:#f0f0f0; color:#333; padding:70px 0;">

        <div style="max-width:1400px; margin:auto; padding:0 20px;">

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
                <h2 style="letter-spacing:3px;">FEATURED PRODUCTS</h2>

                <a href="/products"
                    style="
                border:1px solid #c19a6b;
                padding:8px 18px;
                text-decoration:none;
                color:#333;
                font-size:14px;
                background:#fff;
               ">
                    VIEW ALL
                </a>
            </div>

            <div style="position:relative;">

                <button onclick="scrollCarousel(-1)"
                    style="
                position:absolute;
                left:-10px;
                top:40%;
                z-index:10;
                background:#333;
                border:none;
                color:#f0f0f0;
                font-size:28px;
                padding:10px 14px;
                cursor:pointer;
            ">‹</button>

                <button onclick="scrollCarousel(1)"
                    style="
                position:absolute;
                right:-10px;
                top:40%;
                z-index:10;
                background:#333;
                border:none;
                color:#f0f0f0;
                font-size:28px;
                padding:10px 14px;
                cursor:pointer;
            ">›</button>

                <div id="productCarousel" class="carousel"
                    style="
                            display:flex;
                            gap:25px;
                            overflow-x:auto;
                            scroll-behavior:smooth;
                            padding-bottom:10px;
                            ">

                    @foreach ( $products as $product )
                        <a href="/products/{{ $product->id }}" style="min-width:260px; background:#fff; padding:12px;">
                            <img src="{{$product->image_url}}" style="width:100%; height:340px; object-fit:cover;">
                            <h4 style="margin-top:12px;">{{$product->name}}</h4>
                            <p style="color:#666;">{{$product->description}}</p>
                            <p style="font-weight:bold; color:#c19a6b;">{{ $product->price }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        function scrollCarousel(direction) {
            const container = document.getElementById('productCarousel');
            container.scrollBy({
                left: direction * 300,
                behavior: 'smooth'
            });
        }
    </script>

    <!-- ================= CATEGORY RIBBON ================= -->

    <section
        style="
    background:#333;
    padding:40px 20px;
    display:flex;
    gap:30px;
    justify-content:center;
    flex-wrap:wrap;
">

        <a href="/products?cat=tops" style="color:#f0f0f0; text-decoration:none; letter-spacing:2px;">TOPS</a>
        <a href="/products?cat=bottoms" style="color:#f0f0f0; text-decoration:none; letter-spacing:2px;">BOTTOMS</a>
        <a href="/products?cat=outerwear" style="color:#f0f0f0; text-decoration:none; letter-spacing:2px;">OUTERWEAR</a>
        <a href="/products?cat=accessories"
            style="color:#f0f0f0; text-decoration:none; letter-spacing:2px;">ACCESSORIES</a>
        <a href="/products?cat=shoes" style="color:#f0f0f0; text-decoration:none; letter-spacing:2px;">SHOES</a>

    </section>


    <!-- ================= NEW RIBBON ================= -->

    <section style="background:#f0f0f0; color:#333; padding:60px 20px;">

        <h2 style="text-align:center; letter-spacing:3px; margin-bottom:40px;">
            NEW ARRIVALS
        </h2>

        <div
            style="
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
        gap:30px;
        max-width:1200px;
        margin:auto;
    ">
            @foreach ($newArrivals as $product)
            <div style="background:#fff; padding:15px;">
                <img src="{{$product->image_url}}" style="width:100%; height:320px; object-fit:cover;">
                <h3 style="margin-top:15px;">{{$product->name}}</h3>
                <p style="color:#666;">{{$product->description}}</p>
                <p style="font-weight:bold; color:#c19a6b;">{{$product->price}}</p>
            </div>
            @endforeach

        </div>
    </section>


    <!-- ================= FEATURE BANNER ================= -->

    <section style="position:relative; background:#333; color:#f0f0f0;">

        <img src="cowboy-landscape.jpg" style="width:100%; height:500px; object-fit:cover; opacity:0.55;">

        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center;">

            <h2 style="font-size:44px; letter-spacing:2px;">
                FASHION WITHOUT WASTE
            </h2>

            <p style="color:#ddd; margin:20px 0;">
                Clothes that are made for a Lifetime.
            </p>

            <a href="/aboutus"
                style="
            border:1px solid #c19a6b;
            padding:12px 28px;
            color:#f0f0f0;
            text-decoration:none;
            background:rgba(0,0,0,0.2);
           ">
                OUR PROCESS
            </a>

        </div>
    </section>


    <!-- ================= TRENDING ================= -->

    <section style="background:#f0f0f0; color:#333; padding:60px 20px;">

        <h2 style="text-align:center; letter-spacing:3px; margin-bottom:40px;">
            TRENDING NOW
        </h2>

        <div
            style="
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:25px;
        max-width:1200px;
        margin:auto;
    ">
            @foreach ( $trending as $product )
            <div style="background:#fff; padding:12px;">
                <img src="{{$product->image_url}}" style="width:100%; height:260px; object-fit:cover;">
                <h4>{{$product->name}}s</h4>
                <p style="color:#c19a6b;">{{ $product->price }}</p>
            </div>
            @endforeach

        </div>
    </section>


    <!-- ================= lAST RIBBON ================= -->

    <section style="
    background:#333;
    color:#f0f0f0;
    text-align:center;
    padding:60px 20px;
">

        <h2 style="letter-spacing:2px;">
            GIVE CLOTHES A SECOND LIFE
        </h2>

        <p style="color:#ccc; margin:20px 0;">
            Join the movement toward sustainable streetwear.
        </p>

        <a href="/products"
            style="
        background:#c19a6b;
        color:#fff;
        padding:14px 36px;
        text-decoration:none;
        font-weight:bold;
       ">
            START SHOPPING
        </a>

    </section>


</x-app-layout>
