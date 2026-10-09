@php
    $isHome = request()->routeIs('home');
    $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
@endphp

<style>
    /* Reset & Base Fonts */
    .tf-nav-root {
        font-family: 'Poppins', sans-serif;
    }

    /* 1. Header Utama (Normal Top Header) */
    .tf-header-main {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 40;
        padding: 35px 24px 10px 24px;
        box-sizing: border-box;
    }

    .tf-header-container {
        width: 100%;
        max-width: 1300px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 40px;
        box-sizing: border-box;
    }

    /* Logo */
    .tf-logo {
        text-decoration: none;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        transition: transform 0.25s ease;
    }
    .tf-logo:hover {
        transform: scale(1.02);
    }
    .tf-logo-home {
        color: #000000;
    }
    .tf-logo-subpage {
        color: #FFFFFF;
    }
    .tf-logo-sticky {
        color: #000000;
    }
    .tf-logo .tf-dot {
        color: #F59E0B;
        margin-left: 2px;
        font-size: 28px;
        line-height: 1;
    }

    /* Nav Links Group (Desktop) */
    .tf-nav-links {
        display: flex;
        align-items: center;
        gap: 24px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .tf-nav-link {
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        padding: 6px 2px;
        position: relative;
        transition: transform 0.25s ease, color 0.25s ease;
        white-space: nowrap;
    }

    .tf-nav-link:hover {
        transform: translateY(-2px);
        color: #F59E0B !important;
    }

    /* Home Theme Nav Links */
    .tf-nav-link-home {
        color: #000000;
    }

    /* Subpage Theme Nav Links */
    .tf-nav-link-subpage {
        color: #FFFFFF;
    }

    /* Sticky Theme Nav Links */
    .tf-nav-link-sticky {
        color: #000000;
    }

    /* Active Link Indicator */
    .tf-nav-active {
        color: #F59E0B !important;
        font-weight: 700 !important;
    }

    .tf-nav-active::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 100%;
        height: 2.5px;
        background-color: #F59E0B;
        border-radius: 4px;
    }

    /* Right Actions (Cart & Auth) */
    .tf-header-actions {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* Cart Button */
    .tf-cart-btn {
        position: relative;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
        border-radius: 50%;
        transition: transform 0.2s ease, color 0.2s ease;
    }
    .tf-cart-btn:hover {
        transform: scale(1.08);
        color: #F59E0B !important;
    }
    .tf-cart-badge {
        position: absolute;
        top: -2px;
        right: -4px;
        background-color: #F59E0B;
        color: #000000;
        font-size: 10px;
        font-weight: 800;
        border-radius: 50px;
        padding: 1px 5px;
        line-height: 1.2;
    }

    /* Guest Auth Buttons */
    .tf-btn-login {
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 6px 10px;
        transition: color 0.2s ease;
    }
    .tf-btn-login:hover {
        color: #F59E0B !important;
    }

    .tf-btn-register {
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        background-color: #F59E0B;
        color: #000000 !important;
        padding: 8px 18px;
        border-radius: 50px;
        transition: all 0.25s ease;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
        display: inline-block;
        white-space: nowrap;
    }
    .tf-btn-register:hover {
        background-color: #D97706;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);
    }

    /* User Avatar Pill */
    .tf-user-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 4px 12px 4px 6px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.15);
        background: rgba(255,255,255,0.1);
        transition: all 0.2s ease;
    }
    .tf-user-pill-light {
        color: #000000;
        border-color: rgba(0,0,0,0.15);
        background: rgba(0,0,0,0.04);
    }
    .tf-user-pill-dark {
        color: #FFFFFF;
        border-color: rgba(255,255,255,0.25);
        background: rgba(255,255,255,0.1);
    }
    .tf-user-pill-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #F59E0B;
        color: #000000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
    }

    /* User Dropdown */
    .tf-dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 8px;
        width: 230px;
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        border: 1px solid #EEEEEE;
        padding: 8px 0;
        z-index: 1000;
        display: none;
    }
    .tf-dropdown-menu.show {
        display: block;
    }

    /* 2. Header Sticky (Slides down on scroll) */
    .tf-header-sticky {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        z-index: 9999;
        background-color: #FFFFFF;
        padding: 14px 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: top 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        box-sizing: border-box;
    }
    .tf-header-sticky.show {
        top: 0;
    }

    /* Mobile Hamburger Button */
    .tf-mobile-toggle {
        display: none;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 6px;
        align-items: center;
        justify-content: center;
    }

    /* Mobile Drawer */
    .tf-mobile-drawer {
        position: fixed;
        inset: 0;
        background: rgba(15, 15, 15, 0.98);
        backdrop-filter: blur(12px);
        z-index: 10000;
        display: none;
        flex-direction: column;
        padding: 24px;
        overflow-y: auto;
    }
    .tf-mobile-drawer.open {
        display: flex;
    }

    /* Responsive Breakpoint <= 1024px */
    @media (max-width: 1024px) {
        .tf-header-main {
            padding: 20px 16px 0 16px;
        }
        .tf-header-sticky {
            padding: 12px 16px;
        }
        .tf-header-container {
            justify-content: space-between;
            gap: 15px;
        }
        .tf-nav-links,
        .tf-header-actions .tf-btn-login,
        .tf-header-actions .tf-btn-register,
        .tf-header-actions .tf-user-pill-container {
            display: none !important;
        }
        .tf-mobile-toggle {
            display: flex !important;
        }
    }
