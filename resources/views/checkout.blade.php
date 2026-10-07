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
        <p class="text-gray-300 text-xs sm:text-sm mt-2">Lengkapi data diri dan tentukan titik lokasi pengantaran untuk konfirmasi pemesanan hidangan Anda.</p>
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
                    <span>Mohon lengkapi data dengan benar:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left: Form Data Diri & Lokasi -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- Data Pemesan -->
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
                                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required
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
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
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

                    <!-- Alamat & Titik Google Maps -->
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

                </div>

                <!-- Right: Ringkasan Pesanan & Tombol Konfirmasi -->
                <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 sticky top-6">
                    <h2 class="text-base sm:text-lg font-extrabold text-gray-900 uppercase pb-4 border-b border-gray-100 flex items-center space-x-2">
                        <span class="w-7 h-7 bg-amber-500 text-black rounded-full flex items-center justify-center text-xs font-bold">3</span>
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
                            <span class="font-semibold text-gray-800">Bayar di Tempat (COD) / Transfer</span>
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
                        <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider py-4 px-6 rounded-2xl transition flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl">
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
    document.addEventListener('DOMContentLoaded', function() {
        const defaultLat = parseFloat(document.getElementById('input-lat').value) || -6.2088;
        const defaultLng = parseFloat(document.getElementById('input-lng').value) || 106.8456;

        // Initialize map
        const map = L.map('map-picker').setView([defaultLat, defaultLng], 14);

        // OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Draggable Marker
        let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        function updateCoords(lat, lng) {
            document.getElementById('input-lat').value = lat.toFixed(7);
            document.getElementById('input-lng').value = lng.toFixed(7);
            document.getElementById('coords-display').innerText = lat.toFixed(5) + ', ' + lng.toFixed(5);
            document.getElementById('gmaps-preview-link').href = 'https://www.google.com/maps?q=' + lat.toFixed(7) + ',' + lng.toFixed(7);
        }

        // Marker drag event
        marker.on('dragend', function(e) {
            const pos = marker.getLatLng();
            updateCoords(pos.lat, pos.lng);
        });

        // Map click event
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng);
        });

        // Geolocation / GPS Button
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
    });
</script>
@endsection
