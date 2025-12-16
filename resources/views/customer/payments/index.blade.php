@extends('layouts.app')
@section('title', 'Daftar Bukti Pembayaran')
@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-100 mb-2">Daftar Bukti Pembayaran</h1>
        <p class="text-gray-100 text-sm">Riwayat pembayaran {{ Auth::user()->role === 'admin' ? 'semua pengguna' : 'Anda' }}</p>

        @if (session('success'))
        <div class="mt-4 bg-green-700 rounded-md shadow-md text-white p-3 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="mt-4 bg-red-700 rounded-md shadow-md text-white p-3 text-center">
            {{ session('error') }}
        </div>
        @endif
    </div>

    @if($payments->isEmpty())
    <div class="text-center py-12">
        <div class="text-gray-300 mb-4">
            <i class="fas fa-receipt text-5xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-100 mb-2">Belum ada bukti pembayaran</h3>
        <p class="text-gray-300">Tidak ada data pembayaran yang ditemukan.</p>
    </div>
    @else
    <div class="md:hidden space-y-4">
        @foreach ($payments as $index => $payment)
        <div class="bg-white/20 rounded-xl shadow-lg border border-gray-100 p-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-gray-100/20 rounded-full text-sm font-medium">
                            {{ $index + 1 + ($payments->currentPage() - 1) * $payments->perPage() }}
                        </span>
                        <h3 class="text-lg font-semibold text-gray-100">
                            {{ $payment->order->user->name ?? 'N/A' }}
                        </h3>
                    </div>
                    <p class="text-sm text-gray-300">
                        Order #{{ $payment->order->order_number ?? $payment->order->id }}
                    </p>
                </div>
            </div>

            <div class="space-y-3 mb-4">
                @if($payment->order && $payment->order->total_price)
                <div>
                    <p class="text-xs text-gray-400">Total Order</p>
                    <p class="text-sm font-medium text-gray-100">Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}</p>
                </div>
                @endif

                <div>
                    <p class="text-xs text-gray-400">Tanggal</p>
                    <p class="text-sm font-medium text-gray-100">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">Bukti Pembayaran</p>
                    @if($payment->bukti)
                    <div class="flex items-center gap-3">
                        <a href="{{ asset('storage/'.$payment->bukti_pembayaran) }}" target="_blank"
                           class="inline-flex items-center gap-2 text-blue-300 hover:text-blue-200 transition">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Lihat Gambar</span>
                        </a>
                        <a href="{{ asset('storage/'.$payment->bukti_pembayaran) }}" download
                           class="inline-flex items-center gap-2 text-green-300 hover:text-green-200 transition">
                            <i class="fas fa-download"></i>
                            <span>Download</span>
                        </a>
                    </div>
                    @else
                    <p class="text-sm text-gray-300">Tidak ada bukti</p>
                    @endif
                </div>
            </div>

            @if(Auth::user()->role === 'admin' && $payment->order && $payment->order->status === 'pending')
            <div class="flex gap-2 pt-3 border-t border-gray-100/20">
                <form action="{{ route('orders.update-status', ['order' => $payment->order->id, 'status' => 'paid']) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-green-500/20 text-green-300 rounded-lg hover:bg-green-500/30 transition duration-200 font-medium text-sm">
                        <i class="fas fa-check"></i> Setujui Pembayaran
                    </button>
                </form>
                <form action="{{ route('orders.update-status', ['order' => $payment->order->id, 'status' => 'cancelled']) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-red-500/20 text-red-300 rounded-lg hover:bg-red-500/30 transition duration-200 font-medium text-sm">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <div class="hidden md:block bg-white/20 rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50/20 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">No</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Customer</th>
                        @endif
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Order ID</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Total</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Bukti</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Status Order</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Tanggal</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white/20 divide-y divide-gray-200">
                    @foreach ($payments as $index => $payment)
                    <tr class="hover:bg-gray-50/10 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{ $index + 1 + ($payments->currentPage() - 1) * $payments->perPage() }}
                            </div>
                        </td>

                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{ $payment->order->user->name ?? 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-300">
                                {{ $payment->order->user->email ?? '' }}
                            </div>
                        </td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{ $payment->order->order_code ?? 'ORDER-' . $payment->order_id }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                @if($payment->order && $payment->order->total_price)
                                Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}
                                @else
                                -
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payment->bukti)
                            <div class="flex gap-2">
                                <a href="{{ asset('storage/'.$payment->bukti) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-1 text-blue-300 hover:text-blue-200 transition text-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ asset('storage/'.$payment->bukti) }}"
                                   download
                                   class="inline-flex items-center gap-1 text-green-300 hover:text-green-200 transition text-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            @else
                            <span class="text-sm text-gray-300">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payment->order && $payment->order->status)
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                {{ $payment->order->status === 'Pending' ? 'bg-yellow-500/20 text-yellow-300' :
                                   ($payment->order->status === 'Paid' ? 'bg-green-500/20 text-green-300' :
                                   'bg-red-500/20 text-red-300') }}">
                                {{ strtoupper($payment->order->status) }}
                            </span>
                            @else
                            <span class="text-sm text-gray-300">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-100">
                                {{ $payment->created_at->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-300">
                                {{ $payment->created_at->format('H:i') }}
                            </div>
                        </td>

                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payment->order && $payment->order->status === 'Pending')
                            <div class="flex gap-2">
                                <form action="{{ route('orders.update-status', ['order' => $payment->order->id, 'status' => 'Paid']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-500/20 text-green-300 rounded-lg hover:bg-green-500/30 transition duration-200 text-xs font-medium"
                                        title="Setujui Pembayaran">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('orders.update-status', ['order' => $payment->order->id, 'status' => 'canceled']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500/20 text-red-300 rounded-lg hover:bg-red-500/30 transition duration-200 text-xs font-medium"
                                        title="Tolak Pembayaran">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-sm text-gray-300">-</span>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($payments->hasPages())
    <div class="mt-6">
        {{ $payments->links() }}
    </div>
    @endif
    @endif
</div>
@endsection
