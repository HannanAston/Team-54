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

Route::get('/', function () {
    return view('welcome');
    $products = Product::all();
    return view('welcome', ['products' => $products]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//profiles
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
});
require __DIR__.'/auth.php';

// user cart and checkout
Route::get('/cart', [CartController::class, 'show'])->name('cart');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/delete-cartItem/{cartItem}', [CartController::class, 'deleteCartItem'])->name('cart.update');
    Route::put('/update-cartItem/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.delete');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');


});
//contact form
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendEnquiry'])->name('contact');

//products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])->whereNumber('product')->name('products.show');


