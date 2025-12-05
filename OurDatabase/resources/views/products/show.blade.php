<x-app-layout>

    <head>
        <style>

        #productContainer {
            width: 99vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        #productCard {
            display: flex;
            flex-direction: row;
            gap: 40px;
            width: 100%;
            max-width: 1200px;
            margin-bottom: 50px;
        }

        #back {
            height: 25%;
            padding: 10px 20px;
            background-color: rgba(255,255,255,1);
            box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
            border-width: 1px;
            border-color: rgba(0,0,0,0.1);
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #productImage {
            width: 500px;
            height: 500px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
        }

        #productContent {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            flex: 1;
        }

        #productContent h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        #productInfo {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #productInfo p {
            font-size: 24px;
        }

        #productInfo form button {
            padding: 12px 20px;
            font-size: 18px;
            background-color: rgb(40, 167, 69);
            color: white;
            border: none;
            border-radius: 5px;
        }

        #productInfo form button:hover {
            background-color: rgb(30, 140, 60);
        }

        #productDesc {
            max-width: 1200px;
            text-align: center;
            font-size: 18px;
            line-height: 1.5;
        }

        </style>
    </head>

    <div  id="productContainer">
        <div id="productCard">
            <a id="back" href="{{ route('products.index', ['query' => $query ?? 'All']) }}" >Back</a>
            <img id='productImage' src="{{ $product->image_url }}" >
            <div id="productContent">
                <h1 style="font-size: 48px;">{{ $product->name }}</h1>
                <div id="productInfo">
                    <p style="font-size: 24px">Price: £{{number_format($product->price, 2) }}</p>
                    <p>Stock: {{$product->stock_qty }}</p> 

                    <form action="/cart/add/{{$product->id}}" method="POST" >
                        @csrf
                        <button>Add to Cart</button>
                    </form>  
                </div>

            </div>  
        </div>
        <p id="productDesc">{{$product->description }}</p>
    </div>


</x-app-layout>
