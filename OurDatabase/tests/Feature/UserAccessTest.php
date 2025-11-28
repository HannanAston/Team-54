<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class UserAccessTest extends TestCase

{
    Use RefreshDatabase;


    /** @test */
    public function test_user_can_see_their_cart_items()
    {
        $user = \App\Models\User::factory()->create();
        $cart = \App\Models\Cart::factory()->create(['user_id' => $user->id]);

        $product = \App\Models\Product::factory()->create([
            'name' => 'Test Product'
        ]);

        $item = \App\Models\CartItem::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $response = $this->actingAs($user)->get('/cart');

        $response->assertStatus(200);
        $response->assertSee('Test Product');
    }
}