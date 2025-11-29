@extends('layouts.app')
@section('title','order success')
@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-8 text-center">

        <h2 class="text-3xl font-bold text-green-600">Checkout Berhasil!</h2>
        <p class="text-gray-600 mt-2">Pesanan kamu sudah kami terima.</p>

        <div class="my-6 border-t border-gray-200"></div>

        <div class="space-y-3 text-left">
            <div>
                <p class="font-semibold text-gray-800">Nomor Pesanan</p>
                <p class="text-gray-600">{{ $order->order_number }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Total Harga</p>
                <p class="text-gray-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Metode Pembayaran</p>
                <p class="text-gray-600">{{ strtoupper($order->payment_method) }}</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Status Pembayaran</p>
                <span class="px-3 py-1 rounded-full text-white text-sm
                    {{ $order->payment_status == 'paid' ? 'bg-green-600' : 'bg-red-600' }}">
                    {{ strtoupper($order->payment_status) }}
                </span>
            </div>
        </div>

        <h3 class="mt-10 text-xl font-semibold text-gray-800">Item Pesanan</h3>

        <div class="mt-4 bg-gray-50 rounded-lg p-4 divide-y">
            @foreach ($order->itemOrder as $item)
            <div class="py-3 flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                    <p class="text-gray-600">{{ $item->kuantitas }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                    </p>
                </div>
                <p class="font-semibold text-gray-700">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>

        <a href="{{ route('customer.orders') }}"
            class="mt-8 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Lihat Riwayat Pesanan
        </a>
    </div>
</div>
@endsection
