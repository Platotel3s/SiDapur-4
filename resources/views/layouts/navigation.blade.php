<nav>
    <div class="container mx-auto px-6 py-3 flex-col flex justify-around">
        <a href="/" class="text-2xl font-bold text-blue-600 hover:text-blue-700">
            SiDapur
        </a>
        <div class="flex flex-col items-center space-x-4">
            @auth
            @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                <i class="fas fa-gauge mr-2"></i>Dashboard
            </a>
            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">
                Kelola User
            </a>

            @elseif (Auth::user()->role === 'customer')
            <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                <i class="fas fa-gauge mr-2"></i>Dashboard
            </a>
            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">
                <i class="fas fa-basket-shopping mr-2"></i>Pesanan Saya
            </a>
            @endif
            @else
            <a href="{{ route('login.page') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                Login
            </a>
            <a href="{{ route('regis.page') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                Register
            </a>
            @endauth
        </div>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:underline font-medium">
                <i class="fas fa-sign-out"></i>Logout
            </button>
        </form>
    </div>
</nav>
