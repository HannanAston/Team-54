<x-app-layout>

<head>
    <style>
        .page {
            background-color: #f0f0f0;
            min-height: 100vh;
            padding: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            border-color: #c19a6b;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .card-button {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-blue {
            background-color: #333;
        }

        .btn-blue:hover {
            background-color: #000;
        }

        .btn-green {
            background-color: #c19a6b;
        }

        .btn-green:hover {
            background-color: #a67c52;
        }

        .btn-orange {
            background-color: #666;
        }

        .btn-orange:hover {
            background-color: #444;
        }

        .welcome {
            margin-bottom: 20px;
            color: #666;
        }
    </style>
</head>

<div class="page">

    @if(auth()->user()->is_admin)

    <div class="title">Admin Dashboard</div>

    <div class="welcome">
        {{ __("You're logged in as an administrator.") }}
    </div>

    @else
        <div class="title">Welcome!</div>

        <div class="welcome">
            {{ __("You're logged in as a customer!") }}
        </div>

        <div class="card">
            <div class="card-title">Explore Our Catalogue for New Products!</div>
            <div class="card-description">
                Explore products!
            </div>
            <a href="{{ route('products.index') }}" class="card-button btn-green">
                Shop Now!
            </a>
        </div>
    @endif

    <div class="dashboard-container">

        @if(auth()->user()->is_admin)

            <div class="card">
                <div class="card-title">User Management</div>
                <div class="card-description">
                    View, edit, and manage all registered users.
                </div>
                <a href="{{ route('admin.users.index') }}" class="card-button btn-blue">
                    Manage Users
                </a>
            </div>

            <div class="card">
                <div class="card-title">Product Management</div>
                <div class="card-description">
                    Add, edit, and remove products from the store.
                </div>
                <a href="{{ route('admin.products.index') }}" class="card-button btn-green">
                    Manage Products
                </a>
            </div>

            <div class="card">
                <div class="card-title">Stock Reports</div>
                <div class="card-description">
                    View low stock items and inventory reports.
                </div>
                <a href="{{ route('admin.reports.stock') }}" class="card-button btn-orange">
                    View Reports
                </a>
            </div>

        @endif

    </div>

</div>

</x-app-layout>