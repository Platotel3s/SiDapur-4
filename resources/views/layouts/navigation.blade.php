<nav class="flex flex-col bg-black text-white w-full h-full p-4 lg:p-6 overflow-y-auto">
    <div class="lg:hidden flex justify-between items-center mb-6 pb-4 border-b border-slate-700">
        <h2 class="text-xl font-bold">Menu</h2>
        <button id="closeMobileMenu" class="p-2 text-white hover:bg-slate-700 rounded-lg transition">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <div class="mb-6 lg:mb-8 flex justify-center">
        @auth
        <a href="{{Auth::user()->role==='admin'?route('admin.dashboard') : route('customer.dashboard')}}"
            class="block hover:scale-105 transition-transform duration-300">
            <img src="{{ Auth::user()->image ?? asset('images/king.png') }}" alt="logo"
                class="h-20 w-20 lg:h-24 lg:w-24 rounded-full border-4 border-slate-600 object-cover shadow-lg">
        </a>
        @else
        <a href="{{ url('/') }}" class="block hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('images/king.png') ?? 'https://i.pinimg.com/1200x/8c/6c/db/8c6cdbd18862893b595c2f93f2731efd.jpg' }}"
                alt="logo"
                class="h-20 w-20 lg:h-24 lg:w-24 rounded-full border-4 border-slate-600 object-cover shadow-lg">
        </a>
        @endauth
    </div>
    @auth
    <div class="text-center mb-6 lg:mb-8 px-2">
        <p class="font-semibold text-lg truncate">{{Auth::user()->name}}</p>
        <p class="text-sm text-slate-300 capitalize mt-1 px-3 py-1 bg-slate-800 rounded-full inline-block">
            {{Auth::user()->role}}
        </p>
    </div>
    @endauth
    <div class="space-y-1 lg:space-y-2 flex-1">
        @auth
        @if (Auth::user()->role==='admin')
        <a href="{{ route('index.user') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group">
            <i class="fas fa-chart-area w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Data Pengguna</span>
        </a>
        <a href="{{ route('index.categories')}}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group {{request()->routeIs('index.categories') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}">
            <i class="fas fa-list w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Daftar Kategori</span>
        </a>
        <a href="{{ route('custom.bumbu')}}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group {{request()->routeIs('custom.bumbu') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}">
            <i class="fas fa-gear w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Konfirmasi custom Bumbu</span>
        </a>
        <a href="{{ route('index.products')}}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group {{request()->routeIs('index.products') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}">
            <i class="fas fa-box w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Daftar Produk</span>
        </a>
        <a href="{{ route('admin.orders.index')}}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group {{request()->routeIs('admin.orders.index') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}">
            <i class="fas fa-box w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Daftar Orderan</span>
        </a>
        @elseif(Auth::user()->role==='customer')
        <a href="{{route('customer.dashboard')}}"
            class="relative flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition {{request()->routeIs('customer.dashboard') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}"">
            <i class=" fas fa-box-open w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Produk</span>
        </a>
        <a href="{{ route('cart.index') }}"
            class="relative flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition {{request()->routeIs('cart.index') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}"">
            <i class=" fas fa-basket-shopping w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Keranjang</span>

            @if(isset($cartCount) && $cartCount > 0)
            <span class="absolute -top-1 left-6 bg-red-600 text-white text-xs font-bold rounded-full px-2 py-0.5">
                {{ $cartCount }}
            </span>
            @endif
        </a>

        <a href="{{route('customer.orders')}}"
            class="relative flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition {{request()->routeIs('customer.orders') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}"">
            <i class=" fas fa-grip-vertical w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Pesanan</span>
        </a>
        <a href="{{route('alamat.index')}}"
            class="relative flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition {{request()->routeIs('alamat.index') ? 'bg-slate-700 border-l-4 border-blue-500' : ''}}"">
            <i class=" fas fa-home w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Alamat</span>
        </a>
        @endif
        @endauth
    </div>
    <div class="border-t border-slate-700 pt-4 lg:pt-6 mt-6 lg:mt-8 space-y-1 lg:space-y-2">
        <a href="{{ route('profile') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition duration-200 group">
            <i class="fas fa-user w-6 text-center mr-3 text-slate-400 group-hover:text-white"></i>
            <span>Profile</span>
        </a>
        @auth
        <form action="{{route('logout')}}" method="post" class="pt-2">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition duration-200 shadow-lg group">
                <i class="fas fa-sign-out-alt mr-2 group-hover:scale-110 transition-transform"></i>
                <span>Keluar</span>
            </button>
        </form>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', function () {
                const mobileNavigation = document.getElementById('mobileNavigation');
                const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
                const body = document.body;

                mobileNavigation.classList.remove('translate-x-0');
                mobileNavigation.classList.add('-translate-x-full');
                mobileMenuOverlay.classList.add('hidden');
                body.classList.remove('overflow-hidden');
            });
        }
    });
</script>
