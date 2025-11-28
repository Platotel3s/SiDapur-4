@extends('layouts.app')
@section('title', 'Tambah Alamat Baru')
@section('content')
<div class="max-w-2xl mx-auto bg-black/40 p-8 shadow-lg rounded-lg">

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Tambah Alamat Baru</h2>
        <p class="text-white mt-2">Isi informasi alamat lengkap untuk pengiriman</p>
    </div>

    <form action="{{ route('alamat.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-white mb-2">Label Alamat</label>
                <input type="text" name="label" placeholder="Contoh: Rumah, Kantor, Apartemen"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-2">Nama Penerima</label>
                <input type="text" name="namaPenerima"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-2">Nomor Telepon</label>
                <input type="text" name="nomorPenerima" placeholder="Contoh: 081234567890"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-white mb-2">Alamat Lengkap</label>
                <textarea name="alamat" rows="3"
                    placeholder="Tulis alamat lengkap termasuk nama jalan, nomor rumah, dll."
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-2">Kota</label>
                <input type="text" name="kota"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-2">Provinsi</label>
                <input type="text" name="provinsi"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-white mb-2">Kode Pos</label>
                <input type="text" name="kodePos"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-white"
                    required>
            </div>
        </div>
        <div class="flex gap-4 pt-4">
            <a href="{{ url()->previous() }}"
                class="flex-1 bg-gray-500 text-white text-center px-6 py-3 rounded-lg hover:bg-gray-600 transition font-medium">
                Kembali
            </a>
            <button type="submit"
                class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Alamat
            </button>
        </div>
    </form>

</div>
@endsection
