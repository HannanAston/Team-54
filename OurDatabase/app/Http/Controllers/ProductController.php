<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {

    public function index(){ 
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    
    public function show(Product $product){ 
        return view('products.show', compact('product'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")->get();
        return view('products.search', compact('results', 'query'));
    }


    // Show all products for admin management
    public function adminIndex(){
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    // Show form to create new product
    public function create(){
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'stock_threshold' => 'required|integer|min:0',
            'image_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // Show form to edit product
    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'stock_threshold' => 'required|integer|min:0',
            'image_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}