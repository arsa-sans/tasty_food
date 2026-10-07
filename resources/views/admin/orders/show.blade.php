@extends('layouts.kaiadmin')

@section('title', 'Detail Pesanan ' . $order->order_code)
@section('page-title', 'Detail Pesanan: ' . $order->order_code)
@section('page-subtitle', 'Kelola proses pembuatan makanan, penugasan kurir pengantar, dan perbarui status ke pelanggan')

@section('breadcrumbs')
<div class="btn-group">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-round btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
</div>
@endsection

@section('content')
<!-- Leaflet Map CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<div class="row">
    <!-- Left Column: Order Items & Delivery Location -->
    <div class="col-lg-8">
        <!-- Card Ordered Items -->
        <div class="card card-round shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-utensils text-primary me-2"></i> Menu yang Dipesan
                </h5>
                <span class="badge bg-secondary">{{ $order->items->count() }} Macam Menu</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Menu Makanan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->menu)
                                            <img src="{{ $item->menu->image_url }}" alt="{{ $item->nama_menu }}" class="rounded-3 shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->nama_menu }}</div>
                                            @if($item->menu)
                                                <small class="text-muted">{{ $item->menu->kategori }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold">{{ $item->jumlah }} porsi</td>
                                <td class="text-end">{{ $item->formatted_harga }}</td>
                                <td class="text-end fw-bold text-dark">{{ $item->formatted_subtotal }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold text-uppercase">Total Pembayaran:</td>
                                <td class="text-end fw-bold fs-5 text-success">{{ $order->formatted_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if($order->catatan)
            <div class="card-footer bg-light border-top">
                <small class="text-muted fw-bold d-block text-uppercase mb-1">Catatan Khusus dari Pelanggan:</small>
                <div class="p-2 bg-white rounded border text-dark font-italic">
                    "{{ $order->catatan }}"
                </div>
            </div>
            @endif
        </div>

        <!-- Card Alamat & Peta Google Maps -->
        <div class="card card-round shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-map-marked-alt text-danger me-2"></i> Lokasi Pengantaran (Google Maps)
                </h5>
                @if($order->latitude && $order->longitude)
                    <a href="{{ $order->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-directions me-1"></i> Buka Rute di Google Maps
                    </a>
                @endif
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold text-muted small text-uppercase d-block mb-1">Alamat Lengkap Tujuan:</label>
                    <p class="fs-6 text-dark bg-light p-3 rounded border mb-0">
                        {{ $order->alamat_lengkap }}
                    </p>
                </div>

                @if($order->latitude && $order->longitude)
                    <div class="mb-2">
                        <label class="fw-bold text-muted small text-uppercase d-block mb-1">
                            Titik Koordinat Presisi: <span class="text-dark">{{ $order->latitude }}, {{ $order->longitude }}</span>
                        </label>
                        <div id="admin-order-map" class="rounded-3 border shadow-sm" style="height: 280px; width: 100%;"></div>
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        <i class="fas fa-info-circle me-1"></i> Pelanggan tidak menyertakan koordinat GPS pin point. Pengantaran berpedoman pada teks alamat lengkap di atas.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Status Update & Customer Information -->
    <div class="col-lg-4">
        <!-- Card Update Status (Core Requirement) -->
        <div class="card card-round shadow-sm border-2 border-primary mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title fw-bold text-white mb-0">
                    <i class="fas fa-tasks me-2"></i> Perbarui Status Pesanan
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Current Status Display -->
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase d-block">Status Saat Ini:</label>
                        <span class="badge {{ $order->status_badge_class }} fs-6 px-3 py-2">
                            {{ $order->status_label }}
                        </span>
                    </div>

                    <!-- Status Selector -->
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Pilih Status Baru:</label>
                        <select name="status" id="status" class="form-select form-select-lg" onchange="autoFillKeterangan(this.value)">
                            <option value="menunggu_konfirmasi" {{ $order->status === 'menunggu_konfirmasi' ? 'selected' : '' }}>
                                1. Menunggu Konfirmasi
                            </option>
                            <option value="dikonfirmasi" {{ $order->status === 'dikonfirmasi' ? 'selected' : '' }}>
                                2. Dikonfirmasi Restoran
                            </option>
                            <option value="sedang_dimasak" {{ $order->status === 'sedang_dimasak' ? 'selected' : '' }}>
                                3. Sedang Dimasak / Dibuat
                            </option>
                            <option value="dalam_pengiriman" {{ $order->status === 'dalam_pengiriman' ? 'selected' : '' }}>
                                4. Dalam Pengiriman (Diantar Kurir)
                            </option>
                            <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>
                                5. Selesai (Telah Sampai ke Pelanggan)
                            </option>
                            <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>
                                6. Dibatalkan
                            </option>
                        </select>
                    </div>

                    <!-- Keterangan Admin untuk Pelanggan -->
                    <div class="mb-4">
                        <label for="keterangan_admin" class="form-label fw-bold">Keterangan untuk Pelanggan:</label>
                        <textarea name="keterangan_admin" id="keterangan_admin" rows="4" class="form-control" placeholder="Tuliskan keterangan detail pesanan...">{{ old('keterangan_admin', $order->keterangan_admin) }}</textarea>
                        <small class="text-muted">Keterangan ini akan tampil langsung di halaman pelacakan pelanggan secara real-time.</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="fas fa-check-circle me-1"></i> Simpan & Perbarui Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Card Konfirmasi Penerimaan & Rating Pelanggan -->
        @if($order->is_diterima)
        <div class="card card-round shadow-sm border-2 border-success mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title fw-bold text-white mb-0">
                    <i class="fas fa-check-double me-2"></i> Konfirmasi Diterima Pelanggan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-success fs-6 me-2">
                        <i class="fas fa-check me-1"></i> Pesanan Diterima
                    </span>
                    <small class="text-muted">
                        {{ $order->diterima_at ? $order->diterima_at->format('d/m/Y H:i') : '-' }} WIB
                    </small>
                </div>

                <div class="mb-3">
                    <label class="fw-bold small text-muted text-uppercase d-block mb-1">Rating dari Pelanggan:</label>
                    <div class="fs-4 text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $order->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        @endfor
                        <span class="fs-6 text-dark fw-bold ms-2">({{ $order->rating }} / 5 Bintang)</span>
                    </div>
                </div>

                @if($order->ulasan)
                <div>
                    <label class="fw-bold small text-muted text-uppercase d-block mb-1">Ulasan / Testimoni Pelanggan:</label>
                    <div class="p-3 bg-light rounded-3 border text-dark font-italic">
                        "{{ $order->ulasan }}"
                    </div>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="card card-round shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-clock fa-2x text-warning me-3"></i>
                    <div>
                        <strong class="text-dark d-block">Menunggu Konfirmasi Pelanggan</strong>
                        <small class="text-muted">Pelanggan belum mengonfirmasi penerimaan atau memberikan rating.</small>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Card Data Pelanggan -->
        <div class="card card-round shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-user text-secondary me-2"></i> Data Pelanggan
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="text-muted small d-block">Nama Lengkap</span>
                    <strong class="fs-6 text-dark">{{ $order->nama_pelanggan }}</strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted small d-block">No. Telepon / WhatsApp</span>
                    <strong class="text-dark d-block mb-1">{{ $order->telepon }}</strong>
                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $order->telepon);
                        if (\Illuminate\Support\Str::startsWith($cleanPhone, '0')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($order->nama_pelanggan) }},%20kami%20dari%20restoran%20Tasty%20Food%20mengenai%20pesanan%20Anda%20dengan%20Kode%20{{ $order->order_code }}." target="_blank" class="btn btn-sm btn-success w-100">
                        <i class="fab fa-whatsapp me-1"></i> Chat WhatsApp Pelanggan
                    </a>
                </div>

                @if($order->email)
                <div class="mb-3">
                    <span class="text-muted small d-block">Email</span>
                    <span class="text-dark">{{ $order->email }}</span>
                </div>
                @endif

                <div>
                    <span class="text-muted small d-block">Waktu Pemesanan</span>
                    <span class="text-dark">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>
</div>

@if($order->latitude && $order->longitude)
<!-- Leaflet Map JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const lat = {{ $order->latitude }};
    const lng = {{ $order->longitude }};
    const map = L.map('admin-order-map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    L.marker([lat, lng]).addTo(map).bindPopup('<b>Tujuan Pengantaran:</b><br>{{ addslashes($order->nama_pelanggan) }}<br>{{ addslashes($order->alamat_lengkap) }}').openPopup();
});
</script>
@endif

<script>
function autoFillKeterangan(status) {
    const ketInput = document.getElementById('keterangan_admin');
    const templates = {
        'menunggu_konfirmasi': 'Pesanan baru diterima. Menunggu konfirmasi dari pihak restoran.',
        'dikonfirmasi': 'Pesanan telah dikonfirmasi oleh restoran dan masuk dalam antrean dapur.',
        'sedang_dimasak': 'Makanan sedang disiapkan dan dimasak oleh koki dapur kami dengan bahan-bahan segar.',
        'dalam_pengiriman': 'Makanan selesai dimasak dan sedang dalam perjalanan diantar oleh kurir ke lokasi Anda.',
        'selesai': 'Pesanan telah sampai dan diterima dengan baik oleh pelanggan. Selamat menikmati hidangan!',
        'dibatalkan': 'Mohon maaf, pesanan ini dibatalkan oleh pihak restoran.'
    };
    if (templates[status]) {
        ketInput.value = templates[status];
    }
}
</script>
@endsection
