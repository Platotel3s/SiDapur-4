@extends('layouts.app')

@section('title', 'Customer Panel')

@section('content')
<div class="flex flex-col gap-6">
    
    <div class="bg-white rounded-xl shadow p-6">
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($products as $produk)
            <div
                class="bg-blue-200 dark:bg-white border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6 flex flex-col">
                @if ($produk->foto_barang)
                <img src="{{ asset('storage/'.$produk->foto_barang) }}" alt="gambar produk"
                    class="mb-3 rounded-lg object-cover w-full">
                @endif
                <p class="text-sm text-gray-600 mb-1">
                    {{$produk->nama_barang}}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