</style>

<div class="tf-nav-root">

    <!-- ======================================================== -->
    <!-- 1. HEADER UTAMA (Normal Top Header)                      -->
    <!-- ======================================================== -->
    <header id="tfHeaderMain" class="tf-header-main">
        <div class="tf-header-container">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="tf-logo {{ $isHome ? 'tf-logo-home' : 'tf-logo-subpage' }}">
                <span>TASTY FOOD</span>
                
            </a>

            <!-- Nav Links (Desktop) -->
            <ul class="tf-nav-links">
                <li>
                    <a href="{{ route('home') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('home') ? 'tf-nav-active' : '' }}">
                        HOME
                    </a>
                </li>
                <li>
                    <a href="{{ route('tentang') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('tentang') ? 'tf-nav-active' : '' }}">
                        TENTANG
                    </a>
                </li>
                <li>
                    <a href="{{ route('menu') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('menu') ? 'tf-nav-active' : '' }}">
                        MENU
                    </a>
                </li>
                <li>
                    <a href="{{ route('order.history') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('order.history') ? 'tf-nav-active' : '' }}">
                        RIWAYAT
                    </a>
                </li>
                <li>
                    <a href="{{ route('berita') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('berita') || request()->routeIs('makanan.detail') ? 'tf-nav-active' : '' }}">
                        BERITA
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeri') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('galeri') ? 'tf-nav-active' : '' }}">
                        GALERI
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="tf-nav-link {{ $isHome ? 'tf-nav-link-home' : 'tf-nav-link-subpage' }} {{ request()->routeIs('kontak') ? 'tf-nav-active' : '' }}">
                        KONTAK
                    </a>
                </li>
            </ul>

            <!-- Right Actions: Cart & Auth -->
            <div class="tf-header-actions">
                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="tf-cart-btn" style="color: {{ $isHome ? '#000000' : '#FFFFFF' }};" title="Keranjang Belanja">
                    <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="tf-cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    <!-- User Profile Dropdown -->
                    <div style="position: relative;" class="tf-user-pill-container">
                        <div class="tf-user-pill {{ $isHome ? 'tf-user-pill-light' : 'tf-user-pill-dark' }} tf-user-toggle">
                            <span class="tf-user-pill-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span style="max-width: 90px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div class="tf-dropdown-menu">
                            <div style="padding: 10px 16px; border-bottom: 1px solid #F3F4F6;">
                                <div style="font-size: 13px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 11px; color: #6B7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->email }}</div>
                                <span style="display: inline-block; margin-top: 4px; font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 2px 8px; border-radius: 50px; background: {{ Auth::user()->role === 'admin' ? '#FFE4E6' : '#FEF3C7' }}; color: {{ Auth::user()->role === 'admin' ? '#9F1239' : '#92400E' }};">
                                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                                </span>
                            </div>
                            <div style="padding: 6px 0;">
                                <a href="{{ route('order.history') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; font-size: 12px; font-weight: 600; color: #374151; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#FEF3C7'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="#F59E0B" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span>Riwayat Pesanan</span>
                                </a>
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; font-size: 12px; font-weight: 600; color: #374151; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#FFE4E6'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="#E11D48" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Panel Administrator</span>
                                </a>
                                @endif
                            </div>
                            <div style="border-top: 1px solid #F3F4F6; margin: 4px 0;"></div>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 4px 8px;">
                                @csrf
                                <button type="submit" style="width: 100%; border: none; background: transparent; display: flex; align-items: center; gap: 8px; padding: 6px 8px; font-size: 12px; font-weight: 700; color: #DC2626; border-radius: 8px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#FEE2E2'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest: Masuk & Daftar -->
                    <a href="{{ route('login') }}" class="tf-btn-login" style="color: {{ $isHome ? '#000000' : '#FFFFFF' }};">
                        MASUK
                    </a>
                    <a href="{{ route('register') }}" class="tf-btn-register">
                        DAFTAR
                    </a>
                @endauth

                <!-- Mobile Toggle Button -->
                <button type="button" class="tf-mobile-toggle tf-btn-open-mobile" style="color: {{ $isHome ? '#000000' : '#FFFFFF' }};" aria-label="Buka Menu">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </header>

    <!-- ======================================================== -->
    <!-- 2. HEADER STICKY (Slides Down Smoothly on Scroll)        -->
    <!-- ======================================================== -->
    <header id="tfHeaderSticky" class="tf-header-sticky">
        <div class="tf-header-container">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="tf-logo tf-logo-sticky">
                <span>TASTY FOOD</span>
                
            </a>

            <!-- Nav Links (Desktop) -->
            <ul class="tf-nav-links">
                <li>
                    <a href="{{ route('home') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('home') ? 'tf-nav-active' : '' }}">
                        HOME
                    </a>
                </li>
                <li>
                    <a href="{{ route('tentang') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('tentang') ? 'tf-nav-active' : '' }}">
                        TENTANG
                    </a>
                </li>
                <li>
                    <a href="{{ route('menu') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('menu') ? 'tf-nav-active' : '' }}">
                        MENU
                    </a>
                </li>
                <li>
                    <a href="{{ route('order.history') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('order.history') ? 'tf-nav-active' : '' }}">
                        RIWAYAT
                    </a>
                </li>
                <li>
                    <a href="{{ route('berita') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('berita') || request()->routeIs('makanan.detail') ? 'tf-nav-active' : '' }}">
                        BERITA
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeri') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('galeri') ? 'tf-nav-active' : '' }}">
                        GALERI
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="tf-nav-link tf-nav-link-sticky {{ request()->routeIs('kontak') ? 'tf-nav-active' : '' }}">
                        KONTAK
                    </a>
                </li>
            </ul>

            <!-- Right Actions: Cart & Auth -->
            <div class="tf-header-actions">
                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="tf-cart-btn" style="color: #000000;" title="Keranjang Belanja">
                    <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="tf-cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    <!-- User Profile Dropdown -->
                    <div style="position: relative;" class="tf-user-pill-container">
                        <div class="tf-user-pill tf-user-pill-light tf-user-toggle">
                            <span class="tf-user-pill-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span style="max-width: 90px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div class="tf-dropdown-menu">
                            <div style="padding: 10px 16px; border-bottom: 1px solid #F3F4F6;">
                                <div style="font-size: 13px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 11px; color: #6B7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->email }}</div>
                                <span style="display: inline-block; margin-top: 4px; font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 2px 8px; border-radius: 50px; background: {{ Auth::user()->role === 'admin' ? '#FFE4E6' : '#FEF3C7' }}; color: {{ Auth::user()->role === 'admin' ? '#9F1239' : '#92400E' }};">
                                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                                </span>
                            </div>
                            <div style="padding: 6px 0;">
                                <a href="{{ route('order.history') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; font-size: 12px; font-weight: 600; color: #374151; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#FEF3C7'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="#F59E0B" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <span>Riwayat Pesanan</span>
                                </a>
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; font-size: 12px; font-weight: 600; color: #374151; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#FFE4E6'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="#E11D48" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Panel Administrator</span>
                                </a>
                                @endif
                            </div>
                            <div style="border-top: 1px solid #F3F4F6; margin: 4px 0;"></div>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 4px 8px;">
                                @csrf
                                <button type="submit" style="width: 100%; border: none; background: transparent; display: flex; align-items: center; gap: 8px; padding: 6px 8px; font-size: 12px; font-weight: 700; color: #DC2626; border-radius: 8px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#FEE2E2'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest: Masuk & Daftar -->
                    <a href="{{ route('login') }}" class="tf-btn-login" style="color: #000000;">
                        MASUK
                    </a>
                    <a href="{{ route('register') }}" class="tf-btn-register">
                        DAFTAR
                    </a>
                @endauth

                <!-- Mobile Toggle Button -->
                <button type="button" class="tf-mobile-toggle tf-btn-open-mobile" style="color: #000000;" aria-label="Buka Menu">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </header>

    <!-- ======================================================== -->
    <!-- 3. MOBILE MENU DRAWER (Full-screen overlay)              -->
    <!-- ======================================================== -->
    <div id="tfMobileDrawer" class="tf-mobile-drawer">
        <!-- Top bar in drawer -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid #27272A; margin-bottom: 24px;">
            <a href="{{ route('home') }}" class="tf-logo" style="color: #FFFFFF;">
                <span>TASTY FOOD</span>
                
            </a>
            <button type="button" id="tfBtnCloseMobile" style="background: transparent; border: none; color: #A1A1AA; cursor: pointer; padding: 6px;">
                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Links in drawer -->
        <div style="display: flex; flex-direction: column; gap: 18px;">
            <a href="{{ route('home') }}" style="color: {{ request()->routeIs('home') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                HOME
            </a>
            <a href="{{ route('tentang') }}" style="color: {{ request()->routeIs('tentang') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                TENTANG
            </a>
            <a href="{{ route('menu') }}" style="color: {{ request()->routeIs('menu') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                MENU MAKANAN
            </a>
            <a href="{{ route('order.history') }}" style="color: {{ request()->routeIs('order.history') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                RIWAYAT PESANAN
            </a>
            <a href="{{ route('cart.index') }}" style="display: flex; align-items: center; justify-content: space-between; color: {{ request()->routeIs('cart.index') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                <span>KERANJANG BELANJA</span>
                <span style="background: #F59E0B; color: #000000; font-size: 11px; font-weight: 900; padding: 2px 8px; border-radius: 50px;">
                    {{ $cartCount }} Item
                </span>
            </a>
            <a href="{{ route('berita') }}" style="color: {{ request()->routeIs('berita') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                BERITA
            </a>
            <a href="{{ route('galeri') }}" style="color: {{ request()->routeIs('galeri') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                GALERI
            </a>
            <a href="{{ route('kontak') }}" style="color: {{ request()->routeIs('kontak') ? '#F59E0B' : '#FFFFFF' }}; text-decoration: none; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                KONTAK
            </a>
        </div>

        <!-- Auth in drawer -->
        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #27272A; display: flex; flex-direction: column; gap: 12px;">
            @auth
                <div style="display: flex; align-items: center; gap: 12px; background: #18181B; padding: 12px 16px; border-radius: 14px; border: 1px solid #27272A;">
                    <span style="width: 36px; height: 36px; border-radius: 50%; background: #F59E0B; color: #000000; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 14px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <div style="min-width: 0; flex: 1;">
                        <div style="color: #FFFFFF; font-size: 13px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->name }}</div>
                        <div style="color: #A1A1AA; font-size: 11px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" style="text-align: center; background: #27272A; color: #FFFFFF; font-weight: 700; font-size: 12px; text-transform: uppercase; padding: 10px; border-radius: 12px; text-decoration: none;">
                    Panel Administrator
                </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; border: 1px solid rgba(239,68,68,0.3); background: rgba(239,68,68,0.1); color: #F87171; font-weight: 700; font-size: 12px; text-transform: uppercase; padding: 10px; border-radius: 12px; cursor: pointer;">
                        Keluar (Logout)
                    </button>
                </form>
            @else
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <a href="{{ route('login') }}" style="text-align: center; background: #27272A; color: #FFFFFF; font-weight: 700; font-size: 13px; text-transform: uppercase; padding: 12px; border-radius: 12px; text-decoration: none;">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" style="text-align: center; background: #F59E0B; color: #000000; font-weight: 800; font-size: 13px; text-transform: uppercase; padding: 12px; border-radius: 12px; text-decoration: none; box-shadow: 0 4px 12px rgba(245,158,11,0.3);">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- 4. FLOATING SCROLL TO TOP BUTTON                         -->
    <!-- ======================================================== -->
    <button type="button" id="tfScrollTop" style="position: fixed; bottom: 24px; right: 24px; width: 44px; height: 44px; border-radius: 50%; background: #000000; color: #FFFFFF; border: 1px solid #27272A; box-shadow: 0 4px 16px rgba(0,0,0,0.25); display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 9998; opacity: 0; visibility: hidden; transform: translateY(12px); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);" title="Kembali ke atas">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

