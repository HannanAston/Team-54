<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\StockHistory;


class ProductController extends Controller {

    public function index(){ 
        $products = Product::paginate(9);
        $categories = Category::All();
        return view('products.index', compact('products', 'categories'));
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


    public function adminIndex(Request $request){
        $query = $request->query('query');
        $category = $request->query('category');

        $products = Product::with('category')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->when($category, function ($q) use ($category) {
                $q->where('category_id', $category);
            })
            ->get();

        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function adminSearch(Request $request){
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")->get();
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $imagePath;
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $imagePath;
        }

        StockHistory::create([
            'product_id' => $product->id,
            'old_stock' => $product->getOriginal('stock_qty'),
            'new_stock' => $validated['stock_qty'],
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function stockReport(){
        // Stock data
        $totalProducts = Product::count();
        $inStock = Product::where('stock_qty', '>', DB::raw('stock_threshold'))->count();
        $lowStock = Product::where('stock_qty', '>', 0)
                            ->where('stock_qty', '<=', DB::raw('stock_threshold'))
                            ->get();
        $outOfStock = Product::where('stock_qty', 0)->get();
    
        $totalValue = Product::sum(DB::raw('stock_qty * price'));
    
        // Order data
        $recentOrders = \App\Models\Order::with(['user', 'orderItems.product'])
                                            ->orderBy('created_at', 'desc')
                                            ->take(10)
                                            ->get();
    
        $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();
        $todayRevenue = \App\Models\Order::whereDate('created_at', today())->sum('total');
    
        $thisWeekOrders = \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $thisWeekRevenue = \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');
    
        return view('admin.reports.stock', compact(
            'totalProducts', 'inStock', 'lowStock', 'outOfStock', 'totalValue',
            'recentOrders', 'todayOrders', 'todayRevenue', 'thisWeekOrders', 'thisWeekRevenue'
        ));
    }

    public function productCarousel() {
        $products = Product::take(10)->get();

        return view('welcome', compact('products'));
    }
}