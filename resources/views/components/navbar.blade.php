<!-- Navigation -->
<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-white font-bold text-xl tracking-wider">TASTY FOOD</a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="text-white text-sm font-medium px-3 py-2 hover:text-yellow-400 transition {{ request()->routeIs('home') ? 'border-b-2 border-yellow-400' : '' }}">HOME</a>
                <a href="{{ route('tentang') }}" class="text-white text-sm font-medium px-3 py-2 hover:text-yellow-400 transition {{ request()->routeIs('tentang') ? 'border-b-2 border-yellow-400' : '' }}">TENTANG</a>
                <a href="{{ route('berita') }}" class="text-white text-sm font-medium px-3 py-2 hover:text-yellow-400 transition {{ request()->routeIs('berita') ? 'border-b-2 border-yellow-400' : '' }}">BERITA</a>
                <a href="{{ route('galeri') }}" class="text-white text-sm font-medium px-3 py-2 hover:text-yellow-400 transition {{ request()->routeIs('galeri') ? 'border-b-2 border-yellow-400' : '' }}">GALERI</a>
                <a href="{{ route('kontak') }}" class="text-white text-sm font-medium px-3 py-2 hover:text-yellow-400 transition {{ request()->routeIs('kontak') ? 'border-b-2 border-yellow-400' : '' }}">KONTAK</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-black/95 backdrop-blur-sm">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block text-white text-sm font-medium py-2 px-3 hover:bg-white/10 rounded {{ request()->routeIs('home') ? 'text-yellow-400' : '' }}">HOME</a>
            <a href="{{ route('tentang') }}" class="block text-white text-sm font-medium py-2 px-3 hover:bg-white/10 rounded {{ request()->routeIs('tentang') ? 'text-yellow-400' : '' }}">TENTANG</a>
            <a href="{{ route('berita') }}" class="block text-white text-sm font-medium py-2 px-3 hover:bg-white/10 rounded {{ request()->routeIs('berita') ? 'text-yellow-400' : '' }}">BERITA</a>
            <a href="{{ route('galeri') }}" class="block text-white text-sm font-medium py-2 px-3 hover:bg-white/10 rounded {{ request()->routeIs('galeri') ? 'text-yellow-400' : '' }}">GALERI</a>
            <a href="{{ route('kontak') }}" class="block text-white text-sm font-medium py-2 px-3 hover:bg-white/10 rounded {{ request()->routeIs('kontak') ? 'text-yellow-400' : '' }}">KONTAK</a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        menu.classList.toggle('hidden');
        if (menu.classList.contains('hidden')) {
            icon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
        } else {
            icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    });
</script>
