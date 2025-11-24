<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Daftar Akun</h2>

        @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Awali dengan huruf kapital"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" placeholder="user@gmail.com"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="minimal 8 karakter"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ulangi password Anda">
            </div>
            <div>
                    <label for="phone" class="block text-gray-700 font-medium">Nomor Handphone</label>
                    <input type="text" name="phone" id="phone" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="nomor telepon">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                Daftar
            </button>

            <p class="text-center text-gray-600 mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a>
            </p>
        </form>
    </div>

</body>

</html>
