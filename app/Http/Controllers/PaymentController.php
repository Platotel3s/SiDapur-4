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

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Orders::all();

        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'method' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'bukti' => 'nullable|image|max:2048',
        ]);
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Payments::create([
            'order_id' => $request->order_id,
            'method' => $request->amount,
            'status' => $request->method,
            'bukti' => $request->$buktiPath,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payment = Payments::with('order')->findOrFail($id);

        return view('payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payments::findOrFail($id);
        $orders = Orders::all();

        return view('payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payments::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'method' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
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
            'method' => $request->method,
            'status' => $request->status,
            'bukti' => $request->bukti,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Payments::findOrFail($id);
        if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
            Storage::disk('public')->delete($payment->bukti);
        }

        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
