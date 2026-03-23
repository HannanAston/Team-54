<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//profiles
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

//admin routes
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/orders', [UserController::class, 'orders'])->name('admin.users.orders');

    // Product management routes
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    //Route::get('/admin/products/search', [ProductController::class, 'adminSearch'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/reports/stock', [ProductController::class, 'stockReport'])->name('admin.reports.stock');
});
require __DIR__.'/auth.php';

// user cart and checkout
Route::get('/cart', [CartController::class, 'show'])->name('cart');

Route::get('/', [ProductController::class, 'productCarousel'])->name('welcome');

//Route::middleware('auth')->group(function () {
    //Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    //Route::delete('/delete-cartItem/{cartItem}', [CartController::class, 'deleteCartItem'])->name('cart.update');
    //Route::put('/update-cartItem/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.delete');
    //Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//});


//contact form
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendEnquiry'])->name('contact');

//products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])->whereNumber('product')->name('products.show');


//cart (Moved them out of middleware to handle guest carts.)
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/delete-cartItem/{cartItem}', [CartController::class, 'deleteCartItem'])->name('cart.update');
Route::put('/update-cartItem/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.delete');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

//order page
Route::get('/orders', [OrdersController::class, 'show'])->name('orders');
Route::put('/orders/updateStatus', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');

Route::get('/notifications', [ProductController::class, 'lowStockNotifications']);


