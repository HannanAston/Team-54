<x-app-layout>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --tan:      #c19a6b;
            --tan-dark: #a67c52;
            --tan-soft: #f5ede3;
            --ink:      #1e1a16;
            --ink-mid:  #4a4540;
            --ink-soft: #8a8480;
            --bg:       #f7f4f0;
            --card:     #ffffff;
            --border:   #e8e2da;
            --green:    #4a7c59;
            --red:      #8b3a3a;
            --amber:    #c47c1a;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body, .om-page { font-family: 'DM Sans', sans-serif; }

        .om-page {
            background: var(--bg);
            min-height: 100vh;
            padding: 36px 32px;
        }

        /* ─── Page Header ─── */
        .om-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .om-header-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: var(--ink);
            line-height: 1;
        }

        .om-header-left p {
            color: var(--ink-soft);
            font-size: 14px;
            margin-top: 6px;
        }

        /* ─── Stats ─── */
        .om-stats {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .stat {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 24px;
            flex: 1;
            min-width: 110px;
            text-align: center;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--tan);
        }

        .stat-lbl {
            font-size: 11px;
            color: var(--ink-soft);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-top: 3px;
        }

        /* ─── Toolbar ─── */
        .om-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .filter-pill {
            padding: 6px 16px;
            border-radius: 99px;
            border: 1px solid var(--border);
            background: var(--card);
            color: var(--ink-mid);
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: .15s;
        }

        .filter-pill:hover { border-color: var(--tan); color: var(--tan); }

        .filter-pill.active {
            background: var(--tan);
            border-color: var(--tan);
            color: #fff;
            font-weight: 600;
        }

        .om-search {
            margin-left: auto;
            display: flex;
            align-items: center;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 6px 16px;
            gap: 8px;
            transition: .15s;
        }

        .om-search:focus-within { border-color: var(--tan); }

        .om-search input {
            border: none;
            outline: none;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            background: transparent;
            color: var(--ink);
            min-width: 190px;
        }

        .om-search svg { color: var(--ink-soft); flex-shrink: 0; }

        /* ─── Alerts ─── */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .alert-ok  { background: #eaf4ec; color: #2d6b3a; border: 1px solid #b6debb; }
        .alert-err { background: #fbeaea; color: #7a2020; border: 1px solid #e8b4b4; }

        /* ─── Order List ─── */
        .om-list { display: flex; flex-direction: column; gap: 18px; }

        /* ─── Order Card ─── */
        .order-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: box-shadow .2s;
        }

        .order-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,.07); }

        /* Card top bar — coloured left border by status */
        .order-card[data-status="processing"]    { border-left: 4px solid #b0a090; }
        .order-card[data-status="completed"]     { border-left: 4px solid var(--tan); }
        .order-card[data-status="cancelled"]     { border-left: 4px solid var(--ink); }
        .order-card[data-status="return pending"]{ border-left: 4px solid var(--amber); }
        .order-card[data-status="returned"]      { border-left: 4px solid var(--ink-soft); }

        /* ─── Card Header ─── */
        .card-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 18px 22px 14px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-meta { display: flex; flex-direction: column; gap: 4px; }

        .card-id {
            font-weight: 600;
            font-size: 15px;
            color: var(--ink);
        }

        .card-date { font-size: 13px; color: var(--ink-soft); }

        .card-customer {
            font-size: 13px;
            color: var(--ink-mid);
        }

        .card-customer a {
            color: var(--tan);
            text-decoration: none;
        }

        .card-customer a:hover { text-decoration: underline; }

        /* Status badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-processing     { background: #f0ece6; color: #7a6e64; }
        .badge-completed      { background: var(--tan-soft); color: var(--tan-dark); }
        .badge-cancelled      { background: #ececec; color: #333; }
        .badge-return-pending { background: #fdf3e3; color: var(--amber); }
        .badge-returned       { background: #ececec; color: #555; }

        /* Return alert strip */
        .return-strip {
            background: #fdf3e3;
            border-bottom: 1px solid #f0d9a8;
            padding: 8px 22px;
            font-size: 12px;
            color: var(--amber);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ─── Products ─── */
        .card-products {
            display: flex;
            gap: 12px;
            padding: 16px 22px;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .prod-chip {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 6px;
            min-width: 100px;
            max-width: 110px;
            text-decoration: none;
            padding: 10px 8px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--bg);
            transition: .2s;
            flex-shrink: 0;
        }

        .prod-chip:hover {
            border-color: var(--tan);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,.06);
        }

        .prod-chip img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 8px;
        }

        .prod-name  { font-size: 11px; font-weight: 600; color: var(--ink); line-height: 1.3; }
        .prod-price { font-size: 11px; color: var(--ink-soft); }
        .prod-qty   { font-size: 10px; color: var(--ink-soft); }

        /* ─── Card Footer ─── */
        .card-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 22px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-total {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
        }

        .card-actions { display: flex; gap: 8px; flex-wrap: wrap; }

        /* ─── Buttons ─── */
        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            border: none;
            cursor: pointer;
            transition: .15s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn:hover { filter: brightness(.9); transform: translateY(-1px); }

        .btn-complete { background: var(--tan);  color: #fff; }
        .btn-cancel   { background: var(--ink);  color: #fff; }
        .btn-approve  { background: var(--green); color: #fff; }
        .btn-reject   { background: var(--red);   color: #fff; }
        .btn-ghost    { background: transparent; color: var(--ink-soft); border: 1px solid var(--border); }

        .no-action { font-size: 13px; color: var(--ink-soft); font-style: italic; }

        /* ─── Empty ─── */
        .om-empty {
            text-align: center;
            padding: 60px 20px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            color: var(--ink-soft);
        }

        .om-empty p { font-size: 16px; }

        /* ─── Pagination ─── */
        .om-pagination { margin-top: 28px; }

        /* ─── Animations ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .order-card {
            animation: fadeUp .3s ease both;
        }

        @for ($i = 1; $i <= 15; $i++)
            .om-list .order-card:nth-child({{ $i }}) { animation-delay: {{ ($i - 1) * 40 }}ms; }
        @endfor
    </style>
</head>

<div class="om-page">

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-ok">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-err">✕ {{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div class="om-header">
        <div class="om-header-left">
            <h1>Order Management</h1>
            <p>Review, complete and process customer orders</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="om-stats">
        <div class="stat">
            <div class="stat-num">{{ $stats['all'] }}</div>
            <div class="stat-lbl">Total</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $stats['processing'] }}</div>
            <div class="stat-lbl">Processing</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $stats['completed'] }}</div>
            <div class="stat-lbl">Completed</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $stats['return pending'] }}</div>
            <div class="stat-lbl">Returns</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $stats['cancelled'] }}</div>
            <div class="stat-lbl">Cancelled</div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="om-toolbar">
        @php
            $filters = [
                ''               => 'All',
                'processing'     => 'Processing',
                'completed'      => 'Completed',
                'return pending' => 'Returns',
                'returned'       => 'Returned',
                'cancelled'      => 'Cancelled',
            ];
        @endphp

        @foreach($filters as $val => $label)
            <a href="{{ route('admin.orders.index', array_filter(['status' => $val, 'search' => request('search')])) }}"
               class="filter-pill {{ request('status', '') === $val ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach

        <form method="GET" action="{{ route('admin.orders.index') }}" class="om-search">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="search" placeholder="Order ID or customer…" value="{{ request('search') }}">
        </form>
    </div>

    {{-- Order List --}}
    <div class="om-list">
        @forelse($orders as $order)

        <div class="order-card" data-status="{{ $order->order_status }}">

            {{-- Return strip --}}
            @if($order->order_status === 'return pending')
            <div class="return-strip">
                ⚠ Customer has requested a return
            </div>
            @endif

            {{-- Card header --}}
            <div class="card-head">
                <div class="card-meta">
                    <div class="card-id">Order #{{ $order->id }}</div>
                    <div class="card-date">{{ $order->created_at->format('d M Y · H:i') }}</div>
                    <div class="card-customer">
                        {{ $order->user->name }}
                        &nbsp;·&nbsp;
                        <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                    </div>
                </div>

                @php
                    $badgeMap = [
                        'processing'     => 'badge-processing',
                        'completed'      => 'badge-completed',
                        'cancelled'      => 'badge-cancelled',
                        'return pending' => 'badge-return-pending',
                        'returned'       => 'badge-returned',
                    ];
                    $badgeClass = $badgeMap[$order->order_status] ?? 'badge-processing';
                @endphp

                <span class="badge {{ $badgeClass }}">
                    {{ ucfirst($order->order_status) }}
                </span>
            </div>

            {{-- Products --}}
            <div class="card-products">
                @foreach($order->orderItems as $item)
                <a href="{{ route('products.show', $item->product->id) }}" class="prod-chip">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                    <div class="prod-name">{{ Str::limit($item->product->name, 22) }}</div>
                    <div class="prod-price">£{{ $item->price }}</div>
                    <div class="prod-qty">Qty: {{ $item->quantity }}</div>
                </a>
                @endforeach
            </div>

            {{-- Card footer --}}
            <div class="card-foot">
                <div class="card-total">Total: £{{ number_format($order->total, 2) }}</div>

                <div class="card-actions">

                    @if($order->order_status === 'processing')

                        <form method="POST" action="{{ route('admin.orders.updateStatus') }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="completed">
                            <button class="btn btn-complete">✔ Complete</button>
                        </form>

                        <form method="POST" action="{{ route('admin.orders.updateStatus') }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="cancelled">
                            <button class="btn btn-cancel">✕ Cancel</button>
                        </form>

                    @elseif($order->order_status === 'return pending')

                        <form method="POST" action="{{ route('admin.orders.updateStatus') }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="returned">
                            <button class="btn btn-approve">✔ Approve Return</button>
                        </form>

                        <form method="POST" action="{{ route('admin.orders.updateStatus') }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="newStatus" value="completed">
                            <button class="btn btn-reject">✕ Reject Return</button>
                        </form>

                    @else
                        <span class="no-action">No actions available</span>
                    @endif

                </div>
            </div>

        </div>

        @empty
        <div class="om-empty">
            <p>No orders found{{ request('status') ? ' with status "' . request('status') . '"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($orders->hasPages())
        <div class="om-pagination">{{ $orders->links() }}</div>
    @endif

</div>
</x-app-layout>