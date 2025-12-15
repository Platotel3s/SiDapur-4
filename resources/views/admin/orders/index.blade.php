@extends('layouts.app')
@section('title', 'Konfirmasi Pembayaran')
@section('content')

<div class="min-h-screen bg-white/10 py-6 px-4 sm:px-6 lg:px-8 border border-yellow-500 rounded-2xl">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">Konfirmasi Pembayaran Customer</h1>
            <p class="text-gray-100 mt-2">Kelola dan verifikasi status pembayaran pesanan</p>

            @if(session('success'))
            <div class="mt-4 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start">
                <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start">
                <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-red-800 font-medium">{{ session('error') }}</span>
            </div>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $orders->total() }}</p>
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

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Belum Bayar</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">
                            {{ $orders->where('status', 'Pending')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Sudah Dibayar</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">
                            {{ $orders->where('status', 'Paid')->count() }}
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

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-purple-600 mt-1">
                            Rp {{ number_format($orders->where('status', 'Paid')->sum('total_price'), 0, ',',
                            '.') }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex-1">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="relative">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari order / customer..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                </path>
                            </svg>
                            <button type="submit"
                                class="absolute right-3 top-2.5 text-gray-400 hover:text-blue-500 transition duration-200">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex gap-2">
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700">
                        <option value="">Semua Status</option>
                        <option value="unpaid">Belum Bayar</option>
                        <option value="paid">Sudah Bayar</option>
                    </select>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:hidden space-y-4">
            @forelse($orders as $order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-900">#{{ $order->order_number }}</span>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $order->status == 'Pending' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $order->status == 'Pending' ? 'Pending' : 'Paid' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="text-lg font-bold text-gray-800">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Customer</p>
                            <p class="font-medium">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                            <p class="text-sm text-gray-600">{{ $order->user->phone }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Metode</p>
                                <span class="font-medium">{{ strtoupper($order->payment_method) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-4 pt-3 border-t border-gray-100">
                    @if($order->status == 'Pending')
                    <form action="{{ route('mark.paid', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tandai Sudah Bayar
                        </button>
                    </form>
                    @else
                    <button
                        class="w-full bg-gray-200 text-gray-700 font-medium py-2.5 px-4 rounded-lg flex items-center justify-center gap-2"
                        disabled>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sudah Dibayar
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="max-w-sm mx-auto">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada pesanan</h3>
                    <p class="text-gray-600">Belum ada pesanan yang perlu dikonfirmasi</p>
                </div>
            </div>
            @endforelse
        </div>
        <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Order #</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Customer</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Total</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Status</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Metode</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Bayar</th>
                            <th class="py-4 px-2 text-left text-gray-700 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-gray-900">#{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->user->phone }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-gray-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    {{
                                    $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                                       ($order->status == 'canceled' ? 'bg-purple-100 text-red-800' :
                                       ($order->status == 'Paid' ? 'bg-green-100 text-green-800' :
                                       'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                    {{ strtoupper($order->payment_method) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($order->status == 'Pending')
                                <span
                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium flex items-center gap-1 w-fit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Belum Dibayar
                                </span>
                                @else
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium flex items-center gap-1 w-fit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Sudah Dibayar
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($order->status == 'Pending')
                                <form action="{{ route('mark.paid', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200 font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Tandai Lunas
                                    </button>
                                </form>
                                @else
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-600 rounded-lg font-medium text-sm cursor-not-allowed"
                                    disabled>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Sudah Lunas
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div
                                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada pesanan</h3>
                                    <p class="text-gray-600">Belum ada pesanan yang perlu dikonfirmasi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                {{ $orders->links() }}
            </div>
        </div>
        @endif
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Panduan Konfirmasi Pembayaran</h4>
                    <ul class="text-gray-600 space-y-1">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Pastikan customer telah mengirimkan bukti pembayaran sebelum menandai sebagai "Sudah
                                Bayar"</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Verifikasi nominal dan metode pembayaran sesuai dengan total order</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Setelah dikonfirmasi, sistem akan mengubah status order menjadi "processing" secara
                                otomatis</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirmModal"
    class="hidden fixed inset-0 bg-transparent bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div
        class="bg-gradient-to-br from-black to-red-500 border border-yellow-500 rounded-xl p-6 w-full max-w-md shadow-lg">
        <h3 class="text-lg font-bold mb-4 text-white">Konfirmasi Pembayaran</h3>
        <p class="text-gray-100 mb-6">Apakah Anda yakin ingin menandai pembayaran ini sebagai LUNAS?</p>
        <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeModal()"
                class="px-4 py-2 border border-gray-300 text-gray-100 rounded-lg hover:bg-red-500">
                Batal
            </button>
            <button id="confirmButton" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Ya, Konfirmasi
            </button>
        </div>
    </div>
</div>

<script src="{{ asset('js/orderanAdmin.js') }}"></script>
@endsection
