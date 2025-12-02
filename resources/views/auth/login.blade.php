<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-black to-red-600 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white/10 border border-amber-600 rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-100">Masuk Akun</h2>

        @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="login" class="block text-gray-100 font-medium mb-1">Email / Nomor Telepon</label>
                <input type="text" name="login" id="login"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition text-gray-100"
                    value="{{ old('login') }}" required placeholder="contoh@email.com atau 081234567890">
                @error('login')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-100 font-medium mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full border border-gray-300 rounded-lg p-3 pr-10 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition text-white"
                        required placeholder="Masukkan password">

                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-800 hover:text-gray-800">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg id="eyeSlashIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd" />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-yellow-600 rounded">
                <label for="remember" class="ml-2 text-gray-100">Ingat saya</label>
            </div>

            <button type="submit"
                class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                Masuk
            </button>

            <p class="text-center text-gray-100 mt-3">
                Belum punya akun?
                <a href="{{ route('regis.page') }}" class="text-black font-semibold hover:underline font-medium">Daftar
                    di sini</a>
            </p>
        </form>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
