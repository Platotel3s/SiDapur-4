@extends('layouts.app')
@section('title','Tambah Kategori')
@section('content')
<form action="{{ route('store.kategori') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
    @csrf
    <div class="mb-4">
        <label class="block font-medium">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-medium">Deskripsi Kategori</label>
        <textarea name="deskripsi" class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection
