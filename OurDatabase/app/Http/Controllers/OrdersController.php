<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use function Laravel\Prompts\select;

class OrdersController extends Controller
{
    public function show(){ 

        $orders = Order::where('user_id', auth()->id())->get();

        foreach ($orders as $order) {
            $order->orderItems = OrderItem::where('order_id', $order->id)->get();
        }

        return view('orders', compact('orders'));
    }

    public function updateStatus(Request $request) {
        

        $incomingFields = $request -> validate([
            'order_id' => 'required',
            'newStatus' => 'required',
        ]);

        $order = Order::findOrFail($incomingFields['order_id']);


        if($incomingFields['newStatus'] == "cancelled") {
            $order->update(['order_status' => $incomingFields['newStatus']]);
            return back()->with('success', "Order status updated to {can}");

        } elseif($incomingFields['newStatus'] == "returned") {
            $order->update(['order_status' => 'return pending']);
            return back()->with('success', "Order status updated to {can}");

        } elseif($incomingFields['newStatus'] == "cancel return") {
            $order->update(['order_status' => 'completed']);
            return back()->with('success', "Order status updated to {can}");

        } else {
            return back()->with('success', "Order status updated to {can}");

        }
    }
}
