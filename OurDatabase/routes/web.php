<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
});
require __DIR__.'/auth.php';

Route::get('/cart', function () {
    #$Cart = Cart::where('user_id', auth()->id())->first();
    #$CartItems = CartItem::where('cart_id', $Cart->id)->get();
    #$productIds = $CartItems->pluck('product_id');
    #$products = Product::whereIn("id", $productIds)->get();
    $cart = Cart::where('user_id', auth()->id())->first();
    $cartItems = CartItem::where('cart_id', $cart->id)->get();
    foreach ($cartItems as $item) {
        $item->product = Product::find($item->product_id);
    }
    return view('cart', ['items' => $cartItems]);
})->name('cart');

Route::delete('/delete-cartItem/{cartItem}', [CartController::class, 'DeleteCartItem']);
Route::put('/update-cartItem/{cartItem}', [CartController::class, 'UpdateCartItem']);