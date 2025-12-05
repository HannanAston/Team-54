<x-app-layout>

    <head>
        <style>
            .productImage {
                width: 250px;
                height: 250px;
                border-radius: 8px;
                object-fit: cover;
            }
            .productShow {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 10px;
                margin-top: 20px;

            }

        </style>
        <title> {{ $product->name }}</title>
    </head>
    <body>
        <div class="productShow">

            <h1>{{ $product->name }}</h1>
            <img class="productImage" src="{{ $product->image_url }}" alt="Item Image">
            <p>{{$product->description }}</p>
            <p>Price: £{{number_format($product->price, 2) }}</p>
        
            @if($product->stock_qty > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <x-primary-button>Add To Cart</x-primary-button>
                </form>
            @else
            <p>Out of stock</p>  
            @endif
        </div>


        <a href="{{ route('products.index') }}">Back</a>
    </body>
</x-app-layout>
