@extends('layouts.app')
@section('title','List Payment')
@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Daftar Pembayaran</h2>

    @if($payments->isEmpty())
    <p class="text-gray-600">Belum ada pembayaran.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Order</th>
                    <th class="p-3 border">Provider</th>
                    <th class="p-3 border">Jumlah</th>
                    <th class="p-3 border">Dibayar pada</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $p)
                <tr>
                    <td class="p-3 border">{{ $p->order->order_number }}</td>
                    <td class="p-3 border">{{ $p->provider }}</td>
                    <td class="p-3 border">Rp {{ number_format($p->amount,0,',','.') }}</td>
                    <td class="p-3 border">{{ $p->paid_at }}</td>
                    <td class="p-3 border">
                        <a href="{{ asset('storage/' . $p->payment_proof) }}" class="text-blue-600" target="_blank">
                            Lihat Bukti
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
