<x-app-layout>
    <div style="display: flex; flex-direction: column; align-items: center;">
        <h1 style="font-size: 48px; margin-bottom: 150px;">Order Placed Successfully!</h1>

        <div style="font-size: 30px; margin-bottom: 50px;">
            <p>Order ID: {{ $order->id }}</p>
            <p>Subtotal: £{{$subtotal}}</p>
            <p>Discount: £{{$discount}}</p>
            <p>Total: £{{$total}}</p>  
        </div>

        <div>
            <h2 style="justify-self: center">Order Items:</h2>
            <ul style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                @foreach($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} x {{ $item->quantity }} - £{{$item->price * $item->quantity }}
                    </li>
                @endforeach
            </ul>   
        </div>


        <a  style="background-color: rgba(88, 209, 147,1); width: 100px; height: 70px; text-align: center; text-justify: center; padding: 10px"href="{{ route('products') }}" >Continue Shopping</a>
    </div>
</x-app-layout>
