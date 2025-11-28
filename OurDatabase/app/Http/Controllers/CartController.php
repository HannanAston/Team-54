<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

            $cartItems = CartItem::where('cart_id', $cart->id)->get();

            foreach ($cartItems as $item) {
                $item->product = Product::find($item->product_id);
            }

            return view('cart', ['items' => $cartItems]);
        }
        return view ('cart', ['items' => []]);
    }



    public function DeleteCartItem(CartItem $cartItem) {
        if($cartItem->Cartproduct && $cartItem->Cartproduct->user_id === auth()->id()) {
            $cartItem->delete();
            return redirect("/cart");
        }
    }

        public function UpdateCartItem(CartItem $cartItem, Request $request) {
        if($cartItem->Cartproduct && $cartItem->Cartproduct->user_id === auth()->id()) {
            $incomingFields = $request->validate([
                "quantity" => 'required',
            ]);
            $cartItem->update($incomingFields);
            return redirect("/cart");
        }
    }
}
