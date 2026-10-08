@php
    $isHome = request()->routeIs('home');
    $textColor = $isHome ? 'text-black' : 'text-white';
    $hoverColor = 'hover:text-amber-500';
    $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
@endphp

<!-- Navigation -->
<nav class="fixed top-0 left-0 z-50 w-full bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="{{ $textColor }} font-extrabold text-2xl tracking-wider uppercase transition-colors px-2 sm:px-4">
                TASTY FOOD
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6 lg:space-x-7">
                <a href="{{ route('home') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('home') ? 'text-amber-500 font-bold' : '' }}">HOME</a>
                <a href="{{ route('tentang') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('tentang') ? 'text-amber-500 font-bold' : '' }}">TENTANG</a>
                {{-- <a href="{{ route('order.history') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('order.history') ? 'text-amber-500 font-bold' : '' }}">RIWAYAT</a> --}}
                <a href="{{ route('berita') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('berita') || request()->routeIs('makanan.detail') ? 'text-amber-500 font-bold' : '' }}">BERITA</a>
                <a href="{{ route('galeri') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('galeri') ? 'text-amber-500 font-bold' : '' }}">GALERI</a>
                <a href="{{ route('menu') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('menu') ? 'text-amber-500 font-bold' : '' }}">MENU</a>
                <a href="{{ route('kontak') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors {{ request()->routeIs('kontak') ? 'text-amber-500 font-bold' : '' }}">KONTAK</a>

                <!-- Cart Icon Button -->
                {{-- <a href="{{ route('cart.index') }}" class="relative inline-flex items-center {{ $textColor }} {{ $hoverColor }} transition-colors p-1.5" title="Keranjang Belanja">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-amber-500 text-black text-[10px] font-extrabold rounded-full h-4 w-4 flex items-center justify-center shadow-xs">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a> --}}

                <!-- User Auth Area (Desktop) -->
                @auth
                    <!-- Logged in: Profile Dropdown -->
                    <div class="relative ml-1" id="user-menu-container">
                        <button type="button" id="user-menu-btn" class="flex items-center space-x-2 text-xs font-bold uppercase tracking-wider {{ $textColor }} transition py-1.5 px-3 rounded-full border {{ $isHome ? 'border-black/20 hover:border-black bg-black/5' : 'border-white/30 hover:border-white bg-white/10' }}">
                            <span class="w-5 h-5 rounded-full bg-amber-500 text-black flex items-center justify-center text-[10px] font-black uppercase shadow-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-[110px] truncate">{{ Str::limit(Auth::user()->name, 12) }}</span>
                            <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Content -->
                        <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1.5 text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full {{ Auth::user()->role === 'admin' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                                </span>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('order.history') }}" class="flex items-center space-x-2.5 px-4 py-2 text-xs text-gray-700 hover:bg-amber-50 hover:text-amber-800 transition">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span class="font-semibold">Riwayat Pesanan Saya</span>
                                </a>
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5 px-4 py-2 text-xs text-gray-700 hover:bg-rose-50 hover:text-rose-800 transition">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-semibold">Panel Administrator</span>
                                </a>
                                @endif
                            </div>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST" class="px-2">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-2 px-3 py-2 text-xs text-rose-600 hover:bg-rose-50 rounded-xl transition font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest: Login & Register Links -->
                    <div class="flex items-center space-x-3 ml-2">
                        <a href="{{ route('login') }}" class="{{ $textColor }} text-xs font-bold tracking-wider uppercase {{ $hoverColor }} transition-colors">
                            MASUK
                        </a>
                        <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-black text-xs font-extrabold tracking-wider uppercase px-4 py-2 rounded-full transition shadow-xs">
                            DAFTAR
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu & Cart Button -->
            <div class="flex items-center space-x-2 md:hidden">
                <a href="{{ route('cart.index') }}" class="relative {{ $textColor }} p-2" title="Keranjang">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-amber-500 text-black text-[10px] font-extrabold rounded-full h-4 w-4 flex items-center justify-center shadow">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <button id="mobile-menu-btn" class="{{ $textColor }} p-2 focus:outline-none" aria-label="Toggle Menu">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-neutral-950/95 backdrop-blur-md border-b border-neutral-800">
        <div class="px-6 py-6 space-y-4">
            <a href="{{ route('home') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('home') ? 'text-amber-500 font-bold' : '' }}">HOME</a>
            <a href="{{ route('tentang') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('tentang') ? 'text-amber-500 font-bold' : '' }}">TENTANG</a>
            <a href="{{ route('menu') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('menu') ? 'text-amber-500 font-bold' : '' }}">MENU PESANAN</a>
            <a href="{{ route('order.history') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('order.history') ? 'text-amber-500 font-bold' : '' }}">RIWAYAT PESANAN</a>
            <a href="{{ route('cart.index') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('cart.index') ? 'text-amber-500 font-bold' : '' }}">
                KERANJANG ({{ $cartCount }})
            </a>
            <a href="{{ route('berita') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('berita') ? 'text-amber-500 font-bold' : '' }}">BERITA</a>
            <a href="{{ route('galeri') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('galeri') ? 'text-amber-500 font-bold' : '' }}">GALERI</a>
            <a href="{{ route('kontak') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('kontak') ? 'text-amber-500 font-bold' : '' }}">KONTAK</a>

            <!-- Mobile Auth Area -->
            <div class="pt-4 border-t border-neutral-800 space-y-3">
                @auth
                    <div class="flex items-center space-x-3 bg-neutral-900 p-3 rounded-xl border border-neutral-800">
                        <span class="w-8 h-8 rounded-full bg-amber-500 text-black flex items-center justify-center text-xs font-black uppercase">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-white text-xs font-bold truncate">{{ Auth::user()->name }}</p>
                            <p class="text-neutral-400 text-[10px] truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl transition">
                        Panel Administrator
                    </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center bg-rose-600/20 hover:bg-rose-600/30 text-rose-400 font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl border border-rose-500/30 transition">
                            Keluar (Logout)
                        </button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="text-center bg-neutral-800 hover:bg-neutral-700 text-white font-bold text-xs uppercase tracking-wider py-2.5 rounded-xl transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-center bg-amber-500 hover:bg-amber-600 text-black font-extrabold text-xs uppercase tracking-wider py-2.5 rounded-xl transition shadow">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    if (menuBtn && mobileMenu && menuIcon) {
        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    }

    // Desktop user dropdown toggle
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');

    if (userMenuBtn && userDropdownMenu) {
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!userDropdownMenu.contains(e.target) && !userMenuBtn.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }
</script>
