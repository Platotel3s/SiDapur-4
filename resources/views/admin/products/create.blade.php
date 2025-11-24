@extends('layouts.app')
@section('title','Tambah Produk')
@section('content')
<form action="{{ route('store.produk') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
    @csrf
    <div class="mb-4">
        <label class="block font-medium">Kategori</label>
        <select name="kategori_id" class="w-full border rounded px-3 py-2">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-medium">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-medium">Foto Barang</label>
        <input type="file" name="foto_barang" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-medium">Harga Barang</label>
        <input type="number" step="0.01" name="harga_barang" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-medium">Deskripsi Barang</label>
        <textarea name="deskripsi_barang" class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>

@endsection
