@extends('layouts.app')

@section('title', 'Keranjang Belanja - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">KERANJANG PESANAN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2">Periksa kembali daftar hidangan yang Anda pilih sebelum melanjutkan ke pengisian alamat dan checkout.</p>
    </div>
</section>

<!-- Cart Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-xl flex items-center space-x-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium text-xs sm:text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-xl flex items-center space-x-3 shadow-sm">
                <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="font-medium text-xs sm:text-sm">{{ session('error') }}</span>
            </div>
        @endif

        @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Cart Items List -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <h2 class="text-lg sm:text-xl font-extrabold text-gray-900 uppercase">
                        Daftar Makanan ({{ count($cart) }} Item)
                    </h2>
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua item di keranjang?');">
                        @csrf
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-700 font-semibold uppercase hover:underline">
                            Kosongkan Keranjang
                        </button>
                    </form>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach($cart as $id => $item)
                    <div class="py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['nama'] }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover flex-shrink-0 shadow-sm border border-gray-100">
                            <div>
                                <span class="text-[10px] bg-gray-100 text-gray-600 font-semibold px-2 py-0.5 rounded-full uppercase">
                                    {{ $item['kategori'] ?? 'Menu' }}
                                </span>
                                <h3 class="font-extrabold text-sm sm:text-base text-gray-900 mt-1">
                                    {{ $item['nama'] }}
                                </h3>
                                <p class="text-amber-600 font-bold text-xs sm:text-sm mt-0.5">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Quantity Selector & Subtotal -->
                        <div class="flex items-center justify-between sm:justify-end space-x-6 sm:space-x-8">
                            <!-- Qty Controls -->
                            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-gray-50">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition font-bold text-sm">
                                        -
                                    </button>
                                </form>
                                <span class="w-10 text-center font-bold text-xs sm:text-sm text-gray-800">
                                    {{ $item['quantity'] }}
                                </span>
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition font-bold text-sm">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- Subtotal -->
                            <div class="text-right min-w-[100px]">
                                <span class="text-[10px] text-gray-400 block uppercase font-semibold">Subtotal</span>
                                <span class="font-extrabold text-sm sm:text-base text-gray-900">
                                    Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Delete Button -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus menu ini dari keranjang?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-rose-600 transition p-1" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pt-6 border-t border-gray-100 mt-2">
                    <a href="{{ route('menu') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-amber-600 hover:text-amber-700 uppercase">
                        <span>&larr; Tambah Menu Lainnya</span>
                    </a>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-4 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                <h2 class="text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100">
                    Ringkasan Belanja
                </h2>

                <div class="space-y-3 py-6 text-xs sm:text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Total Item ({{ array_sum(array_column($cart, 'quantity')) }} porsi)</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Estimasi Pengantaran</span>
                        <span class="font-semibold text-emerald-600">Gratis / Standar</span>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm sm:text-base font-extrabold text-gray-900 uppercase">Total Bayar</span>
                        <span class="text-xl font-extrabold text-amber-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('checkout') }}" class="w-full bg-black hover:bg-neutral-800 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider py-4 px-6 rounded-2xl transition flex items-center justify-center space-x-2 shadow-md hover:shadow-lg">
                    <span>Lanjut ke Checkout &rarr;</span>
                </a>

                <p class="text-[11px] text-gray-400 text-center mt-4">
                    Alamat pengantaran dan pin lokasi peta akan diisi pada langkah selanjutnya.
                </p>
            </div>
        </div>
        @else
        <!-- Empty Cart State -->
        <div class="bg-white rounded-3xl p-12 sm:p-16 text-center max-w-xl mx-auto shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 uppercase mb-2">Keranjang Anda Masih Kosong</h2>
            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-8">
                Yuk, jelajahi berbagai hidangan lezat khas Nusantara kami dan mulai pesanan makanan Anda sekarang!
            </p>
            <a href="{{ route('menu') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-8 py-3.5 rounded-xl transition shadow-md">
                Buka Menu Makanan &rarr;
            </a>
        </div>
        @endif

    </div>
</section>
@endsection
