@extends('layouts.app')
@section('title', 'List Kategori')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Kategori</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase border-b">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase border-b">Deskripsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($categories as $kategori)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 text-gray-800">{{ $kategori->nama_kategori }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $kategori->deskripsi }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-4 text-center text-gray-500 italic">
                        Belum ada kategori yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('create.kategori') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Kategori
        </a>
    </div>
</div>
@endsection
