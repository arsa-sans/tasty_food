@php
    $isHome = request()->routeIs('home');
    $textColor = $isHome ? 'text-black' : 'text-white';
    $hoverColor = 'hover:text-amber-500';
@endphp

<!-- Navigation -->
<nav class="absolute top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="{{ $textColor }} font-extrabold text-2xl tracking-wider uppercase transition-colors px-10">
                TASTY FOOD
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors">HOME</a>
                <a href="{{ route('tentang') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors">TENTANG</a>
                <a href="{{ route('berita') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors">BERITA</a>
                <a href="{{ route('galeri') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors">GALERI</a>
                <a href="{{ route('kontak') }}" class="{{ $textColor }} text-xs lg:text-sm font-semibold tracking-wider uppercase {{ $hoverColor }} transition-colors">KONTAK</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden {{ $textColor }} p-2 focus:outline-none" aria-label="Toggle Menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-neutral-950/95 backdrop-blur-md border-b border-neutral-800">
        <div class="px-6 py-6 space-y-4">
            <a href="{{ route('home') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('home') ? 'text-amber-500 font-bold' : '' }}">HOME</a>
            <a href="{{ route('tentang') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('tentang') ? 'text-amber-500 font-bold' : '' }}">TENTANG</a>
            <a href="{{ route('berita') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('berita') ? 'text-amber-500 font-bold' : '' }}">BERITA</a>
            <a href="{{ route('galeri') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('galeri') ? 'text-amber-500 font-bold' : '' }}">GALERI</a>
            <a href="{{ route('kontak') }}" class="block text-white text-base font-semibold tracking-wider uppercase hover:text-amber-500 transition-colors {{ request()->routeIs('kontak') ? 'text-amber-500 font-bold' : '' }}">KONTAK</a>
        </div>
    </div>
</nav>

<script>
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
</script>
