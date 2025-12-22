@extends('layouts.app')
@section('title','Product Customers')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-white">Katalog Produk</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-full h-40 object-cover rounded">
            <h2 class="text-md font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 60) }}</p>
            <p class="font-bold text-green-600">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <div class="flex justify-between">
                <div class="mt-1 flex gap-1 items-center">
                    <button onclick="openCustomModal({{ $product->id }}, '{{ $product->name }}')"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black text-sm px-3 py-1 rounded"> <i class="fas fa-edit"></i>
                        Custom Bumbu
                    </button>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-600 hover:bg-green-700 text-black text-sm px-3 py-1 rounded">
                            + Keranjang
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
<div id="customModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-lg font-bold mb-4" id="modalProductName">Custom Bumbu</h2>

        <form id="customForm" method="POST">
            @csrf
            <input type="hidden" name="product_id" id="modalProductId">

            <textarea name="request_note" class="w-full border rounded p-2" rows="3"
                placeholder="Deskripsi custom bumbu..." required></textarea>

            <input type="text" name="namaPenerima" class="w-full border rounded p-2 mt-3" placeholder="Nama Penerima"
                required>

            <input type="text" name="nomorHp" class="w-full border rounded p-2 mt-3" placeholder="Nomor WhatsApp"
                required>

            <textarea name="alamat" class="w-full border rounded p-2 mt-3" placeholder="Alamat lengkap"
                required></textarea>

            <div class="mt-4 flex justify-between">
                <button type="button" onclick="closeCustomModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>

                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
