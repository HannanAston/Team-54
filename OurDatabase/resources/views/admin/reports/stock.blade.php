<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Reports - E-commerce Analytics</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Stock Reports</h1>
    <div class="flex gap-3">
        <a href="{{ route('dashboard') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
            ← Dashboard
        </a>
        <button onclick="window.print()" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-900">Export</button>
    </div>
</header>

<main class="p-6 space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- KPI Overview -->
    <section class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl shadow">
            <p class="text-gray-500">Total Inventory Value</p>
            <h2 class="text-2xl font-bold">£{{ number_format($totalValue, 2) }}</h2>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <p class="text-gray-500">Daily Revenue</p>
            <h2 class="text-2xl font-bold">£{{ number_format($todayRevenue, 2) }}</h2>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <p class="text-gray-500">Weekly Revenue</p>
            <h2 class="text-2xl font-bold">£{{ number_format($thisWeekRevenue, 2) }}</h2>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow">
            <p class="text-gray-500">Orders Today</p>
            <h2 class="text-2xl font-bold">{{ $todayOrders }}</h2>
        </div>
    </section>

    <!-- Stock Status + Orders Summary -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-2xl shadow">
            <h3 class="font-semibold mb-4">Stock Overview</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">Total Products</span>
                    <span class="text-2xl font-bold">{{ $totalProducts }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">In Stock</span>
                    <span class="text-2xl font-bold text-green-500">{{ $inStock }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">Low Stock</span>
                    <span class="text-2xl font-bold text-yellow-500">{{ $lowStock->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Out of Stock</span>
                    <span class="text-2xl font-bold text-red-500">{{ $outOfStock->count() }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow">
            <h3 class="font-semibold mb-4">Order Statistics</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">Orders This Week</span>
                    <span class="text-2xl font-bold">{{ $thisWeekOrders }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">Weekly Revenue</span>
                    <span class="text-2xl font-bold text-green-500">£{{ number_format($thisWeekRevenue, 2) }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-gray-600">Average Order Value</span>
                    <span class="text-2xl font-bold">
                        £{{ $thisWeekOrders > 0 ? number_format($thisWeekRevenue / $thisWeekOrders, 2) : '0.00' }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Inventory Alerts -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-2xl shadow">
            <h3 class="font-semibold mb-4 text-yellow-600">⚠️ Low Stock Alerts</h3>
            @if($lowStock->count() > 0)
                <ul class="space-y-3">
                    @foreach($lowStock->take(5) as $product)
                        <li class="flex justify-between border-b pb-2">
                            <span class="font-medium">{{ $product->name }}</span>
                            <span class="text-yellow-600 font-bold">{{ $product->stock_qty }} left</span>
                        </li>
                    @endforeach
                </ul>
                @if($lowStock->count() > 5)
                    <p class="text-sm text-gray-500 mt-3">+ {{ $lowStock->count() - 5 }} more products</p>
                @endif
            @else
                <p class="text-gray-500 text-center py-8">No low stock alerts</p>
            @endif
        </div>

        <div class="bg-white p-4 rounded-2xl shadow">
            <h3 class="font-semibold mb-4 text-red-600">🚨 Out of Stock</h3>
            @if($outOfStock->count() > 0)
                <ul class="space-y-3">
                    @foreach($outOfStock->take(5) as $product)
                        <li class="flex justify-between border-b pb-2">
                            <span class="font-medium">{{ $product->name }}</span>
                            <span class="text-red-500 font-bold">Out of stock</span>
                        </li>
                    @endforeach
                </ul>
                @if($outOfStock->count() > 5)
                    <p class="text-sm text-gray-500 mt-3">+ {{ $outOfStock->count() - 5 }} more products</p>
                @endif
            @else
                <p class="text-gray-500 text-center py-8">All products in stock!</p>
            @endif
        </div>
    </section>

    <!-- Recent Orders -->
    <section class="bg-white p-4 rounded-2xl shadow">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">Last 10 Orders</h3>
            <span class="text-sm text-gray-500">Recent Activity</span>
        </div>
        @if($recentOrders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 px-2">Order ID</th>
                            <th class="py-3 px-2">Customer</th>
                            <th class="py-3 px-2">Date</th>
                            <th class="py-3 px-2">Items</th>
                            <th class="py-3 px-2">Discount</th>
                            <th class="py-3 px-2">Total</th>
                            <th class="py-3 px-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2 font-semibold">#{{ $order->id }}</td>
                                <td class="py-3 px-2">{{ $order->user ? $order->user->name : 'Deleted User' }}</td>
                                <td class="py-3 px-2 text-sm text-gray-600">{{ $order->created_at->format('M j, g:i A') }}</td>
                                <td class="py-3 px-2">{{ $order->orderItems->sum('quantity') }}</td>
                                <td class="py-3 px-2">
                                    @if($order->discount > 0)
                                        <span class="text-green-600 font-semibold">-£{{ number_format($order->discount, 2) }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 font-bold">£{{ number_format($order->total, 2) }}</td>
                                <td class="py-3 px-2">
                                    <span class="text-green-500 font-semibold">Completed</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">No orders yet</p>
        @endif
    </section>

    <!-- Top Performing Products -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @php
            $topProducts = \App\Models\OrderItem::with('product')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->select('product_id', \DB::raw('SUM(quantity) as total_sold'))
                ->groupBy('product_id')
                ->orderBy('total_sold', 'desc')
                ->take(3)
                ->get()
                ->filter(function($item) {
                return $item->product !== null; // Filter out deleted products
                });
        @endphp

        @if($topProducts->count() > 0)
            @foreach($topProducts as $index => $item)
                @if($item->product) {{-- Extra safety check --}}
                    <div class="bg-white p-4 rounded-2xl shadow">
                        <h4 class="font-semibold mb-2">
                            @if($index == 0)
                                🏆 Top Selling Item
                            @elseif($index == 1)
                                🥈 Second Best
                            @else
                                🥉 Third Place
                            @endif
                        </h4>
                        <p class="text-lg font-bold">{{ $item->product->name }}</p>
                        <p class="text-gray-500">{{ $item->total_sold }} sold this week</p>
                        <div class="mt-2">
                            <span class="inline-block px-2 py-1 text-xs rounded
                             @if($item->product->stock_qty > $item->product->stock_threshold)
                                    bg-green-100 text-green-800
                                @elseif($item->product->stock_qty > 0)
                                    bg-yellow-100 text-yellow-800
                                @else
                                    bg-red-100 text-red-800
                                @endif
                            ">
                                {{ $item->product->getStockStatus() }}
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="bg-white p-4 rounded-2xl shadow col-span-3">
                <p class="text-gray-500 text-center py-8">No sales data for this week yet</p>
            </div>
        @endif
    </section>

</main>

</body>
</html>
