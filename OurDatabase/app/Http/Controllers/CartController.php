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



    public function deleteCartItem(CartItem $cartItem) {
        if($cartItem->cart && $cartItem->cart->user_id === auth()->id()) {
            $cartItem->delete();
            return redirect("/cart");
        }
        abort(403);
    }

        public function updateCartItem(CartItem $cartItem, Request $request) {
        if($cartItem->cart && $cartItem->cart->user_id === auth()->id()) {
            $incomingFields = $request->validate([
                "quantity" => 'required',
            ]);

            $product = Product::find($cartItem->product_id);
            $result = $product->stock_qty - $cartItem->quantity;

            if ($result <= 0) {
                return redirect()->back()->with('error', 'No more stock!');
            }

            $cartItem->update($incomingFields);
            return redirect("/cart");
        }
    }

        public function addToCart(Product $product)
        {
            $userId = auth()->id();

            $cart = Cart::firstOrCreate([
                'user_id' => $userId,
            ]);

            if ($product->stock_qty <= 0) {
                return redirect()->back()->with('error', 'No stock left!');
            }
            //fetch or create cart item entry
            $cartItem = CartItem::firstOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                ],
                [
                    'quantity' => 0,
                ]
            );
            // increment quantity
            $cartItem->quantity += 1;
            $cartItem->save();

            return redirect()
            ->route('cart')
            ->with('Success', 'Product added to cart.');
        }
}
