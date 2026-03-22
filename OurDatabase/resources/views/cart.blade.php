<x-app-layout>

    <head>
        <style>
            .layout {
                display: flex;
                flex-wrap: wrap;
                gap: 30px;
            }

            .cart-items {
                flex: 2;
                min-width: 300px;
            }

            .order-summary {
                flex: 1;
                min-width: 300px;
            }

            .example {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }

            .example:hover {
                box-shadow: 0px 5px 12px rgba(0,0,0,0.15);
            }

            .shop-button {
                background-color: rgb(193, 154, 107);
                border-radius: 10px;
                color: white;
                padding: 15px;
                display: inline-block;
                text-align: center;
            }

            .cart-item {
                display: flex;
                align-items: center;
            }

            .item-info {
                flex: 1;
            }

            .item-actions {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 8px;
            }

            .summary-title {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 15px;
            }

            .summary-row {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                color: #333;
            }

            .summary-total {
                display: flex;
                justify-content: space-between;
                font-weight: bold;
                font-size: 18px;
                margin: 20px 0;
            }

            .text-green {
                color: green;
            }

            .text-red {
                color: red;
                text-align: center;
                padding: 10px;
                background-color: rgba(255,0,0,0.6);
                border-radius: 5px;
                margin-bottom: 20px;
                color: white;
            }

            .checkout-button {
                width: 100%;
                background-color: #C19A6B;
                color: white;
                padding: 12px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
            }

            .checkout-button:hover {
                background-color: #333;
            }

            .quantity-input {
                width: 80px;
                padding: 5px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .remove-button {
                color: red;
                font-size: 14px;
                background: none;
                border: none;
                cursor: pointer;
            }
        </style>
    </head>

    <div class="max-w-7xl mx-auto px-12 py-10">

        @if(session('error'))
            <div class="text-red">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="summary-title">Your Cart</h1>

        @php
            $items = is_array($items) ? collect($items) : $items;

            $orderCount = auth()->check() ? auth()->user()->orders()->count() : 0;
            $isDiscountEligible = $orderCount > 0 && $orderCount % 5 === 0;

            $total = 0;
            foreach($items as $item) {
                $total += $item->product->price * $item->quantity;
            }

            $discount = $isDiscountEligible ? $total * 0.10 : 0;
            $finalTotal = $total - $discount;
        @endphp

        <div class="layout">
            <div class="cart-items">

                @if ($items->isEmpty())
                    <div class="example">
                        <p>Your cart is empty</p>
                        <a href="{{ route('products.index') }}" class="shop-button">
                            Shop Now!
                        </a>
                    </div>
                @else

                    @foreach($items as $item)
                        <div class="example cart-item">

                            <img src="{{ $item->product->image_url }}" width="100" height="100" style="object-fit: contain; border-radius: 8px; margin-right: 20px;">

                            <div class="item-info">
                                <h3>{{ $item->product->name }}</h3>
                                <p>£{{ $item->product->price }}</p>
                            </div>

                            <div class="item-actions">

                                <form action="{{ auth()->check() ? '/update-cartItem/' . $item->id : '/update-cartItem/' . $item->product_id }}"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input onchange="this.form.submit()"
                                           name="quantity"
                                           type="number"
                                           value="{{ $item->quantity }}"
                                           min="1"
                                           max="99"
                                           class="quantity-input">
                                </form>

                                <form action="{{ auth()->check() ? '/delete-cartItem/' . $item->id : '/delete-cartItem/' . $item->product_id }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="remove-button">Remove</button>
                                </form>

                            </div>

                        </div>
                    @endforeach

                @endif

            </div>
            <div class="order-summary example">

                <div class="summary-title">Order Summary</div>

                @if($isDiscountEligible)
                    <div class="text-green">
                        🎉 You’ve unlocked a discount!
                    </div>
                @else
                    <div style="margin-bottom:15px;">
                        Complete {{ 5 - ($orderCount % 5) }} more order(s) to unlock a discount.
                    </div>
                @endif

                @foreach($items as $item)
                    <div class="summary-row">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span>£{{ $item->product->price }}</span>
                    </div>
                @endforeach

                <hr>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>£{{ number_format($total, 2) }}</span>
                </div>

                @if($isDiscountEligible)
                    <div class="summary-row text-green">
                        <span>Discount (5th Order)</span>
                        <span>-£{{ number_format($discount, 2) }}</span>
                    </div>
                @endif

                <div class="summary-total">
                    <span>Total</span>
                    <span>£{{ number_format($finalTotal, 2) }}</span>
                </div>

                @if (!$items->isEmpty())
                    <form action="/checkout" method="POST">
                        @csrf
                        <button class="checkout-button">
                            Confirm Purchase
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>