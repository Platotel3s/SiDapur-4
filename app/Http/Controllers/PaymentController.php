<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm($id)
    {
        $order = Orders::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Pesanan sudah dibayar.');
        }

        return view('customer.payment_form', compact('order'));
    }
    public function storePayment(Request $request, $id)
    {
        $order = Orders::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'provider' => 'required|string',
        ]);
        $proofPath = $request->file('payment_proof')->store('payment-proof', 'public');

        Payments::create([
            'order_id' => $order->id,
            'payment_proof' => $proofPath,
            'provider' => $request->provider,
            'paid_at' => now(),
            'amount' => $order->total_price,
        ]);
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);

        return redirect()->route('customer.orders')->with('success', 'Pembayaran berhasil diupload.');
    }
    public function adminList()
    {
        $payments = Payments::with('order.user')->latest()->get();

        return view('admin.payments.index', compact('payments'));
    }
    public function verifyPayment($id)
    {
        $payment = Payments::findOrFail($id);

        $payment->order->update([
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function customerList()
    {
        $payments = Payments::with('order')
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('customer.payments.index', compact('payments'));
    }
}
