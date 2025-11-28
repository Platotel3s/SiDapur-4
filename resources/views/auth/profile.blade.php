@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')

<div class="max-w-2xl mx-auto text-white">
    <h2 class="text-2xl font-semibold mb-6">Profil Akun</h2>
    <div class="bg-black/40 p-5 rounded-xl shadow-xl mb-8 border border-white/10">
        <h3 class="text-xl font-semibold mb-4">Informasi Pengguna</h3>

        <div class="flex items-center gap-4 mb-4">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=222&color=fff"
                class="w-16 h-16 rounded-full border border-white/20">
            <div>
                <p class="font-medium text-lg">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-300">{{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-300">+62 {{ Auth::user()->phone }}</p>
            </div>
        </div>
    </div>
    <div class="bg-black/40 p-5 rounded-xl shadow-xl mb-8 border border-white/10">
        <h3 class="text-xl font-semibold mb-4">Ganti Password</h3>

        @if (session('success'))
        <div class="p-3 rounded bg-green-600 mb-3">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="p-3 rounded bg-red-600 mb-3">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full px-3 py-2 rounded bg-black/60 border border-white/20 focus:border-red-500 outline-none">
            </div>

            <div>
                <label class="block mb-1">Password Baru</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 rounded bg-black/60 border border-white/20 focus:border-red-500 outline-none">
            </div>

            <div>
                <label class="block mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-3 py-2 rounded bg-black/60 border border-white/20 focus:border-red-500 outline-none">
            </div>

            <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded font-semibold transition">
                Simpan Password Baru
            </button>
        </form>
    </div>
    <div class="bg-black/40 p-5 rounded-xl shadow-xl border border-white/10">
        <h3 class="text-xl font-semibold mb-4">Two-Factor Authentication</h3>

        <p class="text-gray-300 text-sm mb-4">
            Two-Factor Authentication menambah keamanan akun dengan kode verifikasi tambahan.
        </p>

        <div class="flex items-center justify-between">
            <p class="text-lg font-medium">Status</p>

            <span class="px-3 py-1 bg-yellow-500 text-black rounded text-sm">
                Belum Aktif
            </span>
        </div>

        <button class="w-full mt-4 bg-blue-600 hover:bg-blue-700 py-2 rounded font-semibold transition">
            Aktifkan 2FA
        </button>
    </div>
    <div class="bg-black/40 p-5 rounded-xl shadow-xl border border-white/10 mt-6">
        <a href="{{ route('alamat.index') }}"
            class="items-center px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 group w-full flex flex-row justify-center">
            <i class="fas fa-home w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span class="text-xl">Daftar Alamat</span>
        </a>
    </div>
</div>

@endsection
