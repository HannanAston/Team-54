<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\StockHistory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.notifications', function ($view) {

            $lowStock = Product::where('stock_qty', '<=', DB::raw('stock_threshold'))
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($product) {
                    return [
                        'product' => $product,
                        'type' => 'low_stock',
                    ];
                });

            $restocked = StockHistory::where('new_stock', '>', 'old_stock')
                ->where('created_at', '>=', now()->subDay())
                ->with('product')
                ->get()
                ->map(function ($history) {
                    $product = $history->product;
                    return [
                        'product' => $product,
                        'type' => 'restocked',
                        'stock_change' => $history->new_stock - $history->old_stock,
                    ];
                });

            $notifications = $lowStock->merge($restocked);
            $view->with('notifications', $notifications);
        });
    }
}