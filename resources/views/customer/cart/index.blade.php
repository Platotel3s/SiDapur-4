@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-white">Keranjang Belanja</h1>
    @if (session('success'))
    <div class="mt-6 bg-green-900/50 border border-green-700 rounded-xl p-4 flex items-center gap-3">
        <i class="fas fa-check-circle text-green-400 text-xl"></i>
        <p class="font-semibold text-green-300">{{ session('success') }}</p>
    </div>
    @endif
    @if ($cart->item->isEmpty())
    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center border border-gray-700">
        <div class="flex flex-col items-center justify-center py-12">
            <svg class="w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-300 mb-2">Keranjang Kamu Kosong</h3>
            <p class="text-gray-400 mb-6">Yuk, tambahkan produk favoritmu!</p>
            <a href="{{ route('customer.products') }}"
                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                <i class="fas fa-store"></i>
                Mulai Belanja
            </a>
        </div>
    </div>
    @else
    <div class="md:hidden space-y-4">
        @foreach ($cart->item as $item)
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-gray-700">
            <div class="flex gap-3">
                <img src="{{ asset('storage/' . $item->produk->thumbnail) }}" alt="{{ $item->produk->name }}"
                    class="w-20 h-20 object-cover rounded-lg">

                <div class="flex-1">
                    <h3 class="font-semibold text-white mb-1">{{ $item->produk->name }}</h3>
                    <p class="text-amber-400 font-medium mb-2">
                        Rp {{ number_format($item->produk->price, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                class="flex items-center">
                                @csrf
                                <button type="button" onclick="decrementQuantity(this)"
                                    class="w-8 h-8 flex items-center justify-center bg-gray-700 rounded-l hover:bg-gray-600">
                                    <i class="fas fa-minus text-sm"></i>
                                </button>
                                <input type="number" name="kuantitas" value="{{ $item->kuantitas }}" min="1"
                                    class="w-12 h-8 text-center bg-gray-800 text-white border-y border-gray-700">
                                <button type="button" onclick="incrementQuantity(this)"
                                    class="w-8 h-8 flex items-center justify-center bg-gray-700 rounded-r hover:bg-gray-600">
                                    <i class="fas fa-plus text-sm"></i>
                                </button>
                                <button type="submit" class="ml-2 text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus {{ $item->produk->name }} dari keranjang?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <div class="mt-3 pt-3 border-t border-gray-700">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Subtotal:</span>
                            <span class="font-semibold text-white">
                                Rp {{ number_format($item->kuantitas * $item->produk->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="hidden md:block bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden border border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="py-4 px-6 text-left text-gray-300 font-semibold">Produk</th>
                        <th class="py-4 px-6 text-left text-gray-300 font-semibold">Harga</th>
                        <th class="py-4 px-6 text-left text-gray-300 font-semibold">Kuantitas</th>
                        <th class="py-4 px-6 text-left text-gray-300 font-semibold">Subtotal</th>
                        <th class="py-4 px-6 text-left text-gray-300 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($cart->item as $item)
                    <tr class="hover:bg-gray-800/30 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item->produk->thumbnail) }}"
                                    alt="{{ $item->produk->name }}" class="w-16 h-16 object-cover rounded-lg">
                                <div>
                                    <h3 class="font-semibold text-white">{{ $item->produk->name }}</h3>
                                    @if($item->produk->stock < 10) <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-900/50 text-red-300">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Stok terbatas: {{ $item->produk->stock }}
                                        </span>
                                        @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-amber-400 font-medium">
                                Rp {{ number_format($item->produk->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                class="flex items-center gap-2">
                                @csrf
                                <div class="flex items-center border border-gray-600 rounded-lg overflow-hidden">
                                    <button type="button" onclick="decrementQuantity(this)"
                                        class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gray-700">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="kuantitas" value="{{ $item->kuantitas }}" min="1"
                                        max="{{ $item->produk->stock }}"
                                        class="w-16 h-10 text-center bg-gray-900 text-white border-x border-gray-600">
                                    <button type="button" onclick="incrementQuantity(this, {{ $item->produk->stock }})"
                                        class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gray-700">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button type="submit" class="text-blue-400 hover:text-blue-300" title="Update quantity">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @if($item->kuantitas > $item->produk->stock)
                            <p class="text-red-400 text-sm mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Stok tersedia: {{ $item->produk->stock }}
                            </p>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-white">
                                Rp {{ number_format($item->kuantitas * $item->produk->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus {{ $item->produk->name }} dari keranjang?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-900/30 hover:bg-red-900/50 text-red-300 rounded-lg transition duration-200">
                                    <i class="fas fa-trash"></i>
                                    <span class="hidden lg:inline">Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Ringkasan Belanja</h3>
                <div class="space-y-3">
                    @php
                    $subtotal = $cart->item->sum(fn($i) => $i->kuantitas * $i->produk->price);
                    $shipping = 0;
                    $total = $subtotal + $shipping;
                    @endphp
                    <div class="flex justify-between">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="pt-3 border-t border-gray-700">
                        <div class="flex justify-between">
                            <span class="text-lg font-semibold text-white">Total</span>
                            <span class="text-2xl font-bold text-amber-400">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <label for="pay_cod">COD</label>
                <input type="radio" name="payment_method" id="pay_cod" value="cod" checked>
                <label for="pay_transfer">Transfer</label>
                <input type="radio" name="payment_method" id="pay_transfer" value="transfer">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-bold py-4 px-6 rounded-xl transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                    <i class="fas fa-shopping-bag"></i>
                    Lanjutkan ke Checkout
                </button>
            </form>

            <a href="{{ route('customer.products') }}"
                class="block w-full bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 text-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Lanjutkan Belanja
            </a>
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="mt-6 bg-yellow-900/50 border border-yellow-700 rounded-xl p-4 flex items-center gap-3">
        <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
        <div>
            <p class="font-semibold text-yellow-300">{{ session('error') }}</p>
            @if (session('error_details'))
            <p class="text-yellow-400/80 text-sm mt-1">{{ session('error_details') }}</p>
            @endif
        </div>
    </div>
    @endif


</div>

<script>
    function incrementQuantity(button, maxStock = null) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="kuantitas"]');
        let value = parseInt(input.value) || 1;

        if (maxStock && value >= maxStock) {
            showNotification(`Stok maksimal ${maxStock}`, 'warning');
            return;
        }

        input.value = value + 1;
    }

    function decrementQuantity(button) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="kuantitas"]');
        let value = parseInt(input.value) || 1;

        if (value > 1) {
            input.value = value - 1;
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 transform transition-transform duration-300 ${type === 'warning' ? 'bg-yellow-600' : 'bg-blue-600'
            }`;
        notification.textContent = message;
        notification.style.transform = 'translateX(100%)';
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
</script>

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection
