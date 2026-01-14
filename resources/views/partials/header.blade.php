<nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary tracking-tight cursor-pointer hover:opacity-80 transition-opacity font-serif flex items-center gap-2">
                    <i class="ri-restaurant-2-line text-yellow-600"></i>
                    Rasa Nusantara
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Beranda</a>
                <a href="{{ route('home') }}#jelajahi" class="text-gray-700 hover:text-primary transition-colors font-medium">Resep</a>
                <a href="{{ route('home', ['category' => 'review-makanan']) }}#jelajahi" class="text-gray-700 hover:text-primary transition-colors font-medium">Review</a>
                <a href="#footer" class="text-gray-700 hover:text-primary transition-colors font-medium">Kontak</a>

                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="bg-yellow-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-yellow-700 transition-colors flex items-center gap-2 shadow-sm">
                            <i class="ri-dashboard-line"></i> Dashboard
                        </a>
                    @else
                        <div class="flex items-center gap-3">
                            <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm border border-red-200 px-3 py-1 rounded-full">Keluar</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary font-medium px-4 py-2 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2.5 rounded-full font-medium hover:bg-primary/90 transition-colors flex items-center gap-2 shadow-sm">Daftar</a>
                    </div>
                @endauth
            </div>

            <div class="flex items-center md:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none p-2">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>