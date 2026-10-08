@extends('layouts.app')

@section('title', 'Status Pesanan ' . $order->order_code . ' - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <div class="text-white/80 text-xs sm:text-sm uppercase tracking-wider mb-2">
            <a href="{{ route('home') }}" class="hover:underline">Home</a> /
            <a href="{{ route('menu') }}" class="hover:underline">Menu</a> /
            <span class="text-amber-400 font-semibold">Pelacakan Pesanan</span>
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white uppercase tracking-tight">STATUS PESANAN</h1>
    </div>
</section>

<!-- Tracking Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl shadow-sm flex items-center space-x-3">
                <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div class="text-xs sm:text-sm">
                    <span class="font-bold block">{{ session('success') }}</span>
                    <span class="text-emerald-700">Simpan tautan ini atau catat kode pesanan Anda untuk memantau status pembuatan dan pengantaran.</span>
                </div>
            </div>
        @endif

        <!-- Card Order Header -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-gray-100 gap-4">
                <div>
                    <span class="text-xs uppercase tracking-wider text-gray-400 font-bold block mb-1">Kode Pesanan</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-wider">
                        {{ $order->order_code }}
                    </h2>
                    <span class="text-xs text-gray-400">
                        Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB
                    </span>
                </div>

                <div class="sm:text-right">
                    <span class="text-xs uppercase tracking-wider text-gray-400 font-bold block mb-1">Status Terkini</span>
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider {{ $order->status_badge_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>

            <!-- Visual Progress Tracker -->
            @php
                $stepMap = [
                    'menunggu_konfirmasi' => 1,
                    'dikonfirmasi' => 2,
                    'sedang_dimasak' => 3,
                    'dalam_pengiriman' => 4,
                    'selesai' => 5,
                    'dibatalkan' => 0,
                ];
                $currentStep = $stepMap[$order->status] ?? 1;
            @endphp

            @if($order->status !== 'dibatalkan')
            <div class="py-8">
                <div class="relative">
                    <!-- Progress Bar Background Line -->
                    <div class="hidden sm:block absolute top-5 left-10 right-10 h-1 bg-gray-200 -z-0">
                        <div class="h-1 bg-amber-500 transition-all duration-700"
                             style="width: {{ (($currentStep - 1) / 4) * 100 }}%;"></div>
                    </div>

                    <!-- 5 Steps -->
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 relative z-10">
                        <!-- Step 1: Menunggu Konfirmasi -->
                        <div class="text-center flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs transition {{ $currentStep >= 1 ? 'bg-amber-500 text-black shadow-md' : 'bg-gray-100 text-gray-400' }}">
                                @if($currentStep > 1) ✓ @else 1 @endif
                            </div>
                            <span class="text-xs font-bold mt-2 uppercase {{ $currentStep >= 1 ? 'text-gray-900' : 'text-gray-400' }}">
                                Menunggu Konfirmasi
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Pesanan Masuk</span>
                        </div>

                        <!-- Step 2: Dikonfirmasi -->
                        <div class="text-center flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs transition {{ $currentStep >= 2 ? 'bg-amber-500 text-black shadow-md' : 'bg-gray-100 text-gray-400' }}">
                                @if($currentStep > 2) ✓ @else 2 @endif
                            </div>
                            <span class="text-xs font-bold mt-2 uppercase {{ $currentStep >= 2 ? 'text-gray-900' : 'text-gray-400' }}">
                                Dikonfirmasi
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Admin Restoran</span>
                        </div>

                        <!-- Step 3: Sedang Dimasak -->
                        <div class="text-center flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs transition {{ $currentStep >= 3 ? 'bg-amber-500 text-black shadow-md' : 'bg-gray-100 text-gray-400' }}">
                                @if($currentStep > 3) ✓ @else 3 @endif
                            </div>
                            <span class="text-xs font-bold mt-2 uppercase {{ $currentStep >= 3 ? 'text-gray-900' : 'text-gray-400' }}">
                                Sedang Dimasak
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Dapur Restoran</span>
                        </div>

                        <!-- Step 4: Dalam Pengiriman -->
                        <div class="text-center flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs transition {{ $currentStep >= 4 ? 'bg-amber-500 text-black shadow-md' : 'bg-gray-100 text-gray-400' }}">
                                @if($currentStep > 4) ✓ @else 4 @endif
                            </div>
                            <span class="text-xs font-bold mt-2 uppercase {{ $currentStep >= 4 ? 'text-gray-900' : 'text-gray-400' }}">
                                Pengantaran
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Kurir Menuju Lokasi</span>
                        </div>

                        <!-- Step 5: Selesai -->
                        <div class="text-center flex flex-col items-center col-span-2 sm:col-span-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs transition {{ $currentStep >= 5 ? 'bg-emerald-500 text-white shadow-md' : 'bg-gray-100 text-gray-400' }}">
                                @if($currentStep >= 5) ✓ @else 5 @endif
                            </div>
                            <span class="text-xs font-bold mt-2 uppercase {{ $currentStep >= 5 ? 'text-emerald-700' : 'text-gray-400' }}">
                                Telah Sampai
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Pesanan Diterima</span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Cancelled Notice -->
            <div class="my-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-800 text-xs sm:text-sm font-semibold">
                Pesanan ini telah dibatalkan oleh pihak restoran.
            </div>
            @endif

            <!-- Keterangan Admin Box -->
            <div class="mt-4 p-5 rounded-2xl bg-amber-50/70 border border-amber-200">
                <span class="text-[11px] font-bold text-amber-800 uppercase tracking-wider block mb-1">
                    Keterangan dari Restoran:
                </span>
                <p class="text-xs sm:text-sm font-medium text-amber-950 leading-relaxed">
                    {{ $order->keterangan_admin ?? 'Pesanan Anda sedang diproses oleh tim Tasty Food.' }}
                </p>
                <span class="text-[10px] text-amber-700/80 mt-1 block">
                    Diperbarui: {{ $order->updated_at->diffForHumans() }}
                </span>
            </div>

            <!-- Fitur Konfirmasi Terima Pesanan & Rating Pelanggan -->
            @if($order->is_diterima)
            <div class="mt-6 p-6 rounded-3xl bg-emerald-50 border border-emerald-200">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                        ✓
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm sm:text-base text-emerald-950">
                            Pesanan Telah Anda Terima
                        </h4>
                        <span class="text-xs text-emerald-700">
                            Dikonfirmasi pada {{ $order->diterima_at ? $order->diterima_at->format('d M Y, H:i') : '-' }} WIB
                        </span>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-emerald-100 mt-2">
                    <div class="flex items-center space-x-2 mb-1.5">
                        <span class="text-xs font-bold text-gray-500 uppercase">Rating Anda:</span>
                        <div class="text-amber-400 text-base">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $order->rating)
                                    ★
                                @else
                                    <span class="text-gray-300">★</span>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs font-bold text-gray-700">({{ $order->rating }}/5 Bintang)</span>
                    </div>
                    @if($order->ulasan)
                        <p class="text-xs text-gray-700 italic">"{{ $order->ulasan }}"</p>
                    @endif
                </div>
            </div>
            @elseif(in_array($order->status, ['dalam_pengiriman', 'selesai']))
            <div class="mt-6 p-6 rounded-3xl bg-amber-50/90 border-2 border-amber-300 shadow-sm">
                <div>
                    <span class="text-[10px] bg-amber-500 text-black font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                        Konfirmasi Penerimaan Pelanggan
                    </span>
                    <h4 class="font-extrabold text-base sm:text-lg text-gray-900 mt-2">
                        Makanan Sudah Sampai di Lokasi Anda?
                    </h4>
                    <p class="text-xs text-gray-600 mt-1">
                        Beri tahu kami bahwa Anda telah menerima pesanan dengan baik, serta berikan rating bintang & ulasan untuk membantu kami meningkatkan kualitas hidangan dan pelayanan!
                    </p>
                </div>

                <form action="{{ route('order.confirm-received', $order->order_code) }}" method="POST" class="space-y-4 mt-4">
                    @csrf

                    <!-- Interactive Star Rating -->
                    <div>
                        <label class="block text-xs font-extrabold text-gray-800 uppercase mb-2">
                            Beri Rating Kepuasan (1 - 5 Bintang) <span class="text-rose-500">*</span>
                        </label>
                        <div class="flex items-center space-x-2" id="star-rating-container">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" {{ $i === 5 ? 'checked' : '' }} class="hidden star-radio">
                                    <span class="star-icon text-3xl transition select-none text-amber-400 hover:scale-125" data-val="{{ $i }}">★</span>
                                </label>
                            @endfor
                            <span id="rating-text" class="text-xs font-bold text-amber-800 ml-2">Sangat Puas (5 Bintang)</span>
                        </div>
                    </div>

                    <!-- Review Textarea -->
                    <div>
                        <label for="ulasan" class="block text-xs font-extrabold text-gray-800 uppercase mb-1">
                            Ulasan / Pesan untuk Restoran (Opsional)
                        </label>
                        <textarea id="ulasan" name="ulasan" rows="2"
                                  placeholder="Contoh: Makanannya lezat, porsinya pas, dan masih hangat sampai di rumah!"
                                  class="w-full bg-white border border-gray-200 rounded-xl p-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 transition"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider py-3.5 px-6 rounded-xl transition flex items-center justify-center space-x-2 shadow-md">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Konfirmasi Pesanan Diterima & Kirim Rating</span>
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Rincian Makanan -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                <h3 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 mb-4">
                    Rincian Makanan yang Dipesan
                </h3>

                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                    <div class="py-3.5 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-gray-900">{{ $item->nama_menu }}</h4>
                            <span class="text-xs text-gray-400">
                                {{ $item->jumlah }} porsi &times; Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        </div>
                        <span class="font-extrabold text-xs sm:text-sm text-gray-900">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-gray-100 space-y-2 text-xs sm:text-sm mt-2">
                    <div class="flex justify-between text-gray-500">
                        <span>Ongkos Kirim</span>
                        <span class="font-bold text-emerald-600">GRATIS</span>
                    </div>
                    <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm font-extrabold text-gray-900 uppercase">Total Pembayaran</span>
                        <span class="text-xl font-extrabold text-amber-600">
                            {{ $order->formatted_total }}
                        </span>
                    </div>
                </div>

                <!-- Payment Information & Proof -->
                <div class="mt-6 pt-5 border-t border-gray-100">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Informasi Pembayaran</h4>
                    <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 font-semibold">Metode:</span>
                            <span class="text-xs font-bold text-gray-900 flex items-center gap-1.5">
                                @if($order->tipe_pembayaran === 'cash')
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                @elseif($order->tipe_pembayaran === 'e_wallet')
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                @else
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                @endif
                                {{ $order->metode_pembayaran ?? 'Cash On Delivery' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 font-semibold">Status Pembayaran:</span>
                            <span class="text-[11px] font-extrabold px-2.5 py-0.5 rounded-full {{ $order->status_pembayaran === 'lunas' ? 'bg-emerald-100 text-emerald-800' : ($order->status_pembayaran === 'menunggu_verifikasi' ? 'bg-amber-100 text-amber-800' : ($order->status_pembayaran === 'ditolak' ? 'bg-rose-100 text-rose-800' : 'bg-gray-200 text-gray-800')) }}">
                                {{ $order->status_pembayaran_label }}
                            </span>
                        </div>

                        @if($order->paymentMethod && $order->paymentMethod->nomor_rekening && $order->tipe_pembayaran !== 'cash')
                        <div class="p-3 rounded-xl bg-white border border-gray-200/80 flex items-center justify-between gap-2">
                            <div>
                                <span class="text-[10px] text-gray-400 uppercase font-bold block">
                                    {{ $order->tipe_pembayaran === 'e_wallet' ? 'No. HP / Akun E-Wallet:' : 'No. Rekening Restoran:' }}
                                </span>
                                <span class="text-sm font-extrabold text-gray-900 font-mono tracking-wider">
                                    {{ $order->paymentMethod->nomor_rekening }}
                                </span>
                                @if($order->paymentMethod->atas_nama)
                                    <span class="text-[11px] text-gray-500 block">a.n. {{ $order->paymentMethod->atas_nama }}</span>
                                @endif
                            </div>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $order->paymentMethod->nomor_rekening }}'); this.innerText='Tersalin!'; setTimeout(()=>this.innerText='Salin', 2000);" class="text-xs font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg border border-amber-200 transition flex-shrink-0 cursor-pointer">
                                Salin
                            </button>
                        </div>
                        @endif

                        @if($order->bukti_pembayaran_url)
                        <div class="pt-2 border-t border-gray-200/60">
                            <span class="text-[11px] font-bold text-gray-500 block mb-1.5">Bukti Transfer (Screenshot):</span>
                            <a href="{{ $order->bukti_pembayaran_url }}" target="_blank" class="inline-block relative group">
                                <img src="{{ $order->bukti_pembayaran_url }}" alt="Bukti Pembayaran" class="h-28 rounded-xl object-contain border border-gray-200 bg-white p-1 group-hover:opacity-90 transition shadow-xs">
                                <span class="block text-[10px] text-amber-600 group-hover:underline font-semibold mt-1">
                                    Lihat Screenshot Lengkap &rarr;
                                </span>
                            </a>
                        </div>
                        @elseif($order->tipe_pembayaran === 'cash')
                        <div class="text-[11px] text-gray-500 bg-white p-2.5 rounded-xl border border-gray-100">
                            Bayar tunai kepada kurir saat makanan tiba di alamat Anda.
                        </div>
                        @endif
                    </div>
                </div>

                @if($order->catatan)
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <span class="text-xs text-gray-400 uppercase font-bold block mb-1">Catatan Anda:</span>
                    <p class="text-xs text-gray-700 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        "{{ $order->catatan }}"
                    </p>
                </div>
                @endif
            </div>

            <!-- Right: Data Pelanggan & Lokasi Pengantaran (Google Maps) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 space-y-6">
                <div>
                    <h3 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 mb-4">
                        Data Pengantaran
                    </h3>

                    <div class="space-y-3 text-xs sm:text-sm">
                        <div>
                            <span class="text-gray-400 text-xs block">Nama Pelanggan</span>
                            <span class="font-bold text-gray-900">{{ $order->nama_pelanggan }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs block">No. Telepon / WhatsApp</span>
                            <span class="font-bold text-gray-900">{{ $order->telepon }}</span>
                        </div>
                        @if($order->email)
                        <div>
                            <span class="text-gray-400 text-xs block">Email</span>
                            <span class="font-bold text-gray-900">{{ $order->email }}</span>
                        </div>
                        @endif
                        <div>
                            <span class="text-gray-400 text-xs block">Alamat Lengkap</span>
                            <p class="font-medium text-gray-800 leading-relaxed mt-0.5">
                                {{ $order->alamat_lengkap }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Preview -->
                @if($order->latitude && $order->longitude)
                <div>
                    <span class="text-xs uppercase tracking-wider text-gray-400 font-bold block mb-2">
                        Titik Lokasi Pengantaran (Google Maps)
                    </span>
                    <div class="h-56 w-full rounded-2xl overflow-hidden border border-gray-200 shadow-inner z-10 bg-gray-100">
                        <iframe
                            src="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}&hl=id&z=16&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="mt-2 text-right">
                        <a href="{{ $order->google_maps_url }}" target="_blank" class="text-xs font-bold text-amber-600 hover:text-amber-700 uppercase inline-flex items-center space-x-1">
                            <span>Buka di Google Maps</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Contact & Action Buttons -->
                <div class="pt-4 border-t border-gray-100 space-y-3">
                    <a href="https://wa.me/6281234567890?text=Halo%20Tasty%20Food,%20saya%20ingin%20menanyakan%20status%20pesanan%20saya%20dengan%20Kode:%20{{ $order->order_code }}"
                       target="_blank"
                       class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl transition flex items-center justify-center space-x-2 shadow">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                        </svg>
                        <span>Tanya Admin via WhatsApp</span>
                    </a>

                    <a href="{{ route('menu') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl transition flex items-center justify-center">
                        Pesan Menu Makanan Lain &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starIcons = document.querySelectorAll('.star-icon');
        const starRadios = document.querySelectorAll('.star-radio');
        const ratingText = document.getElementById('rating-text');
        const ratingDescriptions = {
            1: 'Kurang Puas (1 Bintang)',
            2: 'Cukup (2 Bintang)',
            3: 'Bagus (3 Bintang)',
            4: 'Puas (4 Bintang)',
            5: 'Sangat Puas (5 Bintang)'
        };

        function updateStars(val) {
            starIcons.forEach(icon => {
                const iconVal = parseInt(icon.getAttribute('data-val'));
                if (iconVal <= val) {
                    icon.classList.remove('text-gray-300');
                    icon.classList.add('text-amber-400');
                } else {
                    icon.classList.remove('text-amber-400');
                    icon.classList.add('text-gray-300');
                }
            });
            if (ratingText && ratingDescriptions[val]) {
                ratingText.innerText = ratingDescriptions[val];
            }
        }

        starIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const val = parseInt(this.getAttribute('data-val'));
                starRadios.forEach(radio => {
                    if (parseInt(radio.value) === val) {
                        radio.checked = true;
                    }
                });
                updateStars(val);
            });
        });

        // Initialize with default 5
        updateStars(5);
    });
</script>
@endsection
