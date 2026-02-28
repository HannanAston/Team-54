<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderReceipt;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        
        // Get user's cart items
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        
        $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        
        try {
            // Calculate subtotal
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
            
            // Check for loyalty discount (every 5 orders = 10% off)
            $discount = 0;
            if (($user->order_count + 1) % 5 == 0) {
                $discount = $subtotal * 0.10;
            }
            
            // Calculate total
            $total = $subtotal - $discount;
            
            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
            ]);
            
            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            DB::beginTransaction();
            
            // Increment user's order count
            $user->increment('order_count');
            foreach ($cartItems as $item) {
                $item->product->decrement('stock_qty', $item->quantity);
            }
            
            // Clear cart
            CartItem::where('cart_id', $cart->id)->delete();
            
            DB::commit();
            
            // Send email receipt
            Mail::to($user->email)->send(new OrderReceipt($order));
            

            
            $message = 'Order placed successfully';
            $order = $order->load('orderItems.product');
            return view("orderConfirmation", compact('message', 'order'));

            #return response()->json([
                #'message' => 'Order placed successfully',
                #'order' => $order->load('orderItems.product'),
            #], 201);
            
        } catch (\Exception $e) {
            $message = 'Checkout failed';
            $error =  $e->getMessage();
            DB::rollBack();
            return view("orderConfirmation", compact('message', 'order', 'error'));
        }
    }
}