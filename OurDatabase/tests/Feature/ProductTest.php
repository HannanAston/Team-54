<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{


    Use RefreshDatabase;

    #[Test]
    public function products_index_page_loads(){

        Product::factory()->count(3)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }

    #[Test]
    public function products_detail_page_displays_correct_product(){

        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertSee($product->name);
    }

    #[Test]
    public function search_returns_matching_products(){

        $response = $this->get('/products/search?query=hoodie');

        $response->assertStatus(200);
        $response->assertViewIs('products.search');
        $response->assertSee('hoodie');
        $response->assertDontSee('trousers');
    }
    #[Test]
    public function search_returns_no_results_if_nothing_matches(){

        $response = $this->get('/products/search?query=jeans');

        $response->assertStatus(200);
        $response->assertViewIs('products.search');
        $response->assertSee('No products found');
    
    }
}
