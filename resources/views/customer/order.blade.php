@extends('layouts.app')
@section('title','Orderan')
@section('content')
<div class="max-w-4xl mx-auto py-10">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Pesanan</h2>

    <div class="space-y-4">
        @forelse ($orders as $order)
        <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-900">Nomor: {{ $order->order_number }}</p>
                <p class="text-gray-600">Status: {{ ucfirst($order->status) }}</p>
                <p class="text-gray-600">
                    Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </p>
            </div>

            <a href="{{ route('customer.order.detail', $order->id) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Detail
            </a>
        </div>
        @empty
        <p class="text-gray-600">Belum ada pesanan.</p>
        @endforelse
    </div>

</div>
@endsection
