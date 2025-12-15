@extends('layouts.app')
@section('title', 'Custom Bumbu Orders')
@section('content')
<div class="min-h-screen bg-white/10 border rounded-2xl border-yellow-500 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-100">Custom Bumbu Orders</h1>
                    <p class="text-gray-100 mt-1">Kelola dan pantau pesanan bumbu custom dari customer</p>
                </div>
                <div class="flex items-center gap-4">
                    <button onclick="window.print()"
                        class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-200">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white/10 rounded-xl shadow-sm border border-yellow-500 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-100 text-sm">Pending</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">
                            {{ $customize->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 rounded-xl shadow-sm border border-yellow-500 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-100 text-sm">Confirmed</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">
                            {{ $customize->where('status', 'confirmed')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 rounded-xl shadow-sm border border-yellow-500 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-100 text-sm">Cancelled</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">
                            {{ $customize->where('status', 'cancelled')->count() }}
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white/10 rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" placeholder="Cari produk / customer..."
                            class="w-full pl-10 pr-4 py-2.5 border border-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-white outline-none">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-100"></i>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select class="border border-gray-300 rounded-lg px-3 py-2.5 text-gray-100">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Reviewed</option>
                        <option value="completed">Confirmed</option>
                        <option value="cancelled">Rejected</option>
                    </select>
                    <button
                        class="px-4 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:hidden space-y-4">
            @forelse($customize as $c)
            <div class="bg-white/10 rounded-xl shadow-sm border border-yellow-500 overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $c->produk->name ?? 'Custom Bumbu' }}</h3>
                            <p class="text-sm text-gray-600">{{ $c->user->name }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                               ($c->status == 'reviewed' ? 'bg-blue-100 text-blue-800' :
                               ($c->status == 'confirmed' ? 'bg-green-100 text-green-800' :
                               'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($c->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-500">Tanggal Order</p>
                            <p class="text-sm text-gray-800">{{ $c->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">ID Order</p>
                            <p class="text-sm text-gray-800">#{{ $c->id }}</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.custom.show', $c->id) }}"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg text-center transition duration-200">
                            <i class="fas fa-eye mr-2"></i>Detail
                        </a>
                        <button class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="max-w-sm mx-auto">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-mortar-pestle text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada custom order</h3>
                    <p class="text-gray-600">Customer belum membuat pesanan custom bumbu</p>
                </div>
            </div>
            @endforelse
        </div>
        <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Produk</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Customer</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Tanggal</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Status</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($customize as $c)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    @if($c->produk->thumbnail ?? false)
                                    <img src="{{ asset('storage/' . $c->produk->thumbnail) }}"
                                        alt="{{ $c->produk->name }}" class="w-10 h-10 object-cover rounded-lg">
                                    @else
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-mortar-pestle text-gray-400"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $c->produk->name ?? 'Custom Bumbu' }}
                                        </p>
                                        @if($c->produk)
                                        <p class="text-sm text-gray-500">{{ $c->produk->category->name ?? 'Bumbu' }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $c->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $c->user->email }}</p>
                                    <p class="text-sm text-gray-500">{{ $c->user->phone ?? 'No phone' }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="text-gray-700">{{ $c->created_at->format('d/m/Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $c->created_at->format('H:i') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1.5 rounded-full text-sm font-medium
                                    {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                       ($c->status == 'reviewed' ? 'bg-blue-100 text-blue-800' :
                                       ($c->status == 'confirmed' ? 'bg-green-100 text-green-800' :
                                       'bg-red-100 text-red-800')) }}">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.custom.show', $c->id) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition duration-200 font-medium text-sm">
                                        <i class="fas fa-eye"></i>
                                        Detail
                                    </a>
                                    <button class="p-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div
                                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-mortar-pestle text-2xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada custom order</h3>
                                    <p class="text-gray-600 mb-4">Customer belum membuat pesanan custom bumbu</p>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali ke Dashboard
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($customize->hasPages())
        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                {{ $customize->links() }}
            </div>
        </div>
        @endif
        <div class="mt-8 bg-linear-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-lightbulb text-amber-600 text-xl"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Tips Mengelola Custom Order</h4>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-amber-500 mt-1"></i>
                            <span>Segera konfirmasi order yang masuk untuk meningkatkan customer satisfaction</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-amber-500 mt-1"></i>
                            <span>Komunikasi dengan customer untuk detail custom yang lebih spesifik</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-amber-500 mt-1"></i>
                            <span>Update status secara berkala agar customer tahu progress order mereka</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('select').addEventListener('change', function (e) {
        const status = e.target.value;
        if (status) {
            window.location.href = `?status=${status}`;
        }
    });
    let searchTimeout;
    document.querySelector('input[type="text"]').addEventListener('input', function (e) {
        clearTimeout(searchTimeout);
        const searchTerm = e.target.value.trim();

        searchTimeout = setTimeout(() => {
            if (searchTerm.length >= 2 || searchTerm.length === 0) {
                const url = new URL(window.location.href);
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                } else {
                    url.searchParams.delete('search');
                }
                window.location.href = url.toString();
            }
        }, 500);
    });
</script>

@endsection
