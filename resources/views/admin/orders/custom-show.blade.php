@extends('layouts.app')
@section('title', 'Detail Custom Order')
@section('content')
<div class="min-h-screen bg-white/10 rounded-xl border border-yellow-500 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Detail Custom Order</h1>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $custom->status == 'pending' ? 'bg-yellow-500/20 text-yellow-300' :
                       ($custom->status == 'reviewed' ? 'bg-green-500/20 text-green-300' :
                       ($custom->status == 'confirmed' ? 'bg-blue-500/20 text-blue-300' :
                       ($custom->status == 'rejected' ? 'bg-emerald-500/20 text-emerald-300' :
                       'bg-red-500/20 text-red-300'))) }}">
                    {{ ucfirst($custom->status ?? 'Unknown') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-black backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-sticky-note text-blue-400"></i>
                        </div>
                        <h2 class="text-xl font-bold text-white">Catatan Custom</h2>
                    </div>
                    <div class="bg-black rounded-xl p-4 border border-gray-700">
                        <p class="text-gray-300 whitespace-pre-line">{{ $custom->request_note ?? 'Tidak ada catatan' }}
                        </p>
                    </div>
                </div>
                <div class="bg-black backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold text-white mb-4">Detail Customer</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-400 text-sm">Nama Penerima</p>
                                <p class="text-white font-medium">{{ $custom->namaPenerima ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Nomor HP</p>
                                <p class="text-white font-medium">{{ $custom->nomorHp ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Alamat Lengkap</p>
                            <p class="text-white mt-1">{{ $custom->alamat ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('custom.bumbu') }}"
                        class="flex-1 sm:flex-none sm:w-auto flex items-center justify-center gap-2 bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-xl transition duration-200">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>

                    @if($custom->status == 'pending')
                    <form method="post" action="{{ route('admin.custom.approve',$custom->id) }}">
                        @csrf
                        <button
                            class="flex-1 sm:flex-none sm:w-auto flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-xl transition duration-200" type="submit">
                            <i class="fas fa-check"></i>
                            Approve Order
                        </button>
                    </form>
                    <form method="post" action="{{ route('admin.custom.reject',$custom->id) }}">

                    </form>
                    <button class="flex-1 sm:flex-none sm:w-auto flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-xl transition duration-200" type="submit">
                        <i class="fas fa-times"></i>
                        Tolak Order
                    </button>
                    @endif
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-black backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold text-white mb-4">Ringkasan Order</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Tanggal Request</span>
                            <span class="text-white">{{ $custom->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Terakhir Update</span>
                            <span class="text-white">{{ $custom->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="pt-3 border-t border-gray-700">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Status</span>
                                <span class="font-semibold text-white">{{ ucfirst($custom->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-black backdrop-blur-sm rounded-2xl p-6 border border-gray-700">
                    <h2 class="text-xl font-bold text-white mb-4">Aksi</h2>
                    <div class="space-y-3">
                        <button onclick="window.print()"
                            class="w-full flex items-center justify-center gap-2 bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 px-4 rounded-xl transition duration-200">
                            <i class="fas fa-print"></i>
                            Cetak Detail
                        </button>

                        <a href="mailto:?subject=Custom Order #{{ $custom->id }}&body=Detail Order:%0D%0AProduk: {{ $custom->produk->name ?? 'N/A' }}%0D%0ACatatan: {{ $custom->request_note }}%0D%0ANama: {{ $custom->namaPenerima }}%0D%0ANo HP: {{ $custom->nomorHp }}"
                            class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition duration-200">
                            <i class="fas fa-envelope mr-2"></i>
                            Kirim Email
                        </a>

                        <button onclick="copyOrderDetails()"
                            class="w-full flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-4 rounded-xl transition duration-200">
                            <i class="fas fa-copy"></i>
                            Salin Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-black backdrop-blur-sm rounded-2xl p-6 border mt-3 border-blue-700/50">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-blue-500/30 rounded-xl flex items-center justify-center">
                    <i class="fas fa-info-circle text-blue-300"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-2">Informasi</h3>
                    <p class="text-blue-200 text-sm">
                        Order custom ini memerlukan perhatian khusus. Pastikan semua detail sudah sesuai sebelum
                        diproses lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
