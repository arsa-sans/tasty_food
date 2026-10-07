@extends('layouts.app')

@section('title', 'Menu Makanan & Pemesanan - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">MENU MAKANAN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2 max-w-xl">Pilih hidangan favorit khas Nusantara dari Tasty Food dan pesan secara praktis diantar langsung ke lokasi Anda.</p>
    </div>
</section>

<!-- Menu Listing Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9] pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <a href="{{ route('cart.index') }}" class="ml-4 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase px-4 py-2 rounded-lg transition whitespace-nowrap">
                    Lihat Keranjang &rarr;
                </a>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-xl flex items-center space-x-3 shadow-sm">
                <svg class="w-6 h-6 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Category Pills -->
            <div class="flex flex-wrap gap-2 items-center">
                <a href="{{ route('menu', ['search' => request('search')]) }}"
                   class="px-5 py-2 rounded-full text-xs font-bold uppercase transition {{ !request('kategori') || request('kategori') == 'Semua' ? 'bg-black text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('menu', ['kategori' => $cat, 'search' => request('search')]) }}"
                       class="px-5 py-2 rounded-full text-xs font-bold uppercase transition {{ request('kategori') == $cat ? 'bg-black text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Search Input -->
            <form action="{{ route('menu') }}" method="GET" class="relative max-w-xs w-full">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama makanan..."
                       class="w-full bg-gray-50 border border-gray-200 rounded-full pl-4 pr-10 py-2 text-xs focus:outline-none focus:border-amber-500 focus:bg-white transition">
                <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-black">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Menu Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
            @forelse($menus as $menu)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col group">
                <!-- Image with Category Badge -->
                <div class="relative h-52 sm:h-56 w-full overflow-hidden bg-gray-100">
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <span class="absolute top-3 left-3 bg-black/70 backdrop-blur-sm text-white text-[11px] font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $menu->kategori }}
                    </span>
                    @if(!$menu->is_tersedia)
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                            <span class="bg-rose-600 text-white font-bold text-xs px-3 py-1.5 rounded-full uppercase tracking-wider shadow">Habis</span>
                        </div>
                    @endif
                </div>

                <!-- Info & Price -->
                <div class="p-5 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-extrabold text-base text-gray-900 group-hover:text-amber-600 transition mb-1 leading-snug">
                            {{ $menu->nama }}
                        </h3>
                        <p class="text-amber-600 font-extrabold text-lg mb-2">
                            {{ $menu->formatted_harga }}
                        </p>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-4">
                            {{ $menu->deskripsi ?? 'Hidangan istimewa racikan bumbu khas Nusantara dari dapur Tasty Food.' }}
                        </p>
                    </div>

                    <!-- Action: Portion Selector & Order Button -->
                    <div class="pt-3 border-t border-gray-100">
                        @if($menu->is_tersedia)
                            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <!-- Portion Selector (- / Qty / +) -->
                                    <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-gray-50 h-10 flex-shrink-0">
                                        <button type="button" onclick="decrementQty({{ $menu->id }})" class="w-7 h-full flex items-center justify-center text-gray-600 hover:bg-gray-200 font-bold transition text-sm">
                                            &minus;
                                        </button>
                                        <input type="number" name="quantity" id="qty-{{ $menu->id }}" value="1" min="1" max="99" class="w-10 h-full text-center font-extrabold text-xs bg-transparent border-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button type="button" onclick="incrementQty({{ $menu->id }})" class="w-7 h-full flex items-center justify-center text-gray-600 hover:bg-gray-200 font-bold transition text-sm">
                                            +
                                        </button>
                                    </div>

                                    <!-- Add Button -->
                                    <button type="submit" class="flex-1 bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider h-10 px-3 rounded-xl transition flex items-center justify-center space-x-1.5 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <span>Pesan</span>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-200 text-gray-400 font-bold text-xs uppercase tracking-wider py-2.5 px-4 rounded-xl cursor-not-allowed">
                                Menu Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1">Menu Tidak Ditemukan</h3>
                <p class="text-xs text-gray-500 mb-4">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('menu') }}" class="inline-block bg-black text-white text-xs font-bold uppercase px-6 py-2.5 rounded-xl hover:bg-neutral-800 transition">
                    Reset Filter
                </a>
            </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Sticky Bottom Cart Bar (if cart has items) -->
@php
    $cartSession = session()->get('cart', []);
    $cartTotalQty = array_sum(array_column($cartSession, 'quantity'));
    $cartTotalHarga = 0;
    foreach($cartSession as $c) {
        $cartTotalHarga += $c['harga'] * $c['quantity'];
    }
@endphp

@if($cartTotalQty > 0)
<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 w-11/12 max-w-xl">
    <div class="bg-black/95 backdrop-blur-md text-white rounded-2xl p-4 sm:p-5 shadow-2xl border border-neutral-700 flex items-center justify-between gap-4">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-amber-500 text-black rounded-xl flex items-center justify-center font-extrabold text-sm flex-shrink-0">
                {{ $cartTotalQty }}
            </div>
            <div>
                <span class="text-xs text-gray-300 block font-semibold uppercase">Keranjang Anda ({{ count($cartSession) }} Menu)</span>
                <span class="text-sm sm:text-base font-extrabold text-amber-400">
                    Rp {{ number_format($cartTotalHarga, 0, ',', '.') }}
                </span>
            </div>
        </div>
        <a href="{{ route('cart.index') }}" class="bg-amber-500 hover:bg-amber-600 text-black font-extrabold text-xs sm:text-sm uppercase tracking-wider py-2.5 px-5 rounded-xl transition flex items-center space-x-1.5 whitespace-nowrap shadow">
            <span>Lihat & Checkout &rarr;</span>
        </a>
    </div>
</div>
@endif

<script>
function incrementQty(id) {
    const input = document.getElementById('qty-' + id);
    if (input) {
        let val = parseInt(input.value) || 1;
        input.value = Math.min(val + 1, 99);
    }
}
function decrementQty(id) {
    const input = document.getElementById('qty-' + id);
    if (input) {
        let val = parseInt(input.value) || 1;
        input.value = Math.max(val - 1, 1);
    }
}
</script>
@endsection
