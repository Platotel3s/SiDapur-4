<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password | SiDapur</title>
        <link rel="icon" type="image/png" href="{{ asset('images/king.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-linear-to-br from-black to-red-500 min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="bg-white/10 border border-yellow-500 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                        <i class="fas fa-lock text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-2">Reset Password</h1>
                    <p class="text-green-100">Buat password baru untuk akun Anda</p>
                    @if(isset($phone))
                    <div class="mt-3 inline-flex items-center bg-white/20 px-3 py-1 rounded-full">
                        <i class="fas fa-mobile-alt text-white text-sm mr-2"></i>
                        <span class="text-white text-sm">{{ $phone }}</span>
                    </div>
                    @endif
                </div>
                <form action="{{ route('reset.password') }}" method="POST" class="p-8">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-black text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-yellow-500"></i>
                            Password Baru
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-yellow-500"></i>
                            </div>
                            <input
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required
                                class="w-full pl-10 pr-10 py-3 border border-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition duration-200"
                                id="password"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password')" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 space-y-1">
                            <div class="flex items-center">
                                <i class="fas fa-check text-xs text-black mr-2"></i>
                                <span class="text-black text-xs">Minimal 8 karakter</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-xs text-black mr-2"></i>
                                <span class="text-black text-xs">Huruf besar dan kecil</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-black text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-yellow-500"></i>
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-yellow-500"></i>
                            </div>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password baru"
                                required
                                class="w-full pl-10 pr-10 py-3 border border-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition duration-200"
                                id="confirmPassword"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('confirmPassword')" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-black hover:bg-yellow-500 text-white font-medium py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center"
                    >
                        <i class="fas fa-redo mr-2"></i>
                        Reset Password
                    </button>
                </form>
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/king.png') }}" alt="King Logo" class="h-6 w-6 mr-2">
                        <span class="text-gray-600 text-sm">SiDapur &copy; 2023</span>
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

        <script src="{{ asset('js/reset.js') }}"></script>
    </body>
</html>
