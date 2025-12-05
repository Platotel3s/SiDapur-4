@extends('layouts.app')
@section('title', 'Riwayat Pesanan - SiDapur')
@section('content')
<link rel="stylesheet" type="" href="{{ asset('css/order.css') }}">
<div class="min-h-screen py-6 sm:py-8 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 sm:mb-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-100">Total Pesanan</p>
                            <p class="text-2xl font-bold text-gray-100 mt-1">{{ $orders->total() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-100">Selesai</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">
                                {{ $orders->where('status', 'paid')->count() }}
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:hidden space-y-4">
            @forelse ($orders as $order)
            <div class="bg-white/10 rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-100">#{{ $order->order_number }}</span>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium {{ getStatusColor($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-100">
                                {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                            </p>
                        </div>
                        <span class="text-lg font-bold text-gray-100">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex -space-x-2">
                            @foreach($order->itemOrder->take(3) as $item)
                            @if($item->product->thumbnail)
                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                alt="{{ $item->product->name }}"
                                class="w-8 h-8 object-cover rounded-full border-2 border-white">
                            @else
                            <div
                                class="w-8 h-8 bg-gray-200 rounded-full border-2 border-white flex items-center justify-center">
                                <span class="text-xs text-gray-100">{{ substr($item->product->name, 0, 1) }}</span>
                            </div>
                            @endif
                            @endforeach
                            @if($order->itemOrder->count() > 3)
                            <div
                                class="w-8 h-8 bg-gray-100/10 rounded-full border-2 border-white flex items-center justify-center">
                                <span class="text-xs text-gray-100">+{{ $order->itemOrder->count() - 3 }}</span>
                            </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-100">
                                {{ $order->itemOrder->count() }} item •
                                {{ $order->itemOrder->sum('kuantitas') }} pcs
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <div>
                            <span class="text-gray-100">Metode:</span>
                            <span class="font-medium text-gray-100 ml-1">{{ strtoupper($order->payment_method) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-100">Status Bayar:</span>
                            <span
                                class="font-medium {{ $order->payment_status == 'paid' ? 'text-green-600 p-1 rounded' : 'text-red-600 bg-white p-1 rounded' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4 pt-3 border-t border-gray-100">
                    <div class="flex gap-2">
                        <a href="{{ route('order.success', $order->id) }}"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg text-center transition duration-200">
                            <i class="fas fa-eye mr-2"></i>
                            Detail
                        </a>
                        @if($order->status == 'delivered')
                        <button
                            class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-redo mr-1"></i>
                            Pesan Lagi
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white/10 rounded-2xl shadow-sm p-8 text-center">
                <div class="max-w-sm mx-auto">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-600 mb-6">Yuk, mulai belanja dan buat pesanan pertama Anda!</p>
                    <a href="{{ route('customer.products') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-shopping-cart"></i>
                        Mulai Belanja
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        <div class="hidden lg:block bg-white/10 rounded-2xl shadow-lg border border-yellow-500 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/10">
                        <tr>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Pesanan</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Tanggal</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Status</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Item</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Total</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Pembayaran</th>
                            <th class="py-4 px-6 text-left text-gray-100 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50/5 transition duration-150">
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-gray-100">#{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-100">{{ strtoupper($order->payment_method) }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-gray-100">{{ $order->created_at->format('d/m/Y') }}</p>
                                <p class="text-sm text-gray-100">{{ $order->created_at->format('H:i') }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-medium {{ getStatusColor($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <div class="flex -space-x-2">
                                        @foreach($order->itemOrder->take(2) as $item)
                                        @if($item->product->thumbnail)
                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-8 h-8 object-cover rounded-full border-2 border-white">
                                        @endif
                                        @endforeach
                                    </div>
                                    <span class="text-gray-100">{{ $order->itemOrder->count() }} items</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-semibold text-gray-100">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span
                                        class="{{ $order->payment_status == 'paid' ? 'text-green-600 p-1 rounded-xl bg-white text-center' : 'text-red-600 text-center p-1 rounded-xl bg-white' }} font-medium">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                    @if($order->payment_status == 'pending' && $order->status != 'cancelled')
                                    <button class="text-sm text-blue-600 hover:text-blue-800 mt-1">
                                        Bayar Sekarang
                                    </button>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('order.success', $order->id) }}"
                                        class="px-4 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition duration-200 font-medium text-sm">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                    @if($order->status == 'delivered')
                                    <button
                                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div
                                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada pesanan</h3>
                                    <p class="text-gray-600 mb-4">Mulai belanja untuk membuat pesanan pertama</p>
                                    <a href="{{ route('produk') }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg transition duration-200">
                                        <i class="fas fa-shopping-cart"></i>
                                        Belanja Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                {{ $orders->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@php
function getStatusColor($status) {
switch($status) {
case 'pending': return 'bg-yellow-100 text-yellow-800';
case 'processing': return 'bg-blue-100 text-blue-800';
case 'shipped': return 'bg-purple-100 text-purple-800';
case 'delivered': return 'bg-green-100 text-green-800';
case 'cancelled': return 'bg-red-100 text-red-800';
default: return 'bg-gray-100 text-gray-800';
}
}
@endphp

<script src="{{ asset('js/order.js') }}"></script>
@endsection
