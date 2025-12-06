@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100">Daftar Pembayaran</h1>
        <a href="{{ route('customer.payments.create') }}"
            class="bg-blue-600 px-4 py-2 rounded text-white hover:bg-blue-700 transition">
            Tambah Pembayaran
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow p-6">
        <table class="w-full text-left text-gray-300">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="py-2">ID</th>
                    <th>Order</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($payments as $p)
                <tr class="border-b border-gray-700">
                    <td class="py-2">{{ $p->id }}</td>
                    <td>{{ $p->order->order_number ?? '-' }}</td>
                    <td>{{ $p->method }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        @if ($p->bukti)
                        <img src="{{ asset('storage/' . $p->bukti) }}" class="w-12 h-12 rounded">
                        @else
                        Tidak ada
                        @endif
                    </td>
                    <td class="flex gap-2 py-2 justify-center">
                        <a href="{{ route('customer.payments.show', $p->id) }}"
                            class="px-3 py-1 bg-blue-500 rounded text-white">Detail</a>

                        <a href="{{ route('customer.payments.edit', $p->id) }}"
                            class="px-3 py-1 bg-yellow-500 rounded text-white">Edit</a>

                        <form action="{{ route('customer.payments.destroy', $p->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
