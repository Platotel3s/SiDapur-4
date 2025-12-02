<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di SiDapur</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-black to-red-600 min-h-screen flex flex-col">
    <nav class="bg-white/10 shadow-md py-4 px-6 flex justify-between items-center">
        <div class="text-2xl font-bold text-amber-400">
            SiDapur 🍳
        </div>

        <div class="space-x-4">
            <a href="{{ route('login.page') }}"
                class="px-4 py-2 text-amber-600 font-semibold border border-yellow-600 rounded-lg hover:bg-yellow-600 hover:text-black transition duration-200">
                Login
            </a>
            <a href="{{ route('regis.page') }}"
                class="px-4 py-2 bg-yellow-600 text-black font-semibold rounded-lg hover:bg-amber-700 transition duration-200">
                Register
            </a>
        </div>
    </nav>

    <main class="flex flex-col justify-center items-center flex-grow text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di <span class="text-yellow-300">SiDapur</span>
        </h1>
        <p class="text-lg md:text-xl max-w-2xl mb-8">
            Aplikasi manajemen dapur yang membantu Anda mengatur bahan makanan, resep, dan kebutuhan rumah tangga dengan
            mudah dan efisien.
        </p>
        <div class="space-x-4">
            <a href="{{ route('login.page') }}"
                class="px-6 py-3 bg-white text-black font-semibold rounded-xl shadow hover:shadow-lg transition duration-200">
                Mulai Sekarang
            </a>
            <a href="{{ route('regis.page') }}"
                class="px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:shadow-lg transition duration-200">
                Buat Akun
            </a>
        </div>
    </main>

    <footer class="bg-white/10 text-center py-4 text-gray-600 text-sm">
        <p class="text-white font-semibold">&copy; {{ date('Y') }} SiDapur - Semua Hak Dilindungi.</p>
    </footer>

</body>

</html>
