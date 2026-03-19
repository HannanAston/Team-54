<x-app-layout>

<head>
    <style>
        .page {
            background-color: #f0f0f0;
            min-height: 100vh;
            padding: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .alert-bad {
            background-color: #ffe5e5;
            color: #b30000;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .order-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .Order-Item {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-date {
            font-size: 14px;
            color: #666;
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-processing {
            background-color: #f0f0f0;
            color: #666;
        }

        .status-completed {
            background-color: #c19a6b;
            color: #ffffff;
        }

        .status-cancelled {
            background-color: #333;
            color: #ffffff;
        }

        .status-return {
            background-color: #666;
            color: #ffffff;
        }

        .orderCard {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .product-link {
            text-decoration: none;
        }

        .OrderItems {
            height: 230px;
            border-radius: 10px;
            border: 1px solid #eee;
            padding: 12px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            transition: all 0.2s ease;
        }

        .OrderItems:hover {
            transform: translateY(-3px);
            border-color: #c19a6b;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        }

        .item-image img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .item-name {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        .item-price {
            color: #666;
        }

        .item-qty {
            font-size: 12px;
            color: #666;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .order-total {
            font-weight: bold;
            color: #333;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .CancelButton {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .ReturnButton {
            background-color: #c19a6b;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .CancelButton:hover {
            background-color: #000;
        }

        .ReturnButton:hover {
            background-color: #a67c52;
        }

    </style>
</head>

<div class="page">

    @if(session('error'))
        <div class="alert-bad">{{ session('error') }}</div>
    @endif

    <div class="title">My Orders</div>

    <div class="order-container">
        @foreach($orders as $order)
        <div class="Order-Item">

            <div class="order-header">
                <div>
                    <div class="order-date">Order Date</div>
                    <div>{{ $order->created_at->format('d M Y') }}</div>
                </div>

                <div class="order-status 
                    @if($order->order_status == 'processing') status-processing
                    @elseif($order->order_status == 'completed') status-completed
                    @elseif($order->order_status == 'cancelled') status-cancelled
                    @elseif($order->order_status == 'return pending') status-return
                    @endif
                ">
                    {{ ucfirst($order->order_status) }}
                </div>
            </div>

            <div class="orderCard">
                @foreach($order->orderItems as $orderItem)

                <a href="{{ route('products.show', $orderItem->product->id) }}" class="product-link">
                    <div class="OrderItems">
                        <div class="item-image">
                            <img src="{{ $orderItem->product->image_url }}" alt="product image">
                        </div>
                        <div class="item-name">{{ $orderItem->product->name }}</div>
                        <div class="item-price">£{{ $orderItem->price }}</div>
                        <div class="item-qty">Qty: {{ $orderItem->quantity }}</div>
                    </div>
                </a>

                @endforeach
            </div>

            <div class="order-footer">
                <div class="order-total">Total: £{{ $order->total }}</div>

                <div class="actions">
                    @if ($order->order_status == "processing")
                        <form action="{{ route('orders.updateStatus') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="cancelled">
                            <button class="CancelButton">Cancel</button>
                        </form>

                    @elseif ($order->order_status == "return pending")
                        <form action="{{ route('orders.updateStatus') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="cancel return">
                            <button class="CancelButton">Cancel Return</button>
                        </form>

                    @elseif ($order->order_status == "completed")
                        <form action="{{ route('orders.updateStatus') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="returned">
                            <button class="ReturnButton">Return</button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

</x-app-layout>