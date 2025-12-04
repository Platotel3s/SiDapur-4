@extends('layouts.app')
@section('title','Daftar alamat')
@section('content')
<div class="max-w-3xl mx-auto bg-white/10 border border-yellow-500 p-6 shadow rounded">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-100">Daftar Alamat</h2>
        <a href="{{ route('alamat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Alamat
        </a>
    </div>

    @foreach ($addresses as $alamat)
    <div class="border rounded p-4 mb-3 {{ $alamat->alamatUtama ? 'border-blue-500' : 'border-gray-300' }}">
        <div class="flex justify-between items-center bg-yellow-500 p-4 rounded-2xl">
            <div>
                <p class="font-bold">{{ $alamat->label }}
                    @if($alamat->alamatUtama)
                    <span class="text-sm bg-blue-600 text-white px-2 py-1 rounded ml-2">Utama</span>
                    @endif
                </p>
                <p>{{ $alamat->namaPenerima }} ({{ $alamat->nomorPenerima }})</p>
                <p>{{ $alamat->alamat }}, {{ $alamat->kota }}, {{ $alamat->provinsi }}</p>
                <p>Kode Pos: {{ $alamat->kodePos }}</p>
            </div>

            @if(!$alamat->alamatUtama)
            <form action="{{ route('alamat.setUtama', $alamat->id) }}" method="POST">
                @csrf
                <button class="text-black border px-3 py-1 rounded hover:bg-red-500">
                    Jadikan Utama
                </button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endsection
