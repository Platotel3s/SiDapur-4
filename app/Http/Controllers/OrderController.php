<?php

namespace App\Http\Controllers;

use App\Models\CustomOrders;
use App\Models\Orders;
use Illuminate\Http\Request;

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
        $query = Orders::with('user', 'alamat')->orderBy('created_at', 'desc');

        if (request('q')) {
            $q = request('q');

            $query->where(function ($qr) use ($q) {
                $qr->whereHas('user', function ($user) use ($q) {
                    $user->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                })
                    ->orWhere('order_number', 'like', "%$q%");
            });
        }

        if (request('payment_status')) {
            $query->where('payment_status', request('payment_status'));
        }

        $orders = $query->paginate(5)->appends(request()->query());

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

    public function customOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'request_note' => 'required|string|max:2000',
            'namaPenerima' => 'required|string',
            'nomorHp' => 'required|string|max:13',
            'alamat' => 'required|string|max:2000',
        ]);
        CustomOrders::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'request_note' => $request->request_note,
            'namaPenerima' => $request->namaPenerima,
            'nomorHp' => $request->nomorHp,
            'alamat' => $request->alamat,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan custom bumbu berhasil dikirim! Admin akan menghubungi Anda.');
    }

    public function indexCustom()
    {
        $customize = CustomOrders::paginate(5);

        return view('admin.orders.custom-index', compact('customize'));
    }

    public function customConfirm($id)
    {
        $custom = CustomOrders::with('user', 'produk')->findOrFail($id);

        return view('admin.orders.custom-show', compact('custom'));
    }

    public function approveCustom($id)
    {
        $custom = CustomOrders::findOrFail($id);
        $custom->update([
            'status' => 'reviewed',
        ]);

        return back()->with('success', 'Pesanan custom telah direview dan disetujui!');
    }

    public function rejectCustom($id)
    {
        $custom = CustomOrders::findOrFail($id);
        $custom->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Pesanan berhasil ditolak.');
    }

    public function deleteCustom($id)
    {
        $custom = CustomOrders::findOrFail($id);
        $custom->delete();
        return back()->with('success', 'Berhasil Hapus custom');
    }

    public function confirmCustom($id)
    {
        $custom = CustomOrders::findOrFail($id);
        $custom->update([
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Pesanan berhasil dikonfirmasi!');
    }
}
