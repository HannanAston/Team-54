<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;

class CartController extends Controller
{
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
