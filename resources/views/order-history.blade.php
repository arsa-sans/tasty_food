@extends('layouts.app')

@section('title', 'Riwayat Pemesanan Pelanggan - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">RIWAYAT PESANAN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2 max-w-xl">
            Pantau perkembangan hidangan Anda mulai dari konfirmasi dapur, proses memasak, pengantaran kurir, hingga konfirmasi penerimaan dan rating.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @auth
        <!-- User Account Badge Banner -->
        <div class="mb-8 p-5 bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-3.5">
                <div class="w-12 h-12 rounded-2xl bg-amber-500 text-black flex items-center justify-center text-lg font-black uppercase shadow-xs">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-gray-900 flex items-center gap-2">
                        <span>{{ auth()->user()->name }}</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 uppercase">Akun Terhubung</span>
                    </h3>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }} &bull; Menampilkan riwayat pesanan akun Anda</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('menu') }}" class="bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider py-2.5 px-4 rounded-xl transition shadow-xs">
                    + Pesan Menu Baru
                </a>
            </div>
        </div>
        @else
        <!-- Guest Notification Banner -->
        <div class="mb-8 p-5 bg-gradient-to-r from-amber-50 to-orange-50 rounded-3xl border border-amber-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 text-black flex items-center justify-center flex-shrink-0 shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-extrabold text-gray-900">Ingin Riwayat Pesanan Anda Tersimpan Otomatis?</h3>
                    <p class="text-[11px] sm:text-xs text-gray-600 mt-0.5">Masuk ke akun Anda agar seluruh pesanan tersimpan rapi dan dapat dipantau dari perangkat mana pun.</p>
                </div>
            </div>
            <div class="flex items-center space-x-2 flex-shrink-0">
                <a href="{{ route('login') }}" class="bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider py-2.5 px-4 rounded-xl transition shadow-xs">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-black font-extrabold text-xs uppercase tracking-wider py-2.5 px-4 rounded-xl transition shadow-xs">
                    Daftar
                </a>
            </div>
        </div>
        @endauth

        <!-- Search Box -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 mb-10">
            <h2 class="text-sm sm:text-base font-extrabold text-gray-900 uppercase mb-2">
                Cari Pesanan Anda
            </h2>
            <p class="text-xs text-gray-500 mb-4">
                Masukkan Kode Pesanan (contoh: <span class="font-mono text-amber-600 font-bold">TF-20261006-7O70T</span>) atau Nomor WhatsApp yang digunakan saat memesan:
            </p>

            <form action="{{ route('order.history') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Ketik kode pesanan atau nomor HP/WhatsApp..."
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                </div>
                <button type="submit" class="bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider py-3 px-6 rounded-xl transition flex items-center justify-center space-x-2 shadow-sm">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Cari Riwayat</span>
                </button>
                @if($search)
                    <a href="{{ route('order.history') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs uppercase tracking-wider py-3 px-4 rounded-xl transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Order List -->
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $ord)
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <!-- Order Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-gray-100 gap-3">
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="font-mono font-extrabold text-sm sm:text-base text-gray-900 bg-gray-100 px-3 py-1 rounded-lg">
                                    {{ $ord->order_code }}
                                </span>
                                @if($ord->is_diterima)
                                    <span class="bg-emerald-100 text-emerald-800 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                        ✓ Diterima
                                    </span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-400 mt-1 block">
                                Dipesan pada {{ $ord->created_at->format('d M Y, H:i') }} WIB &bull; Atas nama: <strong class="text-gray-700">{{ $ord->nama_pelanggan }}</strong>
                            </span>
                        </div>

                        <div class="sm:text-right">
                            <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider {{ $ord->status_badge_class }}">
                                {{ $ord->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Items Summary & Total -->
                    <div class="py-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <div class="md:col-span-8">
                            <span class="text-[11px] font-bold uppercase text-gray-400 block mb-1">Menu yang Dipesan:</span>
                            <div class="text-xs sm:text-sm text-gray-800 font-medium">
                                @foreach($ord->items as $idx => $it)
                                    <span class="inline-block bg-gray-50 border border-gray-100 rounded-lg px-2.5 py-1 mr-1 mb-1">
                                        {{ $it->nama_menu }} <strong class="text-amber-600">({{ $it->jumlah }}x)</strong>
                                    </span>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-400 mt-2 line-clamp-1">
                                <span class="font-semibold text-gray-500">Tujuan:</span> {{ $ord->alamat_lengkap }}
                            </p>
                        </div>

                        <div class="md:col-span-4 md:text-right border-t md:border-t-0 pt-3 md:pt-0 border-gray-100">
                            <span class="text-[11px] font-bold uppercase text-gray-400 block">Total Pembayaran:</span>
                            <span class="text-lg sm:text-xl font-extrabold text-amber-600 block">
                                {{ $ord->formatted_total }}
                            </span>
                            <span class="inline-block text-[10px] font-bold px-2 py-0.5 rounded-full {{ $ord->status_pembayaran === 'lunas' ? 'bg-emerald-100 text-emerald-800' : ($ord->status_pembayaran === 'menunggu_verifikasi' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-700') }} mt-1">
                                {{ $ord->metode_pembayaran ?? 'COD' }} ({{ $ord->status_pembayaran_label }})
                            </span>
                            @if($ord->rating)
                                <div class="mt-1 text-amber-400 text-xs font-bold">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $ord->rating ? '★' : '☆' }}
                                    @endfor
                                    <span class="text-gray-500">({{ $ord->rating }}/5)</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs text-gray-500">
                            <span class="font-semibold text-gray-700">Keterangan:</span>
                            {{ Str::limit($ord->keterangan_admin ?? 'Pesanan sedang diproses.', 80) }}
                        </div>

                        <a href="{{ route('order.track', $ord->order_code) }}"
                           class="inline-flex items-center justify-center space-x-2 bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl transition shadow-sm hover:shadow whitespace-nowrap">
                            <span>Lihat Status Pesanan</span>
                            <span class="text-amber-400">&rarr;</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($orders->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-12 sm:p-16 text-center shadow-sm border border-gray-100">
                <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-extrabold text-gray-900 uppercase mb-2">
                    @if($search)
                        Pesanan Tidak Ditemukan
                    @else
                        Belum Ada Riwayat Pesanan
                    @endif
                </h3>
                <p class="text-xs sm:text-sm text-gray-500 max-w-md mx-auto mb-6">
                    @if($search)
                        Tidak ditemukan pesanan dengan pencarian "<span class="font-bold text-gray-800">{{ $search }}</span>". Pastikan kode pesanan atau nomor WhatsApp yang Anda masukkan sudah sesuai.
                    @elseif(auth()->check())
                        Halo <span class="font-bold text-gray-800">{{ auth()->user()->name }}</span>, Anda belum memiliki riwayat pesanan yang terhubung. Mulai pesan makanan lezat favorit Anda sekarang!
                    @else
                        Anda belum melakukan pemesanan makanan melalui browser ini. Silakan masuk ke akun Anda atau mulai pesan makanan baru.
                    @endif
                </p>
                <a href="{{ route('menu') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition shadow">
                    Buka Menu Makanan &rarr;
                </a>
            </div>
        @endif

    </div>
</section>
@endsection
