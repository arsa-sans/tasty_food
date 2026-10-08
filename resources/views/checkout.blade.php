@extends('layouts.app')

@section('title', 'Checkout Pesanan - Tasty Food')

@section('content')
<!-- Leaflet Map CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">CHECKOUT PESANAN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2">Lengkapi data diri, tentukan titik pengantaran, dan pilih metode pembayaran hidangan Anda.</p>
    </div>
</section>

<!-- Checkout Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($errors->any())
            <div class="mb-8 p-5 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-2xl shadow-sm">
                <div class="font-bold text-sm mb-2 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Mohon lengkapi formulir pemesanan dengan benar:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" id="checkout-form">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left: Form Data Diri, Lokasi & Metode Pembayaran -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- 1. Data Pemesan -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                        <h2 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 mb-6 flex items-center space-x-2">
                            <span class="w-7 h-7 bg-amber-500 text-black rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            <span>Informasi Pemesan</span>
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label for="nama_pelanggan" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $user->name ?? '') }}" required
                                       placeholder="Contoh: Budi Santoso"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="telepon" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                        No. WhatsApp / HP <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}" required
                                           placeholder="Contoh: 081234567890"
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                                    <p class="text-[11px] text-gray-400 mt-1">Kurir akan mengonfirmasi via nomor ini.</p>
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                        Email (Opsional)
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                           placeholder="nama@email.com"
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                                </div>
                            </div>

                            <div>
                                <label for="catatan" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                    Catatan untuk Dapur / Pesanan (Opsional)
                                </label>
                                <textarea id="catatan" name="catatan" rows="2"
                                          placeholder="Contoh: Sambal dipisah, jangan pakai daun bawang, atau titip di pos satpam."
                                          class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Alamat & Titik Google Maps -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                        <h2 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 mb-6 flex items-center space-x-2">
                            <span class="w-7 h-7 bg-amber-500 text-black rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            <span>Alamat & Titik Pengantaran (Google Maps)</span>
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label for="alamat_lengkap" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                                    Alamat Lengkap Pengantaran <span class="text-rose-500">*</span>
                                </label>
                                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" required
                                          placeholder="Jl. Merdeka No. 45, RT 02 / RW 05, Kelurahan, Kecamatan, Kota (cantumkan patokan gedung/rumah)"
                                          class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">{{ old('alamat_lengkap') }}</textarea>
                            </div>

                            <!-- Map Picker Container -->
                            <div>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2 gap-2">
                                    <label class="block text-xs font-bold text-gray-700 uppercase">
                                        Tentukan Titik Peta Lokasi Anda
                                    </label>
                                    <button type="button" id="btn-detect-location" class="inline-flex items-center space-x-1 text-xs text-amber-600 hover:text-amber-700 font-bold uppercase transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Gunakan Lokasi Saya (GPS)</span>
                                    </button>
                                </div>

                                <p class="text-[11px] text-gray-500 mb-3">
                                    Klik atau geser pin pada peta di bawah ini untuk menentukan titik pengantaran akurat bagi kurir.
                                </p>

                                <!-- Leaflet Map Box -->
                                <div id="map-picker" class="h-64 sm:h-80 w-full rounded-2xl overflow-hidden border border-gray-200 shadow-inner z-10"></div>

                                <!-- Coordinates Preview & Google Maps Direct Link -->
                                <div class="mt-3 flex flex-wrap items-center justify-between text-xs text-gray-500 bg-gray-50 p-3 rounded-xl border border-gray-100 gap-2">
                                    <div>
                                        <span class="font-bold text-gray-700">Koordinat: </span>
                                        <span id="coords-display">-6.2088, 106.8456</span>
                                    </div>
                                    <a id="gmaps-preview-link" href="https://www.google.com/maps?q=-6.2088,106.8456" target="_blank" class="text-amber-600 hover:underline font-bold inline-flex items-center space-x-1">
                                        <span>Buka di Google Maps &rarr;</span>
                                    </a>
                                </div>

                                <!-- Hidden Inputs for Coordinates -->
                                <input type="hidden" name="latitude" id="input-lat" value="{{ old('latitude', -6.2088) }}">
                                <input type="hidden" name="longitude" id="input-lng" value="{{ old('longitude', 106.8456) }}">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Metode Pembayaran & Upload Bukti Transfer -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100">
                        <h2 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 mb-6 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-7 h-7 bg-amber-500 text-black rounded-full flex items-center justify-center text-xs font-bold">3</span>
                                <span>Metode Pembayaran</span>
                            </div>
                            <span class="text-xs font-semibold text-rose-500">* Wajib Dipilih</span>
                        </h2>

                        <!-- List of Active Payment Methods -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6" id="payment-methods-container">
                            @forelse($paymentMethods as $index => $pm)
                                <label class="payment-method-card relative flex items-start p-4 rounded-2xl border-2 cursor-pointer transition select-none {{ old('payment_method_id', $index === 0 ? $pm->id : '') == $pm->id ? 'border-amber-500 bg-amber-50/40 ring-1 ring-amber-500' : 'border-gray-200 hover:border-gray-300 bg-gray-50/60' }}"
                                       data-id="{{ $pm->id }}"
                                       data-tipe="{{ $pm->tipe }}"
                                       data-nama="{{ $pm->nama }}"
                                       data-norek="{{ $pm->nomor_rekening }}"
                                       data-atas-nama="{{ $pm->atas_nama }}"
                                       data-instruksi="{{ $pm->instruksi }}"
                                       data-gambar="{{ $pm->gambar_url }}">
                                    <input type="radio" name="payment_method_id" value="{{ $pm->id }}" class="sr-only payment-radio"
                                           {{ old('payment_method_id', $index === 0 ? $pm->id : '') == $pm->id ? 'checked' : '' }} required>

                                    <!-- Icon / Image -->
                                    <div class="w-12 h-12 rounded-xl flex-shrink-0 bg-white border border-gray-200 p-1 flex items-center justify-center mr-3 shadow-xs">
                                        @if($pm->gambar_url)
                                            <img src="{{ $pm->gambar_url }}" alt="{{ $pm->nama }}" class="w-full h-full object-contain rounded-lg">
                                        @elseif($pm->tipe === 'cash')
                                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        @elseif($pm->tipe === 'e_wallet')
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        @endif
                                    </div>

                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-xs sm:text-sm text-gray-900 truncate">{{ $pm->nama }}</span>
                                            <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full {{ $pm->tipe === 'cash' ? 'bg-amber-100 text-amber-800' : ($pm->tipe === 'e_wallet' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800') }}">
                                                {{ $pm->tipe_label }}
                                            </span>
                                        </div>
                                        @if($pm->nomor_rekening)
                                            <p class="text-[11px] text-gray-600 font-mono mt-0.5 truncate">{{ $pm->nomor_rekening }}</p>
                                        @else
                                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $pm->tipe === 'cash' ? 'Bayar Tunai saat pesanan tiba' : 'Scan QRIS / Transfer' }}</p>
                                        @endif
                                    </div>
                                </label>
                            @empty
                                <div class="col-span-2 text-center py-4 text-xs text-gray-500">
                                    Belum ada metode pembayaran yang aktif. Mohon hubungi admin.
                                </div>
                            @endforelse
                        </div>

                        <!-- Detail Petunjuk & Preview Gambar QRIS (Dinamis Sesuai Pilihan) -->
                        <div id="payment-instruction-box" class="p-5 rounded-2xl bg-amber-50/50 border border-amber-200/80 mb-6 space-y-4">
                            <!-- QRIS Image Showcase (if present) -->
                            <div id="qris-display-container" class="hidden flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-xl border border-amber-200">
                                <div class="flex-shrink-0 text-center">
                                    <img id="qris-image-preview" src="" alt="Barcode QRIS" class="w-40 h-40 object-contain rounded-lg border p-1 bg-white shadow-xs mx-auto">
                                    <span class="block text-[11px] font-bold text-gray-500 mt-1 uppercase">Scan QRIS</span>
                                </div>
                                <div class="space-y-1.5 text-xs text-gray-700">
                                    <h4 class="font-extrabold text-sm text-gray-900" id="qris-title">QRIS Pembayaran</h4>
                                    <p class="text-[11px] text-gray-600">Scan QRIS di samping menggunakan aplikasi m-Banking (BCA, Mandiri, BRI, dll) atau E-Wallet (GoPay, OVO, Dana, ShopeePay).</p>
                                    <p class="text-[11px] font-semibold text-amber-700">Setelah transfer sukses, tangkap layar (screenshot) bukti pembayaran Anda.</p>
                                </div>
                            </div>

                            <!-- Nomor Rekening / HP / Akun Info Card (Bank & E-Wallet) -->
                            <div id="account-display-container" class="hidden bg-white p-4 rounded-xl border border-amber-200 space-y-2">
                                <div class="text-xs text-gray-500 uppercase font-semibold" id="account-type-label">Tujuan Rekening Restoran:</div>
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <div>
                                        <div class="font-extrabold text-sm sm:text-base text-gray-900 font-mono tracking-wider" id="account-norek">-</div>
                                        <div class="text-xs text-gray-600" id="account-atasnama">a.n. Tasty Food</div>
                                    </div>
                                    <button type="button" id="btn-copy-account" class="text-xs font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg border border-amber-200 transition">
                                        Salin No. Rekening
                                    </button>
                                </div>
                            </div>

                            <!-- Instruksi Teks Tambahan -->
                            <div id="text-instruction-container" class="text-xs text-gray-700 leading-relaxed">
                                <p id="text-instruction" class="text-xs text-gray-600"></p>
                            </div>

                            <!-- Catatan Khusus COD -->
                            <div id="cash-note-container" class="hidden flex items-center space-x-3 text-xs text-emerald-800 bg-emerald-50 p-3 rounded-xl border border-emerald-200">
                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Anda memilih <strong>Cash on Delivery (Bayar di Tempat)</strong>. Siapkan uang pas saat kurir mengantarkan pesanan ke alamat Anda. Tidak perlu mengunggah bukti pembayaran.</span>
                            </div>
                        </div>

                        <!-- Upload Screenshot Bukti Transfer (Wajib untuk E-Wallet & Bank) -->
                        <div id="proof-upload-section" class="pt-2">
                            <label class="block text-xs font-bold text-gray-800 uppercase mb-2">
                                Upload Bukti Pembayaran (Screenshot) <span class="text-rose-500" id="proof-required-asterisk">*</span>
                            </label>
                            
                            <div id="proof-dropzone" class="border-2 border-dashed border-gray-300 hover:border-amber-500 bg-gray-50/80 hover:bg-amber-50/20 rounded-2xl p-6 text-center cursor-pointer transition" onclick="document.getElementById('bukti_pembayaran').click()">
                                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" onchange="handleProofSelect(this)">
                                
                                <div id="proof-placeholder">
                                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-xs sm:text-sm font-bold text-gray-800">Klik di sini untuk upload foto screenshot bukti transfer</p>
                                    <p class="text-[11px] text-gray-500 mt-1">Format gambar: JPG, PNG, WEBP (Maksimal 5MB)</p>
                                </div>

                                <div id="proof-preview-box" class="hidden space-y-2">
                                    <img id="proof-preview-img" src="#" alt="Screenshot Bukti Pembayaran" class="max-h-56 mx-auto rounded-xl shadow-md border border-gray-200 object-contain">
                                    <div class="flex items-center justify-center space-x-2 text-xs font-bold text-emerald-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span id="proof-filename">bukti_transfer.jpg</span>
                                    </div>
                                    <button type="button" class="text-[11px] text-amber-600 hover:underline font-semibold" onclick="document.getElementById('bukti_pembayaran').click(); event.stopPropagation();">
                                        Ganti Foto Bukti Pembayaran
                                    </button>
                                </div>
                            </div>

                            @error('bukti_pembayaran')
                                <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-[11px] text-gray-400 mt-2" id="proof-help-text">
                                * Khusus metode QRIS / E-Wallet dan Bank Transfer, bukti transfer wajib dilampirkan agar pesanan dapat segera diverifikasi oleh tim restoran.
                            </p>
                        </div>

                    </div>

                </div>

                <!-- Right: Ringkasan Pesanan & Tombol Konfirmasi -->
                <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 sticky top-6">
                    <h2 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 flex items-center space-x-2">
                        <span class="w-7 h-7 bg-amber-500 text-black rounded-full flex items-center justify-center text-xs font-bold">4</span>
                        <span>Ringkasan Pesanan</span>
                    </h2>

                    <!-- Item list -->
                    <div class="py-4 divide-y divide-gray-100 max-h-64 overflow-y-auto">
                        @foreach($cart as $item)
                        <div class="py-3 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['nama'] }}" class="w-12 h-12 rounded-xl object-cover flex-shrink-0">
                                <div>
                                    <h4 class="font-bold text-xs sm:text-sm text-gray-800 line-clamp-1">{{ $item['nama'] }}</h4>
                                    <p class="text-[11px] text-gray-500">{{ $item['quantity'] }}x @ Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <span class="font-extrabold text-xs sm:text-sm text-gray-900">
                                Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Total Price Calculation -->
                    <div class="pt-4 border-t border-gray-100 space-y-2 text-xs sm:text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Menu</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="font-semibold text-emerald-600">GRATIS</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Metode Pembayaran</span>
                            <span class="font-bold text-amber-700" id="summary-payment-name">-</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-sm font-extrabold text-gray-900 uppercase">Total Pembayaran</span>
                            <span class="text-xl font-extrabold text-amber-600">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit" id="btn-submit-order" class="w-full bg-black hover:bg-neutral-800 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider py-4 px-6 rounded-2xl transition flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl cursor-pointer">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Konfirmasi & Kirim Pesanan</span>
                        </button>
                        <p class="text-[11px] text-gray-400 text-center mt-3">
                            Setelah dikonfirmasi, Anda akan dialihkan ke halaman pelacakan status pesanan secara real-time.
                        </p>
                    </div>
                </div>
            </div>

        </form>

    </div>
</section>

<!-- Leaflet Map JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // Preview Screenshot Bukti Pembayaran
    function handleProofSelect(input) {
        const placeholder = document.getElementById('proof-placeholder');
        const previewBox = document.getElementById('proof-preview-box');
        const previewImg = document.getElementById('proof-preview-img');
        const filenameLabel = document.getElementById('proof-filename');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            filenameLabel.innerText = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                placeholder.classList.add('hidden');
                previewBox.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            placeholder.classList.remove('hidden');
            previewBox.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. LEAFLET MAP PICKER ---
        const defaultLat = parseFloat(document.getElementById('input-lat').value) || -6.2088;
        const defaultLng = parseFloat(document.getElementById('input-lng').value) || 106.8456;

        const map = L.map('map-picker').setView([defaultLat, defaultLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        function updateCoords(lat, lng) {
            document.getElementById('input-lat').value = lat.toFixed(7);
            document.getElementById('input-lng').value = lng.toFixed(7);
            document.getElementById('coords-display').innerText = lat.toFixed(5) + ', ' + lng.toFixed(5);
            document.getElementById('gmaps-preview-link').href = 'https://www.google.com/maps?q=' + lat.toFixed(7) + ',' + lng.toFixed(7);
        }

        marker.on('dragend', function(e) {
            const pos = marker.getLatLng();
            updateCoords(pos.lat, pos.lng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng);
        });

        const btnDetect = document.getElementById('btn-detect-location');
        if (btnDetect && navigator.geolocation) {
            btnDetect.addEventListener('click', function() {
                btnDetect.innerText = 'Mendeteksi...';
                navigator.geolocation.getCurrentPosition(function(pos) {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    map.setView([lat, lng], 16);
                    marker.setLatLng([lat, lng]);
                    updateCoords(lat, lng);
                    btnDetect.innerHTML = '<span class="text-emerald-600">✓ Lokasi Ditemukan</span>';
                }, function(err) {
                    alert('Tidak dapat mendeteksi lokasi GPS Anda. Silakan tentukan titik langsung di peta.');
                    btnDetect.innerText = 'Gunakan Lokasi Saya (GPS)';
                }, { enableHighAccuracy: true });
            });
        }

        // --- 2. PAYMENT METHODS INTERACTIVE LOGIC ---
        const paymentCards = document.querySelectorAll('.payment-method-card');
        const qrisContainer = document.getElementById('qris-display-container');
        const qrisImg = document.getElementById('qris-image-preview');
        const qrisTitle = document.getElementById('qris-title');
        const accountContainer = document.getElementById('account-display-container');
        const accountNorek = document.getElementById('account-norek');
        const accountAtasNama = document.getElementById('account-atasnama');
        const accountTypeLabel = document.getElementById('account-type-label');
        const textInstruction = document.getElementById('text-instruction');
        const textInstructionContainer = document.getElementById('text-instruction-container');
        const cashNoteContainer = document.getElementById('cash-note-container');
        const proofSection = document.getElementById('proof-upload-section');
        const proofInput = document.getElementById('bukti_pembayaran');
        const proofAsterisk = document.getElementById('proof-required-asterisk');
        const summaryPaymentName = document.getElementById('summary-payment-name');
        const btnCopyAccount = document.getElementById('btn-copy-account');

        function selectPaymentMethod(card) {
            paymentCards.forEach(c => {
                c.classList.remove('border-amber-500', 'bg-amber-50/40', 'ring-1', 'ring-amber-500');
                c.classList.add('border-gray-200', 'bg-gray-50/60');
                const r = c.querySelector('input[type="radio"]');
                if (r) r.checked = false;
            });

            card.classList.remove('border-gray-200', 'bg-gray-50/60');
            card.classList.add('border-amber-500', 'bg-amber-50/40', 'ring-1', 'ring-amber-500');
            const radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            const tipe = card.dataset.tipe;
            const nama = card.dataset.nama;
            const norek = card.dataset.norek;
            const atasNama = card.dataset.atasNama;
            const instruksi = card.dataset.instruksi;
            const gambar = card.dataset.gambar;

            summaryPaymentName.innerText = nama;

            // QRIS / Gambar Barcode
            if (gambar && tipe !== 'cash') {
                qrisImg.src = gambar;
                qrisTitle.innerText = nama;
                qrisContainer.classList.remove('hidden');
            } else {
                qrisContainer.classList.add('hidden');
            }

            // Nomor Rekening / Nomor HP Card dengan Fitur Salin
            // Muncul untuk Bank maupun E-Wallet JIKA admin mengisi nomor rekening/HP (norek ada & tidak kosong)
            // Jika admin TIDAK mengisi nomor rekening/HP, fitur menyalin ini TIDAK akan muncul
            const hasNorek = norek && norek.trim() !== '' && norek.trim() !== '-';
            if (hasNorek && tipe !== 'cash') {
                accountNorek.innerText = norek;

                if (atasNama && atasNama.trim() !== '') {
                    accountAtasNama.innerText = 'a.n. ' + atasNama;
                    accountAtasNama.classList.remove('hidden');
                } else {
                    accountAtasNama.classList.add('hidden');
                }

                if (tipe === 'e_wallet') {
                    if (accountTypeLabel) accountTypeLabel.innerText = 'Tujuan Nomor HP / Akun E-Wallet:';
                    if (btnCopyAccount) btnCopyAccount.innerText = 'Salin Nomor HP / Akun';
                } else {
                    if (accountTypeLabel) accountTypeLabel.innerText = 'Tujuan Rekening Restoran:';
                    if (btnCopyAccount) btnCopyAccount.innerText = 'Salin No. Rekening';
                }

                accountContainer.classList.remove('hidden');
            } else {
                accountContainer.classList.add('hidden');
            }

            // Text Instruction
            if (instruksi && instruksi.trim() !== '') {
                textInstruction.innerText = instruksi;
                textInstructionContainer.classList.remove('hidden');
            } else {
                textInstructionContainer.classList.add('hidden');
            }

            // Cash COD vs Transfer/E-Wallet
            if (tipe === 'cash') {
                cashNoteContainer.classList.remove('hidden');
                proofSection.classList.add('hidden');
                proofInput.removeAttribute('required');
            } else {
                cashNoteContainer.classList.add('hidden');
                proofSection.classList.remove('hidden');
                proofInput.setAttribute('required', 'required');
            }
        }

        // Add click events to payment cards
        paymentCards.forEach(card => {
            card.addEventListener('click', function() {
                selectPaymentMethod(this);
            });
        });

        // Initialize with default or old selection
        const initialSelectedCard = document.querySelector('.payment-method-card input[type="radio"]:checked')?.closest('.payment-method-card') || paymentCards[0];
        if (initialSelectedCard) {
            selectPaymentMethod(initialSelectedCard);
        }

        // Copy Account Number / Phone Number button
        if (btnCopyAccount) {
            btnCopyAccount.addEventListener('click', function() {
                const text = accountNorek.innerText.trim();
                if (!text || text === '-') return;

                function showSuccess() {
                    const originalText = btnCopyAccount.innerText;
                    btnCopyAccount.innerHTML = '<span class="text-emerald-600 font-bold">✓ Tersalin!</span>';
                    btnCopyAccount.classList.add('bg-emerald-50', 'border-emerald-300');
                    setTimeout(() => {
                        btnCopyAccount.innerText = originalText;
                        btnCopyAccount.classList.remove('bg-emerald-50', 'border-emerald-300');
                    }, 2000);
                }

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(showSuccess).catch(() => {
                        fallbackCopy(text);
                    });
                } else {
                    fallbackCopy(text);
                }

                function fallbackCopy(val) {
                    const textarea = document.createElement('textarea');
                    textarea.value = val;
                    textarea.style.position = 'fixed';
                    textarea.style.opacity = '0';
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                        document.execCommand('copy');
                        showSuccess();
                    } catch (e) {
                        alert('Nomor rekening/HP: ' + val);
                    }
                    document.body.removeChild(textarea);
                }
            });
        }
    });
</script>
@endsection
