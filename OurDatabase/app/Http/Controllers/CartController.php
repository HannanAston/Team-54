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
    //Works for both guest and logged in users
    public function show()
    {
        $cartItems = [];
        if (auth()->check()) {
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

            $cartItems = CartItem::where('cart_id', $cart->id)->get();

            foreach ($cartItems as $item) {
                $item->product = Product::find($item->product_id);
            }

            $orderCount = auth()->check() ? auth()->user()->orders()->count() : 0;


            return view('cart', ['items' => $cartItems], ['orderCount' => $orderCount]);
        } else {

            $cart = session()->get('Cart', []);

            //$cartItems = CartItem::where('cart_id', $cart->id)->get();

            foreach ($cart as $item) {
                $item['product'] = Product::find($item['product_id']);
                $cartItems[] = (object) $item;
            }

            return view('cart', ['items' => $cartItems]);

        }
        //return view ('cart', ['items' => [session()->get('Cart', [''])]]);
    }


    //Works for both guest and logged in users
    public function deleteCartItem($id) {
        if (auth()->check()) {
            $cartItem = CartItem::findOrFail($id);
            if($cartItem->cart && $cartItem->cart->user_id === auth()->id()) {
                $cartItem->delete();
                return redirect("/cart");
            }
            abort(403);
        } else {
            $cart = session()->get('Cart', []);
            unset($cart[$id]);
            session()->put('Cart', $cart);
            return redirect("/cart");
        }

    }

        public function updateCartItem($id, Request $request) {
            if (auth()->check()) {
                $cartItem = CartItem::findOrFail($id);
                if($cartItem->cart && $cartItem->cart->user_id === auth()->id()) {
                    $incomingFields = $request->validate([
                        "quantity" => 'required',
                    ]);

                    $product = Product::find($cartItem->product_id);
                    $result = $product->stock_qty - $incomingFields['quantity'];

                    if ($result < 0) {
                        return redirect()->back()->with("error", "No more stock!");
                    }

                    $cartItem->update($incomingFields);
                    return redirect("/cart");
                }

            } else {
                $cart = session()->get('Cart', []);

                foreach ($cart as &$cartItem) {
                    if ($cartItem['product_id'] == $id) {
                        $product = Product::find($id);
                        $incomingFields = $request->validate([
                            "quantity" => 'required',
                        ]);
                        $result = $product->stock_qty - $incomingFields['quantity'];

                        if ($result < 0) {
                            return redirect()->back()->with('error', 'No more stock!');
                        }

                        $cartItem['quantity'] = $request->quantity;
                        break;
                    }
                }

                session()->put('Cart', $cart);

                return redirect("/cart");

            }
        }

        //Works for both guest and logged in users
        public function addToCart(Product $product)
        {

            if ($product->stock_qty <= 0) {
                return redirect()->back()->with('error', 'No stock left!');
            }

            if (auth()->check()) {
                $userId = auth()->id();

                $cart = Cart::firstOrCreate([
                    'user_id' => $userId,
                ]);


                $cartItem = CartItem::firstOrCreate(
                    [
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                    ],
                    [
                        'quantity' => 0,
                    ]
                );

                $cartItem->quantity += 1;
                $cartItem->save();

                return redirect()
                ->route('cart')
                ->with('Success', 'Product added to cart.');
            } else {

                $cart = session() -> get('Cart', []);

                if(isset($cart[$product->id])) {
                    $cart[$product->id]['quantity']++;
                } else {
                    $cart[$product->id] = [
                        'product_id' => $product->id,
                        'quantity' => 1
                    ];
                }

                session()->put('Cart', $cart);

                return redirect()
                ->route('cart')
                ->with('Success', 'Product added to cart.');


            }

            
        }
}
