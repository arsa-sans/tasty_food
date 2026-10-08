@extends('layouts.kaiadmin')

@section('title', 'Tambah Metode Pembayaran')
@section('page-title', 'Tambah Metode Pembayaran')
@section('page-subtitle', 'Tambahkan metode pembayaran baru seperti Cash (COD), QRIS / E-Wallet, atau Bank')

@section('breadcrumbs')
<a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary btn-round">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card card-round shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">Form Tambah Metode Pembayaran</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="alert alert-info py-2 px-3 small mb-4">
                        <i class="fas fa-info-circle me-1"></i> <strong>Catatan:</strong> Hanya <strong>Nama Metode</strong> dan <strong>Jenis / Tipe Pembayaran</strong> yang wajib diisi. Kolom nomor rekening, atas nama, instruksi, dan foto/gambar QR bersifat opsional.
                    </div>

                    <!-- Tipe Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis / Tipe Pembayaran <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="card card-body p-3 border rounded text-center cursor-pointer h-100 tipe-option" id="tipe-cash-card">
                                    <input type="radio" name="tipe" value="cash" class="d-none" {{ old('tipe', 'cash') === 'cash' ? 'checked' : '' }} onchange="updateTipeHelp('cash')">
                                    <i class="fas fa-money-bill-wave fa-2x text-warning mb-2"></i>
                                    <div class="fw-bold">Cash (COD)</div>
                                    <small class="text-muted">Bayar di Tempat</small>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="card card-body p-3 border rounded text-center cursor-pointer h-100 tipe-option" id="tipe-ewallet-card">
                                    <input type="radio" name="tipe" value="e_wallet" class="d-none" {{ old('tipe') === 'e_wallet' ? 'checked' : '' }} onchange="updateTipeHelp('e_wallet')">
                                    <i class="fas fa-qrcode fa-2x text-primary mb-2"></i>
                                    <div class="fw-bold">E-Wallet / QRIS</div>
                                    <small class="text-muted">QRIS, GoPay, OVO, dll</small>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="card card-body p-3 border rounded text-center cursor-pointer h-100 tipe-option" id="tipe-bank-card">
                                    <input type="radio" name="tipe" value="bank" class="d-none" {{ old('tipe') === 'bank' ? 'checked' : '' }} onchange="updateTipeHelp('bank')">
                                    <i class="fas fa-university fa-2x text-success mb-2"></i>
                                    <div class="fw-bold">Transfer Bank</div>
                                    <small class="text-muted">BCA, Mandiri, BRI, dll</small>
                                </label>
                            </div>
                        </div>
                        @error('tipe')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Metode Pembayaran -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Metode Pembayaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: QRIS Tasty Food / Bank BCA / COD">
                        <small class="text-muted">Nama yang akan tampil pada pilihan pembayaran pelanggan di checkout.</small>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Nomor Rekening / Nomor E-Wallet -->
                        <div class="col-md-6 mb-3">
                            <label for="nomor_rekening" class="form-label fw-bold">Nomor Rekening / No. HP / Akun <span class="badge bg-light text-muted border fw-normal"></span></label>
                            <input type="text" class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening" name="nomor_rekening" value="{{ old('nomor_rekening') }}" placeholder="Contoh: 1234567890 / 08123456789">
                            <small class="text-muted">Nomor rekening tujuan transfer jika menggunakan Bank atau E-Wallet.</small>
                            @error('nomor_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Atas Nama -->
                        <div class="col-md-6 mb-3">
                            <label for="atas_nama" class="form-label fw-bold">Atas Nama Penerima <span class="badge bg-light text-muted border fw-normal"></span></label>
                            <input type="text" class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama" name="atas_nama" value="{{ old('atas_nama') }}" placeholder="Contoh: Tasty Food Resto / PT Rasa Enak">
                            <small class="text-muted">Nama pemilik rekening / akun penerima.</small>
                            @error('atas_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Upload Foto / QR Code -->
                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-bold">Foto / Barcode QRIS / Logo <span class="badge bg-light text-muted border fw-normal"></span></label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewPaymentImage(this)">
                        <small class="text-muted d-block mt-1">Upload gambar QRIS (barcode scan) atau logo bank. Format: JPG, PNG, WEBP. Maksimal 3MB.</small>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-3 d-none" id="preview-wrapper">
                            <p class="small text-muted mb-1">Pratinjau Foto/QR:</p>
                            <img id="preview-img" src="#" alt="Preview QR" class="rounded border p-2 bg-white shadow-sm" style="max-height: 220px; max-width: 260px; object-fit: contain;">
                        </div>
                    </div>

                    <!-- Petunjuk / Instruksi Pembayaran -->
                    <div class="mb-3">
                        <label for="instruksi" class="form-label fw-bold">Instruksi Pembayaran <span class="badge bg-light text-muted border fw-normal"></span></label>
                        <textarea class="form-control @error('instruksi') is-invalid @enderror" id="instruksi" name="instruksi" rows="3" placeholder="Contoh: Buka aplikasi mobile banking atau e-wallet Anda, scan QRIS di atas lalu masukkan nominal pesanan. Jangan lupa simpan tangkapan layar bukti bayar.">{{ old('instruksi') }}</textarea>
                        <small class="text-muted">Petunjuk langkah demi langkah yang akan dibaca pelanggan saat memilih metode ini.</small>
                        @error('instruksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_aktif" name="is_aktif" value="1" {{ old('is_aktif', 1) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_aktif">Aktifkan Metode Pembayaran ini di Checkout</label>
                        <small class="text-muted d-block">Jika diaktifkan, pelanggan dapat langsung memilih metode pembayaran ini di halaman checkout.</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Metode Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.cursor-pointer { cursor: pointer; }
.tipe-option.active {
    border-color: #0d6efd !important;
    background-color: #f0f7ff !important;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
}
</style>

<script>
function updateTipeHelp(tipe) {
    document.querySelectorAll('.tipe-option').forEach(el => el.classList.remove('active'));
    if (tipe === 'cash') {
        document.getElementById('tipe-cash-card')?.classList.add('active');
    } else if (tipe === 'e_wallet') {
        document.getElementById('tipe-ewallet-card')?.classList.add('active');
    } else if (tipe === 'bank') {
        document.getElementById('tipe-bank-card')?.classList.add('active');
    }
}

function previewPaymentImage(input) {
    const previewWrapper = document.getElementById('preview-wrapper');
    const previewImg = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewWrapper.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewWrapper.classList.add('d-none');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const checkedRadio = document.querySelector('input[name="tipe"]:checked');
    if (checkedRadio) {
        updateTipeHelp(checkedRadio.value);
    }
});
</script>
@endsection
