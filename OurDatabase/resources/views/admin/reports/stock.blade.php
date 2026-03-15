<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Reports</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #333;
            font-size: 32px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg,  #768efb 0%, #1e1e1e 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .stat-card.green {
            background: linear-gradient(135deg,  #768efb 0%, #1e1e1e 100%);
        }

        .stat-card.orange {
            background: linear-gradient(135deg,  #768efb 0%, #1e1e1e 100%);
        }

        .stat-card.red {
            background: linear-gradient(135deg,  #768efb 0%, #1e1e1e 100%);
        }

        .stat-card h3 {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card .label {
            font-size: 12px;
            opacity: 0.8;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .stock-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .low-stock {
            background-color: #fff3cd;
            color: #856404;
        }

        .out-of-stock {
            background-color: #f8d7da;
            color: #721c24;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ffeaa7;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Stock Reports Dashboard</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
        </div>

        <!-- Summary Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Products</h3>
                <div class="number">{{ $totalProducts }}</div>
                <div class="label">In Inventory</div>
            </div>

            <div class="stat-card green">
                <h3>In Stock</h3>
                <div class="number">{{ $inStock }}</div>
                <div class="label">Healthy Stock Levels</div>
            </div>

            <div class="stat-card orange">
                <h3>Low Stock</h3>
                <div class="number">{{ $lowStock->count() }}</div>
                <div class="label">Need Reordering</div>
            </div>

            <div class="stat-card red">
                <h3>Out of Stock</h3>
                <div class="number">{{ $outOfStock->count() }}</div>
                <div class="label">Urgent Action Required</div>
            </div>
        </div>

        <!-- Total Inventory Value -->
        <div class="section">
            <h2>💰 Total Inventory Value: £{{ number_format($totalValue, 2) }}</h2>
        </div>

        <!-- Order Statistics -->
            <div class="section">
                <h2>📦 Order Statistics</h2>
                <div class="stats-grid" style="margin-bottom: 20px;">
                    <div class="stat-card" style="background: linear-gradient(135deg, #768efb 0%, #1e1e1e 100%);">
                        <h3>Today's Orders</h3>
                        <div class="number">{{ $todayOrders }}</div>
                        <div class="label">Orders Received Today</div>
                    </div>

                    <div class="stat-card green">
                        <h3>Today's Revenue</h3>
                        <div class="number">£{{ number_format($todayRevenue, 2) }}</div>
                        <div class="label">Total Sales Today</div>
                    </div>

                    <div class="stat-card orange">
                        <h3>This Week's Orders</h3>
                        <div class="number">{{ $thisWeekOrders }}</div>
                        <div class="label">Orders This Week</div>
                    </div>

                    <div class="stat-card" style="background: linear-gradient(135deg,  #768efb 0%, #1e1e1e 100%);">
                        <h3>This Week's Revenue</h3>
                        <div class="number">£{{ number_format($thisWeekRevenue, 2) }}</div>
                        <div class="label">Total Sales This Week</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders (Incoming/Outgoing) -->
        <div class="section">
            <h2>🚚 Recent Orders (Last 10)</h2>
            @if($recentOrders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Items</th>
                            <th>Subtotal</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->user?->name ?? "Guest" }}</td>
                                <td>{{ $order->created_at->format('M j, Y g:i A') }}</td>
                                <td>{{ $order->orderItems->sum('quantity') }} items</td>
                                <td>£{{ number_format($order->subtotal, 2) }}</td>
                                <td>
                                    @if($order->discount > 0)
                                        <span style="color: #16a34a; font-weight: bold;">-£{{ number_format($order->discount, 2) }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><strong>£{{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    <span class="stock-badge" style="background-color: #d4edda; color: #155724;">
                                        {{$order->order_status}}
                                    </span>
                                </td>
                            </tr>
                            <!-- Order Items Details (expandable row) -->
                            <tr style="background-color: #f9f9f9;">
                                <td colspan="8" style="padding: 10px 20px;">
                                    <strong>Products Ordered:</strong>
                                    <ul style="margin: 5px 0 0 20px; list-style: disc;">
                                        @foreach($order->orderItems as $item)
                                            <li>
                                                {{ $item->product->name }} 
                                                (Qty: {{ $item->quantity }}) 
                                                @ £{{ number_format($item->price, 2) }} each
                                                = <strong>£{{ number_format($item->quantity * $item->price, 2) }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <h3>No orders yet</h3>
                    <p>Orders will appear here once customers make purchases.</p>
                </div>
            @endif
        </div>

        <!-- Low Stock Alerts -->
        @if($lowStock->count() > 0)
            <div class="section">
                <div class="alert-warning">
                    ⚠️ Warning: {{ $lowStock->count() }} product(s) are running low on stock!
                </div>
                <h2>⚠️ Low Stock Products</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Current Stock</th>
                            <th>Threshold</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStock as $product)
                            <tr>
                                <td>
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" class="product-image" alt="{{ $product->name }}">
                                    @elseif($product->image_url)
                                        <img src="{{ $product->image_url }}" class="product-image" alt="{{ $product->name }}">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock_qty }} units</td>
                                <td>{{ $product->stock_threshold }} units</td>
                                <td>£{{ number_format($product->price, 2) }}</td>
                                <td><span class="stock-badge low-stock">Low Stock</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Out of Stock Alerts -->
        @if($outOfStock->count() > 0)
            <div class="section">
                <div class="alert-danger">
                    🚨 Critical: {{ $outOfStock->count() }} product(s) are completely out of stock!
                </div>
                <h2>🚨 Out of Stock Products</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outOfStock as $product)
                            <tr>
                                <td>
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" class="product-image" alt="{{ $product->name }}">
                                    @elseif($product->image_url)
                                        <img src="{{ $product->image_url }}" class="product-image" alt="{{ $product->name }}">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>£{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td><span class="stock-badge out-of-stock">Out of Stock</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($lowStock->count() == 0 && $outOfStock->count() == 0)
            <div class="empty-state">
                <h2>✅ All products have healthy stock levels!</h2>
                <p>No action required at this time.</p>
            </div>
        @endif
    </div>
</body>
</html>