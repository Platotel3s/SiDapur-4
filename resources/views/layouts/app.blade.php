<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiDapur')</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gradient-to-br from-blue-600 to-purple-500 min-h-screen flex flex-col">
    <div class="flex flex-1">
        <div class="w-1/5 bg-white flex flex-1 justify-center">
            @include('layouts.navigation')
        </div>
        <div class="flex flex-5">
            @yield('content')
        </div>
    </div>
</body>

</html>
