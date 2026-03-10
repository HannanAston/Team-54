<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show(){ 

        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders', compact('orders'));
    }
}
