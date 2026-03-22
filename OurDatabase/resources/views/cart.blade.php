<x-app-layout>

    <head>
        <style>
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
        </style>
    </head>

    <div class="max-w-7xl mx-auto px-12 py-10">

        @if(session('error'))
            <div class="bg-red-500 text-white text-center p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-[#333] mb-10">Your Cart</h1>

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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- CART ITEMS -->
            <div class="lg:col-span-2 space-y-6">

                @if ($items->isEmpty())
                    <div class="example text-center">
                        <p class="mb-4">Your cart is empty</p>
                        <a href="{{ route('products.index') }}" class="shop-button">
                            Shop Now!
                        </a>
                    </div>
                @else

                    @foreach($items as $item)
                        <div class="example flex items-center">

                            <img class="w-24 h-24 object-contain rounded-lg mr-6"
                                 src="{{ $item->product->image_url }}">

                            <div class="flex-1">
                                <h2 class="font-semibold text-lg text-[#333]">
                                    {{ $item->product->name }}
                                </h2>

                                <p class="text-gray-600">
                                    £{{ $item->product->price }}
                                </p>
                            </div>

                            <div class="flex flex-col items-end space-y-2">

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
                                           class="border rounded px-2 py-1 w-20">
                                </form>

                                <form action="{{ auth()->check() ? '/delete-cartItem/' . $item->id : '/delete-cartItem/' . $item->product_id }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 hover:text-red-700 text-sm">
                                        Remove
                                    </button>
                                </form>

                            </div>
                        </div>
                    @endforeach

                @endif
            </div>

            <!-- ORDER SUMMARY -->
            <div class="example h-fit">

                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

                @if($isDiscountEligible)
                    <p class="text-green-600 mb-4">
                        🎉 You’ve unlocked a discount on this order!
                    </p>
                @else
                    <p class="text-gray-600 mb-4">
                        Complete {{ 5 - ($orderCount % 5) }} more order(s) to unlock a discount.
                    </p>
                @endif

                @foreach($items as $item)
                    <div class="flex justify-between mb-2 text-gray-700">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span>£{{ $item->product->price }}</span>
                    </div>
                @endforeach

                <hr class="my-4">

                <div class="flex justify-between text-gray-700">
                    <span>Subtotal</span>
                    <span>£{{ number_format($total, 2) }}</span>
                </div>

                @if($isDiscountEligible)
                    <div class="flex justify-between text-green-600 mt-2">
                        <span>Discount (5th Order)</span>
                        <span>-£{{ number_format($discount, 2) }}</span>
                    </div>
                @endif

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg mb-6">
                    <span>Total</span>
                    <span>£{{ number_format($finalTotal, 2) }}</span>
                </div>

                @if (!$items->isEmpty())
                    <form action="/checkout" method="POST">
                        @csrf
                        <button class="w-full bg-[#C19A6B] text-white py-3 rounded-lg hover:bg-[#333] transition">
                            Confirm Purchase
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>