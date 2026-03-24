<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockReportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_stock_reports()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
    
        $response = $this->actingAs($admin)->get('/admin/reports/stock');
    
        //$response->assertStatus(200);
        $response->assertSee('Stock Reports');
    }

    /** @test */
    public function non_admin_cannot_view_stock_reports()
    {
        $user = User::factory()->create(['is_admin' => 0]);
        
        $response = $this->actingAs($user)->get('/admin/reports/stock');
        
        $response->assertStatus(403);
    }

    /** @test */
    public function stock_reports_shows_correct_statistics()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        
        // Create products with different stock levels
        Product::factory()->create(['stock_qty' => 100, 'stock_threshold' => 10]); // In stock
        Product::factory()->create(['stock_qty' => 5, 'stock_threshold' => 10]);   // Low stock
        Product::factory()->create(['stock_qty' => 0, 'stock_threshold' => 10]);   // Out of stock
        
        $response = $this->actingAs($admin)->get('/admin/reports/stock');
        
        $response->assertStatus(200);
        $response->assertSee('Total Products');
        $response->assertSee('3'); // Total products count
    }

    /** @test */
    public function stock_reports_shows_low_stock_alerts()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $category = Category::factory()->create();
        
        $lowStockProduct = Product::factory()->create([
            'name' => 'Low Stock Item',
            'stock_qty' => 5,
            'stock_threshold' => 10,
            'category_id' => $category->id,
        ]);
        
        $response = $this->actingAs($admin)->get('/admin/reports/stock');
        
        $response->assertStatus(200);
        $response->assertSee('Low Stock Alerts');
        $response->assertSee('Low Stock Item');
    }

    /** @test */
    public function stock_reports_shows_recent_orders()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $customer = User::factory()->create();
        $product = Product::factory()->create(['price' => 100]);
        
        // Create an order
        $order = Order::create([
            'user_id' => $customer->id,
            'subtotal' => 100,
            'discount' => 0,
            'total' => 100,
        ]);
        
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 100,
        ]);
        
        $response = $this->actingAs($admin)->get('/admin/reports/stock');
        
        $response->assertStatus(200);
        $response->assertSee('Recent Orders');
        $response->assertSee($customer->name);
    }

    /** @test */
    public function stock_reports_calculates_total_inventory_value()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        
        Product::factory()->create(['stock_qty' => 10, 'price' => 50]); // Value: 500
        Product::factory()->create(['stock_qty' => 5, 'price' => 20]);  // Value: 100
        // Total value: 600
        
        $response = $this->actingAs($admin)->get('/admin/reports/stock');
        
        $response->assertStatus(200);
        $response->assertSee('600.00');
    }
}