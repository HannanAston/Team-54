<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Orders</title>
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
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            background-color: #5a6268;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2196F3;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            background-color: #d4edda;
            color: #155724;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Orders for {{ $user->name }}</h1>
            <a href="{{ route('admin.users.index') }}" class="btn">← Back to Users</a>
        </div>

        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Subtotal</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
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
                            <td><span class="badge">{{ $order->order_status }}</span></td>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td colspan="7" style="padding: 10px 20px;">
                                <strong>Products:</strong>
                                <ul style="margin: 5px 0 0 20px;">
                                    @foreach($order->orderItems as $item)
                                        <li>{{ $item->product->name }} (Qty: {{ $item->quantity }}) @ £{{ number_format($item->price, 2) }}</li>
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
                <p>This user hasn't placed any orders.</p>
            </div>
        @endif
    </div>
</body>
</html>