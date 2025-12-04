<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartTest extends TestCase

{
    Use RefreshDatabase;


    /** @test */
    public function test_user_can_add_product_to_cart()
    {

        $user = User::factory()->create(['is_admin' => 0]);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post("/cart/add/{$product->id}");

        $response->assertStatus(302);

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
        ]);

        $cart = Cart::where('user_id', $user->id)->first();

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' =>1,
        ]);
    }

    /** @test */
    public function test_user_can_delete_cart_item() {
        $user = User::factory()->create();
        $cart = Cart::factory()->for($user)->create();
        
        $cartItem = CartItem::factory()->for($cart)->create(['quantity' => 1]);

        $response = $this->actingAs($user)->delete("/delete-cartItem/{$cartItem->id}");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id
        ]);
    }

    /** @test */
    public function test_user_can_update_cart_item() {
    
        $user = User::factory()->create();
        $cart = Cart::factory()->for($user)->create();
        
        $cartItem = CartItem::factory()->for($cart)->create(['quantity' => 1]);

        $response = $this->actingAs($user)->put("/update-cartItem/{$cartItem->id}", [
            'quantity' => 3
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id, 'quantity' => 3
        ]);

    }
}