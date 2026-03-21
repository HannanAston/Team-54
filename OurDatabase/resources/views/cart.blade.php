<x-app-layout>

    <head>
        <style>

            #ProductContainer {
                display: flex;
                flex-wrap: wrap;
            }

            .productCard {
                display: flex;
                flex-direction: row;
                align-items: center;
                background-color: rgba(255, 255, 255, 1);
                min-width: 250px;
                min-height: 250px;
                margin: 10px;
                border-radius: 8px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            }

            .productButtons{
                min-width: 100%;
                background-color: rgba(255, 255, 255, 1);
                border-radius: 8px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                min-height: 50px;
            }

            .productButtons:hover {
                box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
            }

            .buttonContainer {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 5px;

            }

            .buttonContainer form {
                padding: 2px;
            }
            
            
            .productImage {
                min-width: 250px;
                min-height: 250px;
                max-width: 250px;
                max-height: 250px;
                border-radius: 8px;
                object-fit: cover;
            }

            #menu {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: rgba(255, 255, 255, 0.12);
                border-width: 2px;
                border-color: rgba(0, 0, 0, 0.1);
                box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
                width: 100%;
                height: 100vh;
            }

            #cartContainer {
                display: flex;
                height: 100%;
            }

            #Cart-Items {
                min-width: 70%;
                display: flex;
                flex-direction: column;
            }

            .text {
                width: 250px;
                text-align: center;
            }

            .productContent {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-end;
                width: 100%;
                padding: 20px;
            }

            #purchaseButton{
                min-width: 50%;
                background-color: rgba(40, 167, 69, 0.8);
                border-radius: 8px;
                box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                min-height: 50px;
                margin: 20px;
            }

            #purchaseButton:hover{
                background-color: rgba(40, 167, 69, 1);
                box-shadow: 0px 5px 10px rgba(0,0,0,0.2);

            }

            #menu form {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
            }

            .alert-bad {
                justify-self: center;
                text-align: center;
                align-self: center;
                width: 50%;
                background-color: rgba(255,0,0,0.6);
                border-radius: 5px;
            }

            .shop-button {
                background-color: rgb(193, 154, 107);
                border-radius: 10px;
                color: white;
                padding: 15px;
            }



        </style>
    </head>

    <div class="max-w-7xl mx-auto px-12 py-10">
        @if(session('error'))
            <div class="alert-bad">{{ session('error') }}</div>
        @endif
        <h1 class="text-3xl font-bold text-[#333] mb-10">Your Cart</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-6">
                @if (empty($items))
                    <p>Your cart is empty</p>
                    <div class="card">
                        <a href="{{ route('products.index') }}" class="shop-button">
                            Shop Now!
                        </a>
                    </div>
                @else

                    @foreach($items as $item)
                    <div class="Cart-Item">
                        <div class="flex items-center bg-white rounded-xl shadow-sm p-5">
                            <img class="w-24 h-24 object-contain rounded-lg mr-6" src="{{ $item->product->image_url }}">

                            <div class="flex-1">
                                <h2 class="font-semibold text-lg text-[#333]">
                                    {{ $item->product->name }}
                                </h2>

                                <p class="text-gray-600">
                                    £{{ $item->product->price }}
                                </p>
                            </div>

                            <div class="flex flex-col items-end space-y-2">
                                <form action="{{ auth()->check() ? '/update-cartItem/' . $item->id :'/update-cartItem/' . $item->product_id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input onchange="this.form.submit()" name="quantity" type="number" value="{{ $item->quantity }}" min="1" max="99" class="border rounded px-2 py-1 w-20">
                                </form>

                                <form action="{{ auth()->check() ? '/delete-cartItem/' . $item->id :'/delete-cartItem/' . $item->product_id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 gover:text-red-700 text-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            @php
                $items = is_array($items) ? collect($items) : $items;
                $total = 0;
                foreach($items as $item) {
                    $total += $item->product->price * $item->quantity;
                }
            @endphp

            <div class="bg-white rounded-xl shadow-sm p-6 h-fit">
                <h2 class="text-xl font-semibold mb-6">Order Summary:</h2>
                @foreach($items as $item)
                    <div class="flex justify-between mb-2 text-gray-700">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span>£{{ $item->product->price }}</span>
                    </div>
                @endforeach

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg mb-6">
                    <span>Total</span>
                    <span>£{{ $total }}</span>
                </div>

                @if (!($items->isEmpty()))
                <form action="/checkout" method="POST">
                    @csrf
                    <button class="w-full bg-[#C19A6B] text-white py-3 rounded-lg hover:bg-[#333] transition">Confirm Purchase</button>
                </form>
                @endif
            </div>

        </div>
    </div>


</x-app-layout>