<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;

class TestCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();
        foreach ($users as $user) {
            $cart = Cart::factory()->create([
                'user_id' => $user->id
            ]);

            $ItemsQuantity = 3;
            for ($i = 0; $i<$ItemsQuantity; $i++) {
                CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'product_id' => $products->random()->id,
                    'quantity' => rand(1, 3)
                ]);
            }
        }


    }

}
