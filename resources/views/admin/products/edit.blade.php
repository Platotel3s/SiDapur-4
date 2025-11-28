{{-- resources/views/admin/products/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Edit Produk</h1>
            <p class="text-gray-300">Perbarui informasi produk</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('update.products', $pilihProduk->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PATCH')
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $pilihProduk->name) }}"
                        placeholder="Contoh: Nasi Goreng Special"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                        required>
                    @error('name')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="slug" value="{{ old('slug', $pilihProduk->slug) }}"
                        placeholder="Contoh: nasi-goreng-special"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                        required>
                    @error('slug')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Kategori
                    </label>

                    <div class="relative">
                        <select name="category_id"
                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-3 pr-10 transition duration-200 appearance-none cursor-pointer shadow-sm hover:border-gray-400">
                            <option value="" class="text-gray-400">--- Pilih Kategori ---</option>
                            @foreach ($categories as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('category_id', $pilihProduk->category_id) ==
                                $kategori->id ? 'selected' : '' }}
                                class="text-gray-900">
                                {{ $kategori->name }}
                            </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    @error('category_id')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" rows="4" placeholder="Deskripsi lengkap tentang produk..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">{{
                        old('description', $pilihProduk->description) }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">Rp</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price', $pilihProduk->price) }}"
                                placeholder="25000"
                                class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                required>
                        </div>
                        @error('price')
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Stok
                            </label>
                            <input type="number" name="stock" value="{{ old('stock', $pilihProduk->stock) }}"
                                placeholder="100"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Satuan
                            </label>
                            <input type="text" name="unit" value="{{ old('unit', $pilihProduk->unit) }}"
                                placeholder="porsi"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Thumbnail
                    </label>
                    @if($pilihProduk->thumbnail)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Thumbnail Saat Ini:</p>
                        <div class="w-32 h-32 bg-gray-200 rounded-lg overflow-hidden border border-gray-300">
                            <img src="{{ asset('storage/'.$pilihProduk->thumbnail) }}" alt="Current thumbnail"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif
                    <input type="file" name="thumbnail"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*">
                    <p class="text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>

                    @error('thumbnail')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Produk
                    </button>
                    <a href="{{ route('show.products', $pilihProduk->id) }}"
                        class="flex-1 bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                    </a>
                    <a href="{{ route('index.products') }}"
                        class="flex-1 bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
        @if(session('success'))
        <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
