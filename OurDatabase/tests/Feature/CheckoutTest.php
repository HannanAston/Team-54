<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceipt;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_checkout_and_create_order()
    {
        Mail::fake();
        
        // Create user, product, and cart
        $user = User::factory()->create(['order_count' => 0]);
        $product = Product::factory()->create(['price' => 100]);
        $cart = Cart::create(['user_id' => $user->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        
        // Checkout
        $response = $this->actingAs($user)->postJson('/checkout');
        
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Order placed successfully']);
        
        // Assert order created
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'subtotal' => 200,
            'total' => 200
        ]);
        
        // Assert order item created
        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 100
        ]);
        
        // Assert cart cleared
        $this->assertDatabaseCount('cart_items', 0);
        
        // Assert order count incremented
        $this->assertEquals(1, $user->fresh()->order_count);
        
        // Assert email sent
        Mail::assertSent(OrderReceipt::class);
    }
    
    /** @test */
    public function loyalty_discount_applies_on_fifth_order()
    {
        Mail::fake();
        
        // Create user with 4 orders already
        $user = User::factory()->create(['order_count' => 4]);
        $product = Product::factory()->create(['price' => 100]);
        $cart = Cart::create(['user_id' => $user->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        
        // Checkout (this is the 5th order)
        $response = $this->actingAs($user)->postJson('/checkout');
        
        $response->assertStatus(201);
        
        // Assert 10% discount applied
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'subtotal' => 100,
            'discount' => 10,
            'total' => 90
        ]);
    }
    
    /** @test */
    public function checkout_fails_with_empty_cart()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->postJson('/checkout');
        
        $response->assertStatus(400);
        $response->assertJson(['message' => 'Cart is empty']);
    }
}