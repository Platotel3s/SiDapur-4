<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password | SiDapur</title>
    <link rel="icon" type="image/png" href="{{ asset('images/king.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-linear-to-br from-black to-red-500 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white/10 rounded-2xl border border-yellow-500 shadow-xl overflow-hidden">
            <div class="p-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Lupa Password?</h1>
                <p class="text-blue-100">Masukkan nomor HP untuk mendapatkan kode reset</p>
            </div>
            <form action="{{ route('forgot.send') }}" method="POST" class="p-8">
                @csrf

                <div class="mb-6">
                    <label class="block text-black text-sm font-medium mb-2">
                        <i class="fas fa-mobile-alt mr-2 text-black"></i>
                        Nomor HP
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-black">+62</span>
                        </div>
                        <input
                            type="text"
                            name="phone"
                            placeholder="81234567890"
                            required
                            class="w-full pl-14 pr-4 py-3 border border-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition duration-200"
                        >
                    </div>
                    <p class="text-black font-semibold text-xm mt-2">Kami akan mengirimkan kode reset ke nomor ini</p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-black hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center"
                >
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Kode Reset
                </button>

                <div class="mt-6 text-center">
                    <a href="{{ route('login.page') }}" class="text-black hover:text-yellow-500 text-sm font-medium inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke halaman login
                    </a>
                </div>
            </form>
            <div class="bg-transparent px-8 py-4">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/king.png') }}" alt="King Logo" class="h-6 w-6 mr-2">
                    <span class="text-black text-sm">SiDapur &copy; 2025</span>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="mt-4 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span class="text-green-700">{{ session('status') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mt-4 p-4 rounded-lg bg-red-50 border border-red-200">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <span class="text-red-700 font-medium">Terjadi kesalahan</span>
            </div>
            <ul class="mt-2 text-red-600 text-sm">
                @foreach($errors->all() as $error)
                <li class="ml-6">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
</html>
