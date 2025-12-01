@extends('layouts.app')
@section('title', 'Pesanan Berhasil - SiDapur')
@section('content')
<link rel="stylesheet" type="stylesheet" href="" {{ asset('css/order_success.css') }}>
<div class="min-h-screen py-6 sm:py-12 px-4 rounded-2xl">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">Checkout Berhasil!</h1>
            <p class="text-gray-300 text-lg">Pesanan kamu sudah kami terima dan sedang diproses</p>
        </div>
        <div class="lg:hidden space-y-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-700">
                    <div>
                        <h3 class="text-sm font-medium text-gray-400">Nomor Pesanan</h3>
                        <p class="text-xl font-bold text-white">{{ $order->order_number }}</p>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $order->payment_status == 'paid' ? 'bg-green-900/50 text-green-300' : 'bg-red-900/50 text-red-300' }}">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Total Harga</span>
                        <span class="text-xl font-bold text-amber-400">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Metode Pembayaran</span>
                        <span class="text-white font-medium">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tanggal Pesanan</span>
                        <span class="text-white">{{ $order->created_at->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Item Pesanan</h3>
                <div class="space-y-4">
                    @foreach ($order->itemOrder as $item)
                    <div class="flex items-start gap-3 p-3 bg-gray-900/30 rounded-lg">
                        @if($item->product->thumbnail)
                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt="{{ $item->product->name }}"
                            class="w-16 h-16 object-cover rounded-lg">
                        @else
                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif

                        <div class="flex-1">
                            <h4 class="font-medium text-white">{{ $item->product->name }}</h4>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-gray-400">
                                    {{ $item->kuantitas }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                </span>
                                <span class="font-semibold text-white">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-6 border-t border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Total Pesanan</span>
                        <span class="text-2xl font-bold text-amber-400">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <a href="{{ route('customer.orders') }}"
                    class="block w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold py-4 px-6 rounded-xl transition duration-200 text-center">
                    <i class="fas fa-history mr-2"></i>
                    Lihat Riwayat Pesanan
                </a>

                <a href="{{ route('customer.products') }}"
                    class="block w-full bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 text-center">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Belanja Lagi
                </a>

                <button onclick="shareOrder()"
                    class="block w-full bg-purple-900/50 hover:bg-purple-800/50 text-purple-300 font-semibold py-3 px-6 rounded-xl transition duration-200 text-center border border-purple-700">
                    <i class="fas fa-share-alt mr-2"></i>
                    Bagikan Pesanan
                </button>
            </div>
        </div>
        <div class="hidden lg:block bg-gray-800/50 backdrop-blur-sm rounded-2xl overflow-hidden border border-gray-700">
            <div class="p-8 border-b border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-2xl font-bold text-white">Pesanan #{{ $order->order_number }}</h2>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $order->payment_status == 'paid' ? 'bg-green-900/50 text-green-300' : 'bg-red-900/50 text-red-300' }}">
                                {{ strtoupper($order->payment_status) }}
                            </span>
                        </div>
                        <p class="text-gray-400">
                            Dipesan pada {{ $order->created_at->translatedFormat('l, d F Y, H:i') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400">Total Pembayaran</p>
                        <p class="text-3xl font-bold text-amber-400">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-8 p-8">
                <div class="col-span-2">
                    <h3 class="text-xl font-semibold text-white mb-6">Detail Pesanan</h3>
                    <div class="bg-gray-900/30 rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-800/50">
                                <tr>
                                    <th class="py-4 px-6 text-left text-gray-300 font-semibold">Produk</th>
                                    <th class="py-4 px-6 text-left text-gray-300 font-semibold">Harga</th>
                                    <th class="py-4 px-6 text-left text-gray-300 font-semibold">Kuantitas</th>
                                    <th class="py-4 px-6 text-left text-gray-300 font-semibold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @foreach ($order->itemOrder as $item)
                                <tr class="hover:bg-gray-800/30 transition duration-150">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            @if($item->product->thumbnail)
                                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                alt="{{ $item->product->name }}"
                                                class="w-12 h-12 object-cover rounded-lg">
                                            @endif
                                            <span class="text-white font-medium">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-amber-400">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-white">{{ $item->kuantitas }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-semibold text-white">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8 bg-gray-900/30 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-white mb-4">Informasi Pembayaran</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 mb-1">Metode Pembayaran</p>
                                <p class="text-white font-medium">{{ strtoupper($order->payment_method) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 mb-1">Status Pembayaran</p>
                                <p
                                    class="font-semibold {{ $order->payment_status == 'paid' ? 'text-green-400' : 'text-red-400' }}">
                                    {{ strtoupper($order->payment_status) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="bg-gray-900/30 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-white mb-4">Ringkasan Pesanan</h4>
                        <div class="space-y-3">
                            @php
                            $subtotal = $order->itemOrder->sum('subtotal');
                            $shipping = 0;
                            $tax = 0;
                            @endphp
                            <div class="flex justify-between">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Pengiriman</span>
                                <span class="text-white">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Pajak</span>
                                <span class="text-white">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-700">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-white">Total</span>
                                    <span class="text-2xl font-bold text-amber-400">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <a href="{{ route('customer.orders') }}"
                            class="block w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 text-center">
                            <i class="fas fa-history mr-2"></i>
                            Lihat Riwayat
                        </a>

                        <a href="{{ route('customer.products') }}"
                            class="block w-full bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 text-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Belanja Lagi
                        </a>

                        <button onclick="shareOrder()"
                            class="block w-full bg-purple-900/50 hover:bg-purple-800/50 text-purple-300 font-semibold py-3 px-6 rounded-xl transition duration-200 text-center border border-purple-700">
                            <i class="fas fa-share-alt mr-2"></i>
                            Bagikan Pesanan
                        </button>

                        <button onclick="printOrder()"
                            class="block w-full bg-gray-700/50 hover:bg-gray-600/50 text-gray-300 font-semibold py-3 px-6 rounded-xl transition duration-200 text-center border border-gray-600">
                            <i class="fas fa-print mr-2"></i>
                            Cetak Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 bg-gray-800/30 backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-2">Pesanan Sedang Diproses</h4>
                    <p class="text-gray-300">
                        Pesanan #{{ $order->order_number }} sedang kami persiapkan. Kamu akan mendapatkan notifikasi
                        ketika pesanan sudah dikirim.
                        Estimasi pengiriman: 1-3 hari kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/order_success.js') }}"></script>
@endsection
