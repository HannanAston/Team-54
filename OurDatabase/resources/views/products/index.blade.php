@section('title', 'Products')

<x-app-layout>
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
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.05);
        }

        .searchButtons {
            background-color: #c19a6b;
            color: white;
            border-radius: 8px;
            border-width: 1px;
            border-color: rgba(0, 0, 0, 0.2);
            height: 40px;
            padding: 0 15px;
            flex-shrink: 0;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.05);
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

        .productButtons {
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

        .stock-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }

        .in-stock {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .low-stock {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .out-of-stock {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>


    <div class="max-w7x1 mx-auto px-6 py-10 bg-[#ffffff00]">
        <div id="search">
            <form method="GET" action="{{ url('/products') }}">
                <input type="text" name="search" id="searchBar" placeholder="Search products..." value="{{ request('search') }}">

                <button type="submit" class="searchButtons">Search</button>

                @if(request('search'))
                    <a href="{{ url('/products') }}" class="searchButtons">Clear</a>
                @endif
            </form>
        </div>

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-wide text-[#333]">
                    {{ request('search') ?? 'All Products' }}
                </h1>
                <p class="text-[#666] mt-1">
                    {{ $products->count() }} Products Found
                </p>
            </div>

            <form method="GET" action="{{ url('/products') }}" class="flex items-center gap-4">
                
            </form>
        </div>
            
        </div>

        >

            
        <div class="grid grid-cols-1 md:grid-cols-[200px_1fr] space-x-6 p-6">
            <div class="hidden md:block">
                <div class="border rounded-xl p-6 bg-white shadow-sm">
                    <h3 class="font-semibold mb-4">Filter By</h3>

                    <form method="GET" action="{{ url('/products') }}" class="space-y-4">

                        <div>
                            <h4 class="font-medium mb-2">Category</h4>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="1" {{ in_array(1, (array)request('category_id')) ? 'checked' : ''}}>
                                <span>Tops</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="2" {{ in_array(2, (array)request('category_id')) ? 'checked' : ''}}>
                                <span>Bottoms</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="3" {{ in_array(3, (array)request('category_id')) ? 'checked' : ''}}>
                                <span>Outerwear</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="4" {{ in_array(4, (array)request('category_id')) ? 'checked' : ''}}>
                                <span>Accessories</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="category_id[]" value="5" {{ in_array(5, (array)request('category_id')) ? 'checked' : ''}}>
                                <span>Shoes</span>
                            </label>
                        </div>

                        <div>
                            <h4 class="font-medium mb-2">Price</h4>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="price" value="0-20" {{ request('price') == '0-20' ? 'checked' : ''}}>
                                <span>Under £20</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="price" value="20-50" {{ request('price') == '20-50' ? 'checked' : ''}}>
                                <span>£20 - £50</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="price" value="50+" {{ request('price') == '50+' ? 'checked' : ''}}>
                                <span>Over £50</span>
                            </label>
                        </div>

                        <div>
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <h4 class="font-medium mb-2">Sort By Price</h4>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="sort" value="price_asc">
                                <span>Ascending</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="sort" value="price_desc">
                                <span>Descending</span>
                            </label>
                        </div>
                        <button type="submit" class="searchButtons w-full py-2 bg-[#C19A6B] text-black">Apply Filters</button>
                        @if(request()->hasAny(['category_id', 'price', 'sort']))
                            <a href="{{ url('/products') }}" class="block text-center mt-2 py-2 rounded-lg bg-[#C19A6B] text-white hover:bg-[#333] transition">Clear Filters</a>
                        @endif
                    </form>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="group border rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 bg-[#F0F0F0] flex flex-col h-fullflex-shrink-0">
                        <div class="relative overflow-hidden">
                            <img src="{{ $product->image_url }}" class="w-full h-48 object-contain bg-white">

                            @if ($product->discount)
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
                                @if ($product->discount)
                                    <span class="text-red-600 font-bold text-lg">
                                        £{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
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

                            <a href="/products/{{ $product->id }}"
                                class="block mt-4 text-center bg-[#C19A6B] text-white py-2 rounded-lg hover:bg-[#333] transition">
                                View Product
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
    </div>
</x-app-layout>
