<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Get the user's cart with items + products
        $cart = Cart::with(['items.product'])->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty',
            ], 400);
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart->items as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        // Loyalty discount: 10% on every 5th order
        $currentOrderCount = $user->order_count ?? 0;
        $isFifthOrder = (($currentOrderCount + 1) % 5) === 0;

        $discount = $isFifthOrder ? round($subtotal * 0.10, 2) : 0;
        $total = $subtotal - $discount;

        // Create order
        $order = Order::create([
            'user_id'  => $user->id,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => $total,
        ]);

        // Create order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Clear cart items
        $cart->items()->delete();

        // Increment order count on user
        $user->order_count = $currentOrderCount + 1;
        $user->save();

        // Send email receipt
        Mail::to($user->email)->send(new OrderReceipt($order));

        return response()->json([
            'message' => 'Order placed successfully',
        ], 201);
    }
}