</div>

<!-- ======================================================== -->
<!-- 5. JAVASCRIPT LOGIC (Scroll & Dropdown Handlers)         -->
<!-- ======================================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stickyHeader = document.getElementById('tfHeaderSticky');
        const scrollTopBtn = document.getElementById('tfScrollTop');
        const mobileDrawer = document.getElementById('tfMobileDrawer');
        const btnOpenMobiles = document.querySelectorAll('.tf-btn-open-mobile');
        const btnCloseMobile = document.getElementById('tfBtnCloseMobile');
        const userToggles = document.querySelectorAll('.tf-user-toggle');

        // Scroll listener for Sticky Header & Scroll To Top
        window.addEventListener('scroll', function() {
            const y = window.scrollY;

            // Trigger Sticky Header
            if (stickyHeader) {
                if (y > 110) {
                    stickyHeader.classList.add('show');
                } else {
                    stickyHeader.classList.remove('show');
                }
            }

            // Trigger Scroll To Top
            if (scrollTopBtn) {
                if (y > 280) {
                    scrollTopBtn.style.opacity = '1';
                    scrollTopBtn.style.visibility = 'visible';
                    scrollTopBtn.style.transform = 'translateY(0)';
                } else {
                    scrollTopBtn.style.opacity = '0';
                    scrollTopBtn.style.visibility = 'hidden';
                    scrollTopBtn.style.transform = 'translateY(12px)';
                }
            }
        }, { passive: true });

        // Scroll to Top action
        if (scrollTopBtn) {
            scrollTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            scrollTopBtn.addEventListener('mouseenter', function() {
                this.style.background = '#F59E0B';
                this.style.color = '#000000';
            });
            scrollTopBtn.addEventListener('mouseleave', function() {
                this.style.background = '#000000';
                this.style.color = '#FFFFFF';
            });
        }

        // Open Mobile Drawer
        btnOpenMobiles.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (mobileDrawer) {
                    mobileDrawer.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close Mobile Drawer
        if (btnCloseMobile) {
            btnCloseMobile.addEventListener('click', function() {
                if (mobileDrawer) {
                    mobileDrawer.classList.remove('open');
                    document.body.style.overflow = '';
                }
            });
        }

        // User Dropdowns
        userToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                if (dropdown) {
                    // Close others
                    document.querySelectorAll('.tf-dropdown-menu').forEach(m => {
                        if (m !== dropdown) m.classList.remove('show');
                    });
                    dropdown.classList.toggle('show');
                }
            });
        });

        // Close dropdowns on outside click
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.tf-dropdown-menu').forEach(m => {
                if (!m.contains(e.target) && !m.previousElementSibling?.contains(e.target)) {
                    m.classList.remove('show');
                }
            });
        });
    });
</script>
