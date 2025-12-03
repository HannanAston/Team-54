<x-app-layout>

    <h1>All Products</h1>

    <div style="display: flex; justify-content: center;">
        <form action="/products/search" method="GET">
            @csrf
            <input type="text" placeholder="Search" name="query">
            <button style="background-color: white; background-color: rgba(0,0,0,0.3);"><b>Go</b></button>
        </form>
        <form action="/products" method="GET" style="margin: 10px; background-color: rgba(0,0,0,0.3);">
            <button><b>Clear Search</b></button>
        </form>
    </div>

    <div style="display: flex; flex-wrap: wrap;">
        @if($products->isEmpty())
            <p>No products found.</p>
        @else
            @foreach($products as $product)

            
                <div style="background-color: rgba(0,0,0,0.2) ; margin: 10px ; width: 25%">
                    <img src={{ $product->image_url }} alt="Item Image">
                    <h1>{{ $product->name }}</h1>
                    <p>{{ $product->price }}</p>

                    <form action="/cart/add/{{ $product->id }}" method="POST">
                        @csrf
                        <button style="background-color: rgba(0,150,0,1)">Add to Cart</button>
                    </form>

                    <form action="/products/{{ $product->id }}" method="GET">
                        @csrf
                        <button style="background-color: rgba(0,0,0,0.5)">View Product</button>
                    </form>
                </div>
            @endforeach
        @endif

    </div>


</x-app-layout>