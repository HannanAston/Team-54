<x-app-layout>
    <style>
        body {
            background: #f0f0f0;
        }

        .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .card {
            width: 100%;
            max-width: 700px;
            background: #ffffff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #c19a6b;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 20px;
        }

        .section {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e5e5e5;
        }

        .section h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .text {
            color: #666;
            margin-bottom: 6px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #666;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #ddd;
            padding-top: 12px;
            margin-top: 12px;
            color: #333;
        }

        .error {
            background: #fde8e8;
            color: #b91c1c;
            padding: 12px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            background: #c19a6b;
            color: white;
            padding: 12px 22px;
            border-radius: 12px;
            text-decoration: none;
            transition: 0.25s;
            font-weight: 500;
        }

        .btn:hover {
            background: #a67c52;
        }

        .center {
            text-align: center;
        }
    </style>

    <div class="page">
        <div class="card">

            <h1 class="title">Order Placed Successfully!</h1>
            <p class="subtitle">{{ $message }}</p>

            <div class="section">
                <h2>Customer Details</h2>

                <p class="text"><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>

                @if(isset($order->user))
                    <p class="text">
                        <strong>Email:</strong>
                        {{ $order->user->email ?? $order->guest_email ?? 'guest@example.com' }}
                    </p>
                @endif
            </div>

            <div class="section">
                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>£{{ $order->subtotal }}</span>
                </div>

                <div class="summary-row">
                    <span>Discount</span>
                    <span>- £{{ $order->discount }}</span>
                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>£{{ $order->total }}</span>
                </div>
            </div>

            @if (isset($error))
                <div class="error">
                    {{ $error }}
                </div>
            @endif

            <div class="center">
                <a href="/products" class="btn">
                    Continue Shopping
                </a>
            </div>

        </div>
    </div>
</x-app-layout>