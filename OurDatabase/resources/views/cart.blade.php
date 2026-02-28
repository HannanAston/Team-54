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



        </style>
    </head>

    @if(session('error'))
        <div class="alert-bad">{{ session('error') }}</div>
    @endif
    
    <div id="cartContainer">

        <div id="Cart-Items">
            @foreach($items as $item)
            <div class="Cart-Item">
                <div class="productCard">
                    <img class="productImage" src="{{ $item->product->image_url }}" alt="Item Image">
                    <h1 class="text">{{ $item->product->name }}</h1>
                    <p class="text">£{{ $item->product->price }}</p>
                    <div class="productContent">

                        <div class="buttonContainer">
                            <form action="/update-cartItem/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                Quantity: <input onchange="this.form.submit()" name="quantity" type="number" value="{{ $item->quantity }}" min="1" max="99">
                            </form>
                            <form action="/delete-cartItem/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="productButtons">Remove From Cart</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @php
            $items = is_array($items) ? collect($items) : $items;
            $total = 0;
            foreach($items as $item) {
                $total += $item->product->price * $item->quantity;
            }
        @endphp

        <div id="menu">
            <p class="text"><b>Order Summary:</b></p>
            @foreach($items as $item)
                <h1 class="text">{{ $item->product->name }} x {{ $item->quantity }}</h1>
                <p class="text">£{{ $item->product->price }}</p>
            @endforeach
            <P class="text">Total: £ {{ $total }}</P>
            @if (!($items->isEmpty()))
                <form action="/checkout" method="POST">
                    @csrf
                    <button id="purchaseButton">Confirm Purchase</button>
                </form>
            @endif
        </div>

    </div>



</x-app-layout>