<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guests should not be able to view order pages.
     */
    public function test_guest_cannot_view_order_pages(): void
    {
        $this->get('/orders')->assertRedirect('/login');
        $this->get('/orders/1')->assertRedirect('/login');
    }

    /**
     * Logged-in user can see only their own orders in /orders.
     */
    public function test_user_can_view_their_order_list(): void
    {
        
        $user = User::factory()->create();

       
        $otherUser = User::factory()->create();

       
        $ordersForUser = Order::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        
        $otherUsersOrder = Order::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->actingAs($user)->get('/orders');

        $response->assertStatus(200);

        
        foreach ($ordersForUser as $order) {
            $response->assertSee('Order #' . $order->id);
        }

        
        $response->assertDontSee('Order #' . $otherUsersOrder->id);
    }

    /**
     * Logged-in user can view details of an individual order they own.
     */
    public function test_user_can_view_an_individual_order(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        
        $order = Order::factory()->create([
            'user_id' => $user->id,
        ]);

        
        OrderItem::factory()->count(2)->create([
            'order_id' => $order->id,
        ]);

        
        $otherUsersOrder = Order::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->actingAs($user)->get('/orders/' . $order->id);

        $response->assertStatus(200);

        
        $response->assertSee('Order Details #' . $order->id);

        
        $response->assertDontSee('Order Details #' . $otherUsersOrder->id);
    }
}
