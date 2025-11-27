<x-app-layout>


    @foreach($items as $item)
    <div class="Cart-Item" style="padding: 10px; margin: 10px; background-color: grey;">
        <img src={{ $item->product->image_url }} alt="Item Image">
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

</x-app-layout>