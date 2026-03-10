<x-app-layout>
    <head>
        <style>
            #search {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                gap: 10px;
                padding: 10px;
            }

            #searchBar {
                min-width: 300px;
                max-width: 600px;
                padding: 10px;
                border-radius: 8px;
                border-color: rgba(0, 0, 0, 0.2);
                border-width: 1px;
                font-size: 16px;
                box-shadow: 0px 5px 10px rgba(0,0,0,0.05);
            }

            .searchButtons {
                background-color: rgba(255, 255, 255, 1);
                border-radius: 8px;
                border-width: 1px;
                border-color: rgba(0, 0, 0, 0.2);
                height: 40px;
                padding: 0 15px;
                flex-shrink: 0;
                box-shadow: 0px 5px 10px rgba(0,0,0,0.05);
            }

            .searchButtons:hover {
                background-color: rgba(0, 0, 0, 0.1);
                transform-origin: 10px;
            }

            #search form {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            #ProductContainer {
                display: flex;
                flex-wrap: wrap;
            }

            .productCard {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                background-color: rgba(255, 255, 255, 1);
                min-width: 250px;
                min-height: 250px;
                margin: 10px;
                border-radius: 8px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            }

            .productCard:hover {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                transform: scale(1.05);
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            }

            .productCard form {
                width: 100%;
                bottom: 0;
            }

            .productButtons{
                min-width: 100%;
                background-color: rgba(255, 255, 255, 1);
                margin: bottom;
                border-radius: 8px;
            }

            .productButtons:hover {
                background-color: rgba(255, 255, 255, 0.5);
            }

            .buttonContainer {
                width: 100%;
                padding: 5px;
            }

            .buttonContainer form {
                padding: 2px;
            }


            .productImage {
                width: 250px;
                height: 250px;
                border-radius: 8px;
                object-fit: cover;
            }

        </style>
    </head>

    @section('content')
    <div class="max-w7x1 mx-auto px-6 py-10 bg-[#F0F0F0]">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-wide text-[#333]">
                    {{ request('search') ?? 'All Products' }}
                </h1>
                <p class="text-[#666] mt-1">
                    {{ $products->count() }} Products Found
                </p>
            </div>

            <form method="GET">
                <select name="sort" class=" border rounded-lg px-4 py-2 text-sm">
                    <option value="">Sort By</option>
                    <option value="price_asc">Price: Ascending</option>
                    <option value="price_desc">Price: Descending</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-[200px_1fr] gap-10">
            <div class="hidden md:block">
                <div class="border rounded-xl p-6 bg-white shadow-sm">
                    <h3 class="font-semibold mb-4">Filter By</h3>

                    <div class="space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded">
                            <span>Men</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded">
                            <span>Women</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                <div class="group border rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 bg-[#F0F0F0] flex flex-col h-full">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image_url }}" class="w-full h-64 object-contain p-4 bg-white">

                        @if($product->discount)
                            <span class="absolute top-3 left-3 bg-red-600 text-white text-xs px-3 py-1 rounded-full">
                                -{{ $product->discount }}%
                            </span>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-1 text-[#333]">
                            {{ $product->name }}
                        </h3>

                        <p class="text-[#666] text-sm mb-3">
                            {{ $product->brand ?? 'Revival Threads' }}
                        </p>

                        <div class="flex items-center space-x-3">
                            @if($product->discount)
                                <span class="text-red-600 font-bold text-lg">
                                    £{{ number_format($product->price - ($product->price * $product->discount/100), 2) }}
                                </span>
                                <span class="text-gray-400 line-through">
                                    £{{ number_format($product->price, 2) }}
                                </span>
                            @else
                                <span class="font-bold text-lg">
                                    £{{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </div>

                        <a href="/products/{{ $product->id }}" class="block mt-4 text-center bg-[#C19A6B] text-white py-2 rounded-lg hover:bg-[#333] transition">
                            View Product
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
