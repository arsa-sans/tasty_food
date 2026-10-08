@php
    $isHome = request()->routeIs('home');
    $textColor = $isHome ? 'text-white' : 'text-black';
    $hoverColor = 'hover:text-amber-500';
    $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
@endphp
@extends('layouts.app')

@section('title', 'Menu Makanan & Pemesanan - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">MENU MAKANAN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2 max-w-xl">
            Pilih hidangan favorit khas Nusantara dari Tasty Food dan pesan secara praktis diantar langsung ke lokasi Anda.
        </p>
    </div>
</section>

<!-- Menu Listing Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9] pb-32">
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
                <a href="{{ route('order.history', ['search' => request('search')]) }}" class="px-5 py-2 rounded-full text-xs font-bold uppercase transition bg-gray-100 text-gray-700 hover:bg-gray-200">
                    Riwayat Pemesanan
                </a>
                <!-- Cart Icon Button -->
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center {{ $textColor }} {{ $hoverColor }} transition-colors p-2" title="Keranjang Pesanan">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-amber-500 text-black text-[10px] font-extrabold rounded-full h-5 w-5 flex items-center justify-center shadow-md animate-pulse">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
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

        @php
            $sessionCart = session()->get('cart', []);
            $initialCartMap = [];
            foreach ($sessionCart as $item) {
                if (isset($item['id']) && isset($item['quantity'])) {
                    $initialCartMap[$item['id']] = (int) $item['quantity'];
                }
            }
            $menuPriceMap = [];
            foreach ($menus as $m) {
                $menuPriceMap[$m->id] = (float) $m->harga;
            }
            $cartTotalQty = array_sum($initialCartMap);
            $cartTotalHarga = 0;
            foreach ($sessionCart as $c) {
                $cartTotalHarga += $c['harga'] * $c['quantity'];
            }
        @endphp

        <!-- Menu Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
            @forelse($menus as $menu)
            @php
                $initialQty = $initialCartMap[$menu->id] ?? 0;
            @endphp
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col group" id="card-menu-{{ $menu->id }}">
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

                    <!-- Action: Instant One-Click Add & Quantity Counter -->
                    <div class="pt-3 border-t border-gray-100">
                        @if($menu->is_tersedia)
                            <!-- State 1: Belum Ditambahkan (Qty == 0) -->
                            <div id="btn-add-wrap-{{ $menu->id }}" class="{{ $initialQty > 0 ? 'hidden' : 'block' }}">
                                <button type="button" onclick="handleQuickAdd({{ $menu->id }})"
                                        class="w-full bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider py-3 px-4 rounded-xl transition flex items-center justify-center space-x-2 shadow-sm hover:shadow-md active:scale-95">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah</span>
                                </button>
                            </div>

                            <!-- State 2: Sudah Dipilih (Qty > 0) -->
                            <div id="counter-wrap-{{ $menu->id }}" class="{{ $initialQty > 0 ? 'flex' : 'hidden' }} items-center justify-between border-2 border-amber-500 bg-amber-50/70 rounded-xl px-2 py-1 h-11 transition shadow-sm">
                                <button type="button" onclick="handleChangeQty({{ $menu->id }}, -1)"
                                        class="w-8 h-8 rounded-lg bg-black hover:bg-neutral-800 text-white flex items-center justify-center font-bold text-base transition active:scale-90"
                                        aria-label="Kurangi porsi">
                                    &minus;
                                </button>
                                <span id="qty-text-{{ $menu->id }}" class="font-extrabold text-sm text-gray-900 px-3">
                                    {{ $initialQty }}
                                </span>
                                <button type="button" onclick="handleChangeQty({{ $menu->id }}, 1)"
                                        class="w-8 h-8 rounded-lg bg-black hover:bg-neutral-800 text-white flex items-center justify-center font-bold text-base transition active:scale-90"
                                        aria-label="Tambah porsi">
                                    +
                                </button>
                            </div>
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

