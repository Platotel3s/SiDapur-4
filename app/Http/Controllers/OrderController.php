<?php

namespace App\Http\Controllers;

use App\Models\Orders;

class OrderController extends Controller
{
    public function orderList()
    {
        $orders = Orders::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('customer.order', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Orders::with('itemOrder.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('customer.order_detail', compact('order'));
    }

    public function index()
    {
        $orders = Orders::with('user', 'alamat')->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.orders.index', compact('orders'));
    }

    public function sudahBayar(Orders $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'paid',
        ]);

        return back()->with('success', 'Pembayaran Telah Dikonfirmasi');
    }
}
