<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GuestAccessTest extends TestCase

{
    Use RefreshDatabase;


    /** @test */
    public function test_guest_can_view_cart_page()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_guest_cannot_update_cart_item() {
        $cartItem = \App\Models\CartItem::factory()->create();

        $response = $this->put("/update-cartItem/{$cartItem->id}", [
            'quantity' => 3
        ]);
        $response->assertRedirect('/login');
    }
    
     /** @test */
    public function test_guest_cannot_delete_cart_item() {
        $cartItem = \App\Models\CartItem::factory()->create();

        $response = $this->delete("/delete-cartItem/{$cartItem->id}", [
            'quantity' => 3
        ]);
        $response->assertRedirect('/login');
    }
        
}