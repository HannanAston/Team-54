<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Support\Facades\Schema;

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
        View::composer('*', function ($view) {
            // Only run for authenticated users
            if (!auth()->check()) {
                $view->with('notifications', collect([])); // Empty collection for guests
                return;
            }

            try {
                // Low stock notifications
                $lowStock = Product::where('stock_qty', '<=', DB::raw('stock_threshold'))
                    ->where('stock_qty', '>', 0)
                    ->get()
                    ->map(function ($product) {
                        return [
                            'product' => $product,
                            'type' => 'low_stock',
                        ];
                    });

                // Restocked notifications - only if table exists
                $restocked = collect([]);
                
                if (Schema::hasTable('stock_histories')) {
                    try {
                        $stockHistories = DB::table('stock_histories')
                            ->where('created_at', '>=', now()->subDays(7))
                            ->where('new_stock', '>', DB::raw('old_stock'))
                            ->get();
                        
                        $restocked = $stockHistories->map(function ($history) {
                            $product = Product::find($history->product_id);
                            if (!$product) {
                                return null;
                            }
                            return [
                                'product' => $product,
                                'type' => 'restocked',
                                'stock_change' => $history->new_stock - $history->old_stock,
                            ];
                        })->filter(); // Remove nulls
                    } catch (\Exception $e) {
                        // Silently fail if stock_histories has issues
                    }
                }

                // Merge collections
                $notifications = $lowStock->concat($restocked); // Use concat instead of merge
                
            } catch (\Exception $e) {
                $notifications = collect([]);
            }

            $view->with('notifications', $notifications);
        });
    }
}