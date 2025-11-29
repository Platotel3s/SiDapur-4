@extends('layouts.app')
@section('title','Order Detail')
@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Pesanan</h2>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p><span class="font-semibold">Nomor Pesanan:</span> {{ $order->order_number }}</p>
        <p><span class="font-semibold">Status:</span> {{ ucfirst($order->status) }}</p>
        <p><span class="font-semibold">Metode Pembayaran:</span> {{ strtoupper($order->payment_method) }}</p>
        <p><span class="font-semibold">Status Pembayaran:</span> {{ ucfirst($order->payment_status) }}</p>
    </div>

    <h3 class="font-semibold text-lg mb-3">Item Pesanan</h3>

    <div class="bg-gray-50 rounded-lg p-4 divide-y">
        @foreach ($order->itemOrder as $item)
        <div class="py-3 flex justify-between items-center">
            <div>
                <p class="font-medium text-gray-800">{{ $item->product->namaProduk }}</p>
                <p class="text-gray-600">
                    {{ $item->kuantitas }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>
            </div>

            <p class="font-semibold text-gray-700">
                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
            </p>
        </div>
        @endforeach
    </div>

    <p class="text-right font-bold text-xl mt-6">
        Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
    </p>

    <a href="{{ route('customer.orders') }}"
        class="mt-6 inline-block bg-gray-700 text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
        Kembali
    </a>
</div>
@endsection
