@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Kategori Baru</h2>
        <p class="text-gray-600">Isi form berikut untuk menambahkan kategori baru</p>
        @if (session('success'))
        <div class="p-2 text-center bg-green-500 text-black rounded-md shadow-md">
            {{session('success')}}
        </div>
        @endif
    </div>
    <form action="{{ route('store.categories') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="space-y-2">
            <label class="block text-gray-700 font-semibold mb-2">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('nama_kategori') }}"
                placeholder="Contoh: Makanan, Elektronik, Fashion"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                autofocus>
            @error('nama_kategori')
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
        <div class="flex gap-4 pt-4">
            <button type="submit"
                class="flex-1 bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Kategori
            </button>
            <a href="{{ route('index.categories') }}"
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
<style>
    .shadow-custom {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection
