@extends('layouts.app')
@section('title','Product Customers')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-white">Katalog Produk</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow p-4">
            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-full h-40 object-cover rounded">
            <h2 class="text-lg font-semibold mt-3">{{ $product->name }}</h2>
            <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 60) }}</p>
            <p class="mt-2 font-bold text-green-600">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <div class="mt-4 flex justify-between">
                <a href="{{ route('customer.products.show', $product->id) }}"
                    class="text-blue-600 hover:underline text-sm">Detail</a>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded">
                        + Keranjang
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
