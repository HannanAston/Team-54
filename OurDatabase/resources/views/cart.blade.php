<x-app-layout>

    <div style="display: flex; flex-direction: column; align-items: center;">
        @if($items->isEmpty())
            <p>No products found.</p>
        @else
            @foreach($items as $item)
            <div class="Cart-Item" style="padding: 10px; margin: 10px; background-color: grey; width: 50%; ">
                <img src={{ $item->product->image_url }} alt="Item Image" style="width: 250px; height: 250px; object-fit: cover;">
                <h1>{{ $item->product->name }}</h1>
                <p>{{ $item->product->price }}</p>

                <form action="/update-cartItem/{{ $item->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input onchange="this.form.submit()" name="quantity" type="number" id="qty" value={{ $item->quantity }} min="1" max="99">
                </form>
                <form action="/delete-cartItem/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Remove From Cart</button>
                </form>
            </div>
            @endforeach
            <div>
                <p style="font-size: 24px">{{ $total }}</p>
            </div>

            <form action="/checkout" method="POST">
                @csrf
                <button style="font-size: 28px;padding: 10px; margin: 10px; background-color: rgba(0,150,0,0.8); height: 70px;">Confirm Purchase</button>
            </form>
        @endif

    </div>

</x-app-layout>