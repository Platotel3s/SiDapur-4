@extends('layouts.app')
@section('title','Cart')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 text-white">Keranjang Belanja</h1>

    @if ($cart->item->isEmpty())
    <p class="text-gray-600">Keranjang kamu masih kosong.</p>
    @else

    <div class="bg-white shadow rounded-lg p-4">
        @foreach ($cart->item as $item)
        <div class="flex items-center justify-between border-b py-4">

            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $item->produk->thumbnail) }}" class="w-20 h-20 object-cover rounded">

                <div>
                    <h3 class="font-semibold">{{ $item->produk->name }}</h3>
                    <p class="text-gray-600 text-sm">
                        Rp {{ number_format($item->produk->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form action="#" method="POST">
                    @csrf
                    <input type="number" value="{{ $item->quantity }}" min="1" class="w-16 p-1 border rounded">
                </form>

                <p class="font-bold">
                    Rp {{ number_format($item->quantity * $item->produk->price, 0, ',', '.') }}
                </p>
            </div>

        </div>
        @endforeach
    </div>

    <div class="flex justify-between items-center mt-6">
        <p class="text-xl font-semibold">
            Total:
            Rp {{ number_format($cart->item->sum(fn($i) => $i->quantity * $i->produk->price), 0, ',', '.') }}
        </p>

        <a href="/checkout" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
            Checkout
        </a>
    </div>

    @endif

</div>
@endsection
