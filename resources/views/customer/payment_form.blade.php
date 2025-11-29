@extends('layouts.app')
@section('title','form Pembayaran')
@section('content')
<div class="max-w-xl mx-auto py-10">

    <h2 class="text-2xl font-bold mb-6">Upload Bukti Pembayaran</h2>

    <div class="bg-white shadow rounded-lg p-6">
        <p class="text-gray-700 mb-4">
            Nomor Pesanan: <span class="font-semibold">{{ $order->order_number }}</span>
        </p>
        <p class="text-gray-700 mb-6">
            Total Pembayaran: <span class="font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.')
                }}</span>
        </p>

        <form action="{{ route('customer.payment.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mb-2 font-medium text-gray-700">Metode Transfer / Provider</label>
            <input type="text" name="provider" class="w-full border rounded-lg p-2 mb-4"
                placeholder="e.g. BRI, BCA, OVO">

            <label class="block mb-2 font-medium text-gray-700">Upload Bukti Pembayaran</label>
            <input type="file" name="payment_proof" class="w-full border rounded-lg p-2 mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Upload Pembayaran
            </button>
        </form>
    </div>

</div>
@endsection
