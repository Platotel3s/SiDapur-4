<!DOCTYPE html>
<html lang="id" class="h-full">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'SiDapur')</title>
        <link rel="icon" type="image/png" href="{{ asset('images/king.png') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite('resources/css/app.css')
    </head>

    <body class="h-full bg-linear-to-br from-black to-red-500 bg-fixed">
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobileMenuButton" class="p-2 bg-black text-white rounded-lg shadow-lg">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        <div id="mobileMenuOverlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

        <div class="flex flex-col min-h-screen">
            <div class="flex flex-1">
                <div class="hidden lg:flex lg:flex-col lg:w-64">
                    @include('layouts.navigation')
                </div>
                <div id="mobileNavigation"
                    class="lg:hidden fixed left-0 top-0 h-full w-64 transform -translate-x-full transition-transform duration-300 z-50">
                    @include('layouts.navigation')
                </div>
                <div class="flex-1 w-full lg:w-auto min-h-screen">
                    <main class="p-4 lg:p-6">
                        @yield('content')
                    </main>
                </div>
            </div>

        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileNavigation = document.getElementById('mobileNavigation');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const body = document.body;

            function toggleMobileMenu() {
                const isOpen = mobileNavigation.classList.contains('translate-x-0');

                if (isOpen) {
                    mobileNavigation.classList.remove('translate-x-0');
                    mobileNavigation.classList.add('-translate-x-full');
                    mobileMenuOverlay.classList.add('hidden');
                    body.classList.remove('overflow-hidden');
                } else {
                    mobileNavigation.classList.remove('-translate-x-full');
                    mobileNavigation.classList.add('translate-x-0');
                    mobileMenuOverlay.classList.remove('hidden');
                    body.classList.add('overflow-hidden');
                }
            }
            mobileMenuButton.addEventListener('click', toggleMobileMenu);
            mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
            const navLinks = document.querySelectorAll('#mobileNavigation a');
            navLinks.forEach(link => {
                link.addEventListener('click', toggleMobileMenu);
            });
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    mobileNavigation.classList.remove('translate-x-0');
                    mobileNavigation.classList.add('-translate-x-full');
                    mobileMenuOverlay.classList.add('hidden');
                    body.classList.remove('overflow-hidden');
                }
            });
        });
        </script>
    </body>

</html>
