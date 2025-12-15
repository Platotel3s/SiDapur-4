<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payments::with(['order.user'])->latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'bukti' => 'required|image|max:5120',
        ]);
        $order = Orders::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->firstOrFail();
        if ($order->payment) {
            return redirect()->back()->with('error', 'Order ini sudah memiliki pembayaran.');
        }
        $buktiPath = $request->file('bukti')->store('bukti_pembayaran/' . $user->id, 'public');

        Payments::create([
            'order_id' => $order->id,
            'bukti' => $buktiPath,
        ]);
        $order->update(['status' => 'Paid']);

        return redirect()->route('index.payment.customer')->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function show($id)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $payment = Payments::with(['order.user'])->findOrFail($id);
        } else {
            $payment = Payments::whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['order.user'])->findOrFail($id);
        }

        return view('customer.payments.show', compact('payment'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $payment = Payments::findOrFail($id);
        if ($user->role !== 'admin' && $payment->order->user_id !== $user->id) {
            abort(403);
        }
        if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
            Storage::disk('public')->delete($payment->bukti);
        }
        $payment->order()->update(['status' => 'pending']);
        $payment->delete();

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
