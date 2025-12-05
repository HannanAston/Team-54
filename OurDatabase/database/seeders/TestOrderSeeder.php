<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
      
        if (Product::count() === 0) {
            Product::factory()->count(10)->create();
        }

       
        Order::factory()
            ->count(5)
            ->create()
            ->each(function (Order $order) {
             
                $items = Product::inRandomOrder()->limit(rand(1, 3))->get();

                $total = 0;

                foreach ($items as $product) {
                    $qty   = rand(1, 3);
                    $price = $product->price;

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'price'      => $price,
                    ]);

                    $total += $qty * $price;
                }

                $order->update([
                    'subtotal'     => $subtotal,
                    'discount' => 0,
                    'total'     => $total,
                ]);
            });
    }
}
