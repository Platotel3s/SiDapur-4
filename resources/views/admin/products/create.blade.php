{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Tambah Produk Baru</h1>
            <p class="text-gray-300">Isi form berikut untuk menambahkan produk baru</p>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('store.products') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Product Name -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Nasi Goreng Special"
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

                <!-- Slug -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Contoh: nasi-goreng-special"
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

                <!-- Category ID -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-3 transition duration-200 appearance-none cursor-pointer">
                        <option value="">--- Pilih Kategori ---</option>
                        @foreach ($categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('category_id', isset($pilihProduk) ? $pilihProduk->
                            category_id : '') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                        @endforeach
                    </select>
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

                <!-- Description -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" rows="4" placeholder="Deskripsi lengkap tentang produk..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">{{
                        old('description') }}</textarea>
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

                <!-- Price and Stock -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 25000"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                            required>
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

                    <!-- Stock and Unit -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Stok
                            </label>
                            <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Contoh: 100"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Satuan
                            </label>
                            <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Contoh: porsi"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                        </div>
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Thumbnail
                    </label>
                    <input type="file" name="thumbnail"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                        accept="image/*">
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

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Produk
                    </button>
                    <a href="{{ route('index.products') }}"
                        class="flex-1 bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
