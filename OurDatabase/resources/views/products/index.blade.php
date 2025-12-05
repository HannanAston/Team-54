<x-app-layout>
    <head>
        <style>
            #search {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                gap: 10px;
                padding: 10px;
            }

            #searchBar {
                min-width: 300px;
                max-width: 600px;
                padding: 10px;
                border-radius: 8px;
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                font-size: 16px;
                box-shadow: 0px 5px 10px rgba(0,0,0,0.05);
            }

            .searchButtons {
                background-color: rgba(255, 255, 255, 1);
                border-radius: 8px;
                border-width: 1px;
                border-color: rgba(0, 0, 0, 0.2);
                height: 40px;
                padding: 0 15px;
                flex-shrink: 0;
                box-shadow: 0px 5px 10px rgba(0,0,0,0.05);
            }

            .searchButtons:hover {
                background-color: rgba(0, 0, 0, 0.1);
                transform-origin: 10px;
            }

            #search form {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            #ProductContainer {
                display: flex;
                flex-wrap: wrap;
            }

            .productCard {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                background-color: rgba(255, 255, 255, 1);
                min-width: 250px;
                min-height: 250px;
                margin: 10px;
                border-radius: 8px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            }

            .productCard:hover {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                transform: scale(1.05);
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            }

            .productCard form {
                width: 100%;
                bottom: 0;
            }

            .productButtons{
                min-width: 100%;
                background-color: rgba(255, 255, 255, 1);
                margin: bottom;
                border-radius: 8px;
            }

            .productButtons:hover {
                background-color: rgba(255, 255, 255, 0.5);
            }

            .buttonContainer {
                width: 100%;
                padding: 5px;
            }

            .buttonContainer form {
                padding: 2px;
            }


            .productImage {
                width: 250px;
                height: 250px;
                border-radius: 8px;
                object-fit: cover;
            }

        </style>
    </head>

    <h1>All Products</h1>

    <div id="search" >
        <form action="/products/search" method="GET">
            @csrf
            <input id='searchBar' type="text" placeholder="Search" name="query">
            <button class="searchButtons"><b>Go</b></button>
        </form>
        <form action="/products" method="GET">
            <button class="searchButtons"><b>Clear Search</b></button>
        </form>
    </div>

    <div id="ProductContainer">
        @if($products->isEmpty())
            <p>No products found.</p>
        @else
            @foreach($products as $product)


                <div class="productCard">
                    <a href="/products/{{ $product->id }}">
                        <img class="productImage" src="{{ $product->image_url }}" alt="Item Image">
                    </a>
                    <h1>{{ $product->name }}</h1>
                    <p>£{{ $product->price }}</p>




                </div>
            @endforeach
        @endif

    </div>


</x-app-layout>
