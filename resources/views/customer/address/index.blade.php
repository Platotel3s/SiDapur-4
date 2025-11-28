@extends('layouts.app')
@section('title','Daftar alamat')
@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Daftar Alamat</h2>
        <a href="{{ route('alamat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Alamat
        </a>
    </div>

    @foreach ($addresses as $alamat)
    <div class="border rounded p-4 mb-3 {{ $alamat->alamatUtama ? 'border-blue-500' : 'border-gray-300' }}">
        <div class="flex justify-between items-center">
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
                <button class="text-blue-600 border px-3 py-1 rounded hover:bg-blue-50">
                    Jadikan Utama
                </button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endsection
