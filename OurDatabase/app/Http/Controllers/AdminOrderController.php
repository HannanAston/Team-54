<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Stats across ALL orders (not filtered)
        $stats = [
            'all'            => Order::count(),
            'processing'     => Order::where('order_status', 'processing')->count(),
            'completed'      => Order::where('order_status', 'completed')->count(),
            'return pending' => Order::where('order_status', 'return pending')->count(),
            'returned'       => Order::where('order_status', 'returned')->count(),
            'cancelled'      => Order::where('order_status', 'cancelled')->count(),
        ];

        $orders = Order::with(['orderItems.product', 'user'])
            ->when(request('status'), fn($q) => $q->where('order_status', request('status')))
            ->when(request('search'), fn($q) => $q
                ->where('id', 'like', '%' . request('search') . '%')
                ->orWhereHas('user', fn($u) => $u
                    ->where('name',  'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                )
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.order-manage', compact('orders', 'stats'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id'  => 'required|exists:orders,id',
            'newStatus' => 'required|in:completed,cancelled,returned',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->update(['order_status' => $request->newStatus]);

        return redirect()->back()->with('success', "Order #{$order->id} marked as \"{$request->newStatus}\".");
    }
}
