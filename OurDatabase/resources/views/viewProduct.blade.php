<x-app-layout>

    <div >
        <div style="display: flex; justify-content: center; padding: 50px;">
            <a href="{{ route('products') }}" style="padding: 10px; margin: 10px; background-color: rgba(0,0,0,0.5); height: 50px;">Back</a>
            <img src="{{ $product->image_url }}"  style="width: 500px; height: 500px; object-fit: cover;">
            <div style="display: flex; flex-direction: column; padding: 10px;">
                <h1 style="font-size: 48px; self-al: center;">{{ $product->name }}</h1>
                <p style="font-size: 24px">Price: £{{number_format($product->price, 2) }}</p>
                <p>Stock: {{$product->stock_qty }}</p> 

                <form action="/cart/add/{{$product->id}}" method="POST" style="background-color: rgba(0,150,0,0.8); display: flex; margin-top: auto; margin-bottom: 50px; height: 50px; justify-content: center;">
                    @csrf
                    <button>Add to Cart</button>
                </form>
            </div>  
        </div>

        <p style="display: flex; justify-content: center; padding: 50px">{{$product->description }}</p>

    </div>


</x-app-layout>