@extends('layouts.app')
@section('title','Daftar Pengguna')
@section('content')
<div class="container mx-auto px-4 sm:px-6 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-100 mb-2">Daftar Pengguna SiDapur</h1>
        <p class="text-gray-100 text-sm">Kelola data pengguna dengan mudah</p>
        @if (session('success'))
        <div class="mt-4 bg-green-700 rounded-md shadow-md text-white p-3 text-center">
            {{session('success')}}
        </div>
        @endif
    </div>
    <div class="md:hidden space-y-4">
        @foreach ($customer as $index => $user)
        <div class="bg-white/20 rounded-xl shadow-lg border border-gray-100 p-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 bg-gray-100/20 rounded-full text-sm font-medium">
                            {{$index + 1}}
                        </span>
                        <h3 class="text-lg font-semibold text-gray-100">{{$user->name}}</h3>
                    </div>
                </div>
            </div>

            <div class="space-y-2 mb-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-phone text-gray-300 text-sm"></i>
                    <span class="text-gray-100 text-sm">{{$user->phone}}</span>
                </div>
            </div>

            <div class="flex gap-2">
                <form action="{{route('hapus.customer',$user->id)}}" method="post" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition duration-200 font-medium text-sm">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class="hidden md:block bg-white/20 rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50/20 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Nama</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">No. Handphone</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-100">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white/20 divide-y divide-gray-200">
                    @foreach ($customer as $index => $user)
                    <tr class="hover:bg-gray-50/10 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{$index + 1}}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{$user->name}}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-100">
                                {{$user->phone}}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2">
                                <form action="{{ route('hapus.customer',$user->id) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition duration-200 font-medium text-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($customer->hasPages())
    <div class="mt-6">
        {{ $customer->links() }}
    </div>
    @endif
</div>
@endsection
