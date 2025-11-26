@extends('layouts.app')
@section('title','Tampilkan produk')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-6 flex flex-col md:flex-row gap-6">

    <img src="{{ asset('storage/' . $selectedProducts->thumbnail) }}"
        class="w-full md:w-1/2 h-72 object-cover rounded-lg shadow">

    <div class="flex-1">
        <h1 class="text-3xl font-bold">{{ $selectedProducts->name }}</h1>

        <p class="text-gray-700 mt-3">{{ $selectedProducts->description }}</p>

        <p class="mt-4 text-2xl font-semibold text-green-600">
            Rp {{ number_format($selectedProducts->price, 0, ',', '.') }}
        </p>

        <form action="{{ route('cart.add', $selectedProducts->id) }}" method="POST" class="mt-6">
            @csrf
            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                + Tambah ke Keranjang
            </button>
        </form>

    </div>
</div>
@endsection
