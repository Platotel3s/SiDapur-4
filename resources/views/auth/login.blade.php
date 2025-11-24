<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Masuk Akun</h2>

        @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="login" class="block text-gray-700 font-medium">Email / Nomor Telepon</label>
                <input type="text" name="login" id="login"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('email') }}" required placeholder="user@gmail.com">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="********"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
                <button type="button" id="togglePassword" class="p-2 shadow-sm shadow-gray-800 rounded-lg mt-3">
                    Show Password
                </button>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                Masuk
            </button>

            <p class="text-center text-gray-600 mt-3">
                Belum punya akun?
                <a href="{{ route('regis.page') }}" class="text-blue-600 hover:underline">Daftar</a>
            </p>
        </form>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
