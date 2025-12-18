<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Akun</title>
        @vite('resources/css/app.css')
    </head>

    <body class="bg-linear-to-br from-black to-red-600 flex justify-center items-center min-h-screen p-4">

        <div
            class="w-full max-w-md bg-white/10 backdrop-blur-sm border border-amber-600/50 rounded-2xl shadow-xl p-6 md:p-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-white">Daftar Akun Baru</h2>

            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-white font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" placeholder="Contoh: John Doe"
                        class="w-full bg-white/5 border border-gray-300/30 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition text-white placeholder-gray-300"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-red-300 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-white font-medium mb-1">
                        Nomor Handphone
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-300 text-sm">+62</span>
                        </div>

                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="13"
                            placeholder="81234567890"
                            class="w-full pl-14 bg-white/5 border border-gray-300/30 rounded-lg p-3
                            focus:ring-2 focus:ring-amber-500 focus:border-amber-500
                            focus:outline-none transition text-white placeholder-gray-400"
                            value="{{ old('phone') }}"
                            required
                        >
                    </div>

                    <p class="text-gray-300 text-xs mt-1">
                        Masukkan nomor tanpa <strong>0</strong> atau <strong>+62</strong><br>
                        Contoh: <strong>81234567890</strong>
                    </p>

                    @error('phone')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-white font-medium mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                            class="w-full bg-white/5 border border-gray-300/30 rounded-lg p-3 pr-10 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition text-white placeholder-gray-300"
                            required>
                        <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-900 hover:text-black">
                            <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <span class="text-red-300 text-sm mt-1">{{ $message }}</span>
                    @enderror
                    <p class="text-gray-300 text-xs mt-1">Gunakan kombinasi huruf, angka, dan simbol untuk keamanan</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-white font-medium mb-1">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full bg-white/5 border border-gray-300/30 rounded-lg p-3 pr-10 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition text-white placeholder-gray-300"
                            required placeholder="Ketik ulang password Anda">
                        <button type="button" onclick="togglePassword('password_confirmation', 'togglePasswordConfirmIcon')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-900 hover:text-black">
                            <svg id="togglePasswordConfirmIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                    <span class="text-red-300 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                @error('terms')
                <span class="text-red-300 text-sm block mt-1">{{ $message }}</span>
                @enderror
                <button type="submit"
                    class="w-full bg-linear-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl mt-6">
                    Daftar Sekarang
                </button>
                <p class="text-center text-gray-100 text-sm pt-4">
                    Sudah punya akun?
                    <a href="{{ route('login.page') }}"
                        class="text-amber-300 hover:text-amber-200 hover:underline font-medium transition">
                        Masuk di sini
                    </a>
                </p>
            </form>
        </div>
        <script src="{{ asset('js/register.js') }}"></script>
    </body>

</html>
