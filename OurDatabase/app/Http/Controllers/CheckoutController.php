<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderReceipt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LowStockNotification;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {   

        if (auth()->check()) {
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

            DB::beginTransaction();
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
                
                // Increment user's order count
                $user->increment('order_count');
                foreach ($cartItems as $item) {
                    $item->product->update([
                        'stock_qty' => $item->product->stock_qty - $item->quantity
                    ]);

                    $item->product->refresh();

                    if ($item->product->stock_qty <= $item->product->stock_threshold) {
                            $admins = User::where('is_admin', 1)->get();
                            Notification::send($admins, new LowStockNotification($item->product));
                    }
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
            
        } else {
            // Create a temporary guest user object
            //$user = (object)[
                //'name' => $request->input('name', 'Guest'),
                //'email' => $request->input('email', 'guest@example.com'),
                //'order_count' => 0
            //];

            // Get guest cart from session
            $cart = session()->get('Cart', []);

            if (empty($cart)) {
                return response()->json(['message' => 'Cart is empty'], 400);
            }

            // Convert session cart items to objects
            $cartItems = [];
            foreach ($cart as $cartItem) {
                $product = Product::find($cartItem['product_id']);
                if (!$product) continue;
                $cartItems[] = (object)[
                    'product_id' => $product->id,
                    'quantity' => $cartItem['quantity'],
                    'product' => $product,
                ];
            }

            //$guestUser = User::create([
                //'name' => "Guest",
                //'email' => "Guest@gmail.com",
                //'password' => bcrypt(str()->random(16)), // random password
            //]);

            DB::beginTransaction();
            try {
                // Calculate subtotal
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += $item->product->price * $item->quantity;
                }

   
                $discount = 0;

                // Calculate total
                $total = $subtotal - $discount;

            
                $order = Order::create([
                    'user_id' => null, 
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

                    // Update product stock
                    $item->product->update([
                        'stock_qty' => $item->product->stock_qty - $item->quantity
                    ]);
                    $item->product->refresh();

        
                    if ($item->product->stock_qty <= $item->product->stock_threshold) {
                        $admins = User::where('is_admin', 1)->get();
                        Notification::send($admins, new LowStockNotification($item->product));
                    }
                }

              
                session()->forget('Cart');

                DB::commit();

                // Cant send email to guest since no guest email.
                //Mail::to($user->email)->send(new OrderReceipt($order));

                $message = 'Order placed successfully';
                $order = $order->load('orderItems.product'); // eager load for view
               // $guestUser->delete();
                return view('orderConfirmation', compact('message', 'order'));

            } catch (\Exception $e) {
                DB::rollBack();
                $message = 'Checkout failed';
                $error = $e->getMessage();
                return view('orderConfirmation', compact('message', 'order', 'error'));
            }
        } 
    }
}