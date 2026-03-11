<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_product_management_page()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        
        $response = $this->actingAs($admin)->get('/admin/products');
        
        $response->assertStatus(200);
        $response->assertSee('Product Management');
    }

    /** @test */
    public function non_admin_cannot_access_product_management()
    {
        $user = User::factory()->create(['is_admin' => 0]);
        
        $response = $this->actingAs($user)->get('/admin/products');
        
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_create_product_with_image()
    {
        Storage::fake('public');
    
        $admin = User::factory()->create(['is_admin' => 1]);
        $category = Category::factory()->create();
    
        $file = UploadedFile::fake()->image('product.jpg');
    
        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 29.99,
            'stock_qty' => 100,
            'stock_threshold' => 10,
            'image' => $file,
            'category_id' => $category->id,
        ]);
    
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');
    
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 29.99,
        ]);
    
        // Verify image_path was saved
        $product = Product::where('name', 'Test Product')->first();
        $this->assertNotNull($product->image_path);
        $this->assertStringContainsString('products/', $product->image_path);
    }

    /** @test */
    public function admin_can_update_product()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Old Name',
            'category_id' => $category->id,
        ]);
        
        $response = $this->actingAs($admin)->put("/admin/products/{$product->id}", [
            'name' => 'New Name',
            'description' => $product->description,
            'price' => $product->price,
            'stock_qty' => $product->stock_qty,
            'stock_threshold' => $product->stock_threshold,
            'category_id' => $category->id,
        ]);
        
        $response->assertRedirect(route('admin.products.index'));
        
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Name',
        ]);
    }

    /** @test */
    public function admin_can_delete_product()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $product = Product::factory()->create();
        
        $response = $this->actingAs($admin)->delete("/admin/products/{$product->id}");
        
        $response->assertRedirect(route('admin.products.index'));
        
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /** @test */
    public function product_shows_correct_stock_status()
    {
        $inStock = Product::factory()->create(['stock_qty' => 50, 'stock_threshold' => 10]);
        $lowStock = Product::factory()->create(['stock_qty' => 5, 'stock_threshold' => 10]);
        $outOfStock = Product::factory()->create(['stock_qty' => 0, 'stock_threshold' => 10]);
        
        $this->assertEquals('In Stock', $inStock->getStockStatus());
        $this->assertEquals('Low Stock', $lowStock->getStockStatus());
        $this->assertEquals('Out of Stock', $outOfStock->getStockStatus());
    }
}