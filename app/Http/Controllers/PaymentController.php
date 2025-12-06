<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payments::with('order')->latest()->paginate(10);

        return view('customer.payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Orders::all();

        return view('customer.payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'bukti' => 'nullable|image|max:2048',
        ]);
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Payments::create([
            'order_id' => $request->order_id,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payment = Payments::with('order')->findOrFail($id);

        return view('customer.payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payments::findOrFail($id);
        $orders = Orders::all();

        return view('customer.payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payments::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'bukti' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('bukti')) {
            if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
                Storage::disk('public')->delete($payment->bukti);
            }
            $payment->bukti = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }
        $payment->update([
            'order_id' => $request->order_id,
            'bukti' => $request->bukti,
        ]);

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Payments::findOrFail($id);
        if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
            Storage::disk('public')->delete($payment->bukti);
        }

        $payment->delete();

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
