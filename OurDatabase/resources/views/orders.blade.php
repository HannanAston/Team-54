<x-app-layout>

    <head>
        <style>
            .orderCard {
                display: flex;
                height: 100%;
                padding: 15px;
                flex-wrap: wrap;
            }

            .Order-Item {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                margin: 15px;
                padding: 15px;
            }

            .OrderItems {
                min-width: 20%;
                display: flex;
                flex-direction: column;
                border-radius: 8px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                margin: 15px;
                padding: 5px;
            }

            .cancel {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .return {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .CancelButton {
                background-color: red;
                padding: 15px;
            }

            .ReturnButton {
                background-color: rgba(0, 0, 0, 0.2);
                padding: 15px;
            }

        </style>
    </head>

    @if(session('error'))
        <div class="alert-bad">{{ session('error') }}</div>
    @endif
    
    <div id="OrdersContainer">
        <p>Orders:</p>

        @foreach($orders as $order)
        <div class="Order-Item">
            <p>Order Date: {{ $order->created_at->format('d M Y') }}</p>
            <p>Order Status: {{ $order->order_status }}</p>
            <div class="orderCard">
                @foreach($order->orderItems as $orderItem)
                <div class="OrderItems">
                    <p>Name: {{ $orderItem->product->name }}</p>
                    <p>Price: {{ $orderItem->price }}</p>
                    <p>Quantity: {{ $orderItem->quantity }}</p>
                </div>
                @endforeach
            </div>
            <p>Order Total: {{ $order->total }}</p>

            @if ($order->order_status == "processing")
                <form class="cancel" action="{{ route('orders.updateStatus') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="newStatus" value="cancelled">
                    <button class="CancelButton">Cancel Order</button>
                </form>
            @elseif ($order->order_status == "return pending")
                <form class="cancel" action="{{ '/updateStatus' . $order . "cancel return" }}" method="POST">
                    @csrf
                    <button class="CancelButton">Cancel Return</button>
                </form>
            @elseif ($order->order_status == "completed")
                <form class="return"  action="{{ '/updateStatus' . $order . "return" }}" method="POST">
                    @csrf
                    <button class="ReturnButton">Return</button>
                </form>
            @endif

        </div>
        @endforeach
    </div>


</x-app-layout>