<!-- Floating Black & Yellow Cart Bar -->
<div id="floating-cart-bar"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 w-11/12 max-w-xl transition-all duration-300 transform {{ $cartTotalQty > 0 ? 'translate-y-0 opacity-100 pointer-events-auto' : 'translate-y-28 opacity-0 pointer-events-none' }}">
    <div class="bg-black/95 backdrop-blur-md text-white rounded-2xl p-4 sm:p-5 shadow-2xl border border-neutral-700 flex items-center justify-between gap-4">
        <!-- Left: Yellow Total Quantity Badge & Text Details -->
        <div class="flex items-center space-x-3">
            <div id="bar-total-qty" class="w-10 h-10 bg-amber-500 text-black rounded-xl flex items-center justify-center font-extrabold text-base flex-shrink-0 shadow">
                {{ $cartTotalQty }}
            </div>
            <div class="leading-tight">
                <span class="text-[11px] text-gray-300 block font-semibold uppercase tracking-wider">
                    KERANJANG ANDA (<span id="bar-menu-count">{{ count($initialCartMap) }}</span> MENU)
                </span>
                <span id="bar-total-price" class="text-sm sm:text-base font-extrabold text-amber-400">
                    Rp {{ number_format($cartTotalHarga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Right: Checkout Button -->
        <form id="form-go-checkout" action="{{ route('cart.sync') }}" method="POST">
            @csrf
            <input type="hidden" name="items" id="hidden-cart-items" value="{{ json_encode($initialCartMap) }}">
            <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 active:scale-95 text-black font-extrabold text-xs sm:text-sm uppercase tracking-wider py-3 px-5 rounded-xl transition flex items-center space-x-1.5 whitespace-nowrap shadow-md hover:shadow-lg">
                <span>LIHAT & CHECKOUT &rarr;</span>
            </button>
        </form>
    </div>
</div>

<script>
    // State of selected menus: { [menuId]: quantity }
    const cartState = @json($initialCartMap);
    const menuPrices = @json($menuPriceMap);
    const syncUrl = "{{ route('cart.sync') }}";
    const csrfToken = "{{ csrf_token() }}";
    let syncTimeout = null;

    function formatRupiah(number) {
        return 'Rp ' + Number(number).toLocaleString('id-ID');
    }

    function handleQuickAdd(menuId) {
        cartState[menuId] = 1;
        updateCardUI(menuId, 1);
        recalculateAndRenderBar();
        debounceServerSync();
    }

    function handleChangeQty(menuId, delta) {
        let currentQty = cartState[menuId] || 0;
        currentQty += delta;

        if (currentQty <= 0) {
            delete cartState[menuId];
            updateCardUI(menuId, 0);
        } else {
            cartState[menuId] = Math.min(currentQty, 99);
            updateCardUI(menuId, cartState[menuId]);
        }

        recalculateAndRenderBar();
        debounceServerSync();
    }

    function updateCardUI(menuId, qty) {
        const btnAdd = document.getElementById('btn-add-wrap-' + menuId);
        const counter = document.getElementById('counter-wrap-' + menuId);
        const textQty = document.getElementById('qty-text-' + menuId);

        if (!btnAdd || !counter) return;

        if (qty > 0) {
            btnAdd.classList.add('hidden');
            counter.classList.remove('hidden');
            counter.classList.add('flex');
            if (textQty) textQty.innerText = qty;
        } else {
            counter.classList.add('hidden');
            counter.classList.remove('flex');
            btnAdd.classList.remove('hidden');
            btnAdd.classList.add('block');
        }
    }

    function recalculateAndRenderBar() {
        let totalQty = 0;
        let totalPrice = 0;
        let menuCount = 0;

        for (const [id, qty] of Object.entries(cartState)) {
            const count = parseInt(qty) || 0;
            if (count > 0) {
                menuCount++;
                totalQty += count;
                const price = parseFloat(menuPrices[id]) || 0;
                totalPrice += count * price;
            }
        }

        const bar = document.getElementById('floating-cart-bar');
        const badgeQty = document.getElementById('bar-total-qty');
        const badgeMenu = document.getElementById('bar-menu-count');
        const badgePrice = document.getElementById('bar-total-price');
        const hiddenInput = document.getElementById('hidden-cart-items');

        if (badgeQty) badgeQty.innerText = totalQty;
        if (badgeMenu) badgeMenu.innerText = menuCount;
        if (badgePrice) badgePrice.innerText = formatRupiah(totalPrice);
        if (hiddenInput) hiddenInput.value = JSON.stringify(cartState);

        // Animate floating bar in/out
        if (bar) {
            if (totalQty > 0) {
                bar.classList.remove('translate-y-28', 'opacity-0', 'pointer-events-none');
                bar.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            } else {
                bar.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                bar.classList.add('translate-y-28', 'opacity-0', 'pointer-events-none');
            }
        }
    }

    function debounceServerSync() {
        if (syncTimeout) clearTimeout(syncTimeout);
        syncTimeout = setTimeout(() => {
            fetch(syncUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ items: cartState })
            }).catch(err => console.error('Auto-sync error:', err));
        }, 300);
    }
</script>
@endsection
