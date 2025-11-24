@extends('layouts.app')
@section('title','Daftar Produk')
@section('content')
     <div class="max-w-7 mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-400 dark:border-gray-800">
                <h6 class="text-2xl font-semibold text-red-500">List Produk</h6>
        </div>
        <div class="p-6">
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($products as $produk)
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6 flex flex-col">
                    @if ($produk->foto_barang)
                        <img src="{{ asset('storage/'.$produk->foto_barang) }}" alt="foto produk" 
                        class="mb-3 rounded-lg object-cover w-full">
                    @endif
                        <p class="text-sm text-gray-500 mb-1">{{$produk->nama_barang}}</p>
                        <p class="text-sm text-gray-500 mb-1">{{$produk->harga_barang}}</p>
                        <p class="text-sm text-gray-500 mb-1">{{$produk->deskripsi_barang}}</p>                     
                    </div>
                @endforeach
            </div>
        </div>
        </div>
     </div>
@endsection

