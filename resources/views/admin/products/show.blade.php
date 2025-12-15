@extends('layouts.app')
@section('title', $pilihProduk->name)
@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Detail Produk</h1>
                <p class="text-gray-300">Informasi lengkap tentang produk</p>
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <a href="{{ route('edit.products', $pilihProduk->id) }}"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('index.products') }}"
                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-linear-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
                    <div
                        class="w-full lg:w-48 h-48 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex items-center justify-center">
                        @if($pilihProduk->thumbnail)
                        <img src="{{ asset('storage/'.$pilihProduk->thumbnail) }}" alt="{{ $pilihProduk->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm">No Image</p>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">{{ $pilihProduk->name }}</h2>
                        <div class="flex flex-wrap items-center gap-4 mb-3">
                            <span class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($pilihProduk->price, 0, ',', '.') }}
                            </span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                Stok: {{ $pilihProduk->stock }} {{ $pilihProduk->unit }}
                            </span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Slug: {{ $pilihProduk->slug }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-lg">{{ $pilihProduk->description ?: 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informasi Produk
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Nama Produk</span>
                                <span class="font-semibold text-gray-800">{{ $pilihProduk->name }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Slug</span>
                                <span class="font-semibold text-gray-800">{{ $pilihProduk->slug }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Kategori</span>
                                <span class="font-semibold text-gray-800">
                                    {{ $pilihProduk->category ? $pilihProduk->category->name : 'Tidak ada kategori' }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Harga</span>
                                <span class="font-semibold text-green-600 text-lg">
                                    Rp {{ number_format($pilihProduk->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Stok</span>
                                <span class="font-semibold text-gray-800">
                                    {{ $pilihProduk->stock }} {{ $pilihProduk->unit }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Satuan</span>
                                <span class="font-semibold text-gray-800">
                                    {{ $pilihProduk->unit ?: 'Tidak tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Informasi Tambahan
                        </h3>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Deskripsi Produk
                            </h4>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                @if($pilihProduk->description)
                                <p class="text-gray-700 leading-relaxed">{{ $pilihProduk->description }}</p>
                                @else
                                <p class="text-gray-500 italic">Tidak ada deskripsi untuk produk ini</p>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-blue-600 font-medium">Status</p>
                                        <p class="text-lg font-bold text-blue-800">
                                            {{ $pilihProduk->stock > 0 ? 'Tersedia' : 'Habis' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-green-600 font-medium">Harga</p>
                                        <p class="text-lg font-bold text-green-800">
                                            Rp {{ number_format($pilihProduk->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 pt-8 mt-8 border-t border-gray-200">
                    <a href="{{ route('edit.products', $pilihProduk->id) }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 font-semibold shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Produk
                    </a>

                    <form method="post" action="{{ route('delete.products', $pilihProduk->id) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 font-semibold shadow-md"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $pilihProduk->name }}?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Produk
                        </button>
                    </form>

                    <a href="{{ route('index.products') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 font-semibold shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex flex-wrap justify-between items-center text-sm text-gray-500">
                <div class="flex items-center gap-4">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dibuat: {{ $pilihProduk->created_at->format('d M Y H:i') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Diupdate: {{ $pilihProduk->updated_at->format('d M Y H:i') }}
                    </span>
                </div>
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                    ID: {{ $pilihProduk->id }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
