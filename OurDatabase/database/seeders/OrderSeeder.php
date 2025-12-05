<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
       
        User::all()->each(function ($user) {

            
            for ($i = 0; $i < rand(1, 3); $i++) {
                
                $order = Order::create([
                    'user_id'  => $user->id,
                    'subtotal' => 0,
                    'discount' => 0,
                    'total'    => 0,
                    'status'   => 'completed',
                ]);

                $products = Product::inRandomOrder()->take(rand(1, 3))->get();
                $subtotal = 0;

                foreach ($products as $product) {
                    $quantity = rand(1, 3);

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $quantity,
                        'price'      => $product->price,
                    ]);

                    $subtotal += $product->price * $quantity;
                }

                // Randomly apply a 0% or 10% discount
                $discount = rand(0, 1) ? round($subtotal * 0.10, 2) : 0;
                $total    = $subtotal - $discount;

                $order->update([
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'total'    => $total,
                ]);
            }
        });
    }
}
