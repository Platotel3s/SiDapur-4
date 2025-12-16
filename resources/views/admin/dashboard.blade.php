@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-8">Dashboard Admin SiDapur</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg p-6 shadow-lg">
            <div class="text-white">
                <p class="text-sm opacity-80">Total Pengguna</p>
                <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                <div class="flex justify-between text-sm mt-2">
                    <span class="inline-block px-2 py-1 bg-blue-800 rounded-full text-xs">
                        Admin: {{ $adminCount }}
                    </span>
                    <span class="inline-block px-2 py-1 bg-blue-900 rounded-full text-xs">
                        Customer: {{ $customerCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg p-6 shadow-lg">
            <div class="text-white">
                <p class="text-sm opacity-80">Total Produk</p>
                <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                <div class="flex justify-between text-sm mt-2">
                    <span>Kategori: {{ $totalCategories }}</span>
                    @if($outOfStockProducts > 0)
                    <span class="text-red-200">Habis: {{ $outOfStockProducts }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-500 to-purple-700 rounded-lg p-6 shadow-lg">
            <div class="text-white">
                <p class="text-sm opacity-80">Total Pesanan</p>
                <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                <p class="text-sm mt-2">
                    Pendapatan: <br>
                    <span class="font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 rounded-lg p-6 shadow-lg">
            <div class="text-white">
                <p class="text-sm opacity-80">Custom Orders</p>
                <p class="text-3xl font-bold">{{ $totalCustomOrders }}</p>
                <div class="text-sm mt-2">
                    <span class="inline-block px-2 py-1 bg-yellow-800 rounded-full text-xs">
                        Pending: {{ $pendingCustomOrders }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Status Pesanan</h2>
            <div class="h-64">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Status Custom Orders</h2>
            <div class="h-64">
                <canvas id="customOrderStatusChart"></canvas>
            </div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Top 5 Produk Terlaris</h2>
            <div class="h-64">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Metode Pembayaran</h2>
            <div class="h-64">
                <canvas id="paymentMethodChart"></canvas>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Pesanan Terbaru</h2>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="py-2 text-left">Order #</th>
                            <th class="py-2 text-left">Customer</th>
                            <th class="py-2 text-left">Total</th>
                            <th class="py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr class="border-b border-gray-700 hover:bg-white/5">
                            <td class="py-2">{{ $order->order_number }}</td>
                            <td class="py-2">
                                @if($order->user)
                                {{ $order->user->name }}
                                @else
                                User Deleted
                                @endif
                            </td>
                            <td class="py-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-2">
                                @if($order->status == 'Paid')
                                <span class="px-2 py-1 bg-green-500 rounded-full text-xs">Paid</span>
                                @elseif($order->status == 'Pending')
                                <span class="px-2 py-1 bg-yellow-500 rounded-full text-xs">Pending</span>
                                @else
                                <span class="px-2 py-1 bg-red-500 rounded-full text-xs">Canceled</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">Tidak ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Custom Orders Pending</h2>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="py-2 text-left">ID</th>
                            <th class="py-2 text-left">Customer</th>
                            <th class="py-2 text-left">Status</th>
                            <th class="py-2 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingCustomOrdersList as $customOrder)
                        <tr class="border-b border-gray-700 hover:bg-white/5">
                            <td class="py-2">#{{ $customOrder->id }}</td>
                            <td class="py-2">
                                @if($customOrder->user)
                                {{ $customOrder->user->name }}
                                @else
                                User Deleted
                                @endif
                            </td>
                            <td class="py-2">
                                <span class="px-2 py-1
                                    @if($customOrder->status == 'pending') bg-yellow-500
                                    @elseif($customOrder->status == 'reviewed') bg-blue-500
                                    @elseif($customOrder->status == 'confirmed') bg-green-500
                                    @else bg-red-500 @endif
                                    rounded-full text-xs">
                                    {{ ucfirst($customOrder->status) }}
                                </span>
                            </td>
                            <td class="py-2">{{ $customOrder->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">Tidak ada custom orders pending</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($lowStockProducts->count() > 0)
    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-red-500 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.33 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                Produk Stok Sedikit
            </h2>
            <span class="text-red-400 text-sm">{{ $lowStockProducts->count() }} produk</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-white">
                <thead>
                    <tr class="border-b border-gray-600">
                        <th class="py-2 text-left">Nama Produk</th>
                        <th class="py-2 text-left">Stok</th>
                        <th class="py-2 text-left">Harga</th>
                        <th class="py-2 text-left">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockProducts as $product)
                    <tr class="border-b border-gray-700 hover:bg-white/5">
                        <td class="py-2">{{ $product->name }}</td>
                        <td class="py-2">
                            <span class="px-2 py-1 bg-red-500 rounded-full text-xs">
                                {{ $product->stock }} {{ $product->unit }}
                            </span>
                        </td>
                        <td class="py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-2">
                            @if($product->category)
                            {{ $product->category->name }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderStatusCtx = document.getElementById('orderStatusChart');
    if (orderStatusCtx) {
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Paid', 'Canceled'],
                datasets: [{
                    data: [
                        {{ $orderStatusCount['pending'] ?? 0 }},
                        {{ $orderStatusCount['paid'] ?? 0 }},
                        {{ $orderStatusCount['canceled'] ?? 0 }}
                    ],
                    backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
                    borderWidth: 1,
                    borderColor: '#1f2937'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            padding: 20
                        }
                    }
                }
            }
        });
    }
    const customOrderCtx = document.getElementById('customOrderStatusChart');
    if (customOrderCtx) {
        new Chart(customOrderCtx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Reviewed', 'Confirmed', 'Rejected'],
                datasets: [{
                    data: [
                        {{ $customOrderStatus['pending'] ?? 0 }},
                        {{ $customOrderStatus['reviewed'] ?? 0 }},
                        {{ $customOrderStatus['confirmed'] ?? 0 }},
                        {{ $customOrderStatus['rejected'] ?? 0 }}
                    ],
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                    borderWidth: 1,
                    borderColor: '#1f2937'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            padding: 20
                        }
                    }
                }
            }
        });
    }
    const topProductsCtx = document.getElementById('topProductsChart');
    if (topProductsCtx) {
        const topProducts = @json($topProducts);
        const labels = topProducts.map(p => p.product ? p.product.name.substring(0, 15) + (p.product.name.length > 15 ? '...' : '') : 'Product Deleted');
        const data = topProducts.map(p => p.total_sold);

        new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: data,
                    backgroundColor: ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444'],
                    borderWidth: 1,
                    borderColor: '#1f2937'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff',
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#fff',
                            maxRotation: 45
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Terjual: ' + context.raw + ' unit';
                            }
                        }
                    }
                }
            }
        });
    }
    const paymentMethodCtx = document.getElementById('paymentMethodChart');
    if (paymentMethodCtx) {
        new Chart(paymentMethodCtx, {
            type: 'bar',
            data: {
                labels: ['COD', 'Transfer'],
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: [
                        {{ $paymentMethods['cod'] ?? 0 }},
                        {{ $paymentMethods['transfer'] ?? 0 }}
                    ],
                    backgroundColor: ['#10b981', '#3b82f6'],
                    borderWidth: 1,
                    borderColor: '#1f2937'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff',
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#fff'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
});
</script>
@endsection
