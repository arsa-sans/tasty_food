@extends('layouts.kaiadmin')

@section('title', 'Metode Pembayaran')
@section('page-title', 'Metode Pembayaran')
@section('page-subtitle', 'Kelola metode pembayaran seperti Cash On Delivery (COD), E-Wallet (QRIS), dan Transfer Bank')

@section('content')
<!-- Filter & Search Bar -->
<div class="card card-round shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.payment-methods.index') }}" method="GET" class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small fw-bold text-uppercase">Tipe:</span>
                <a href="{{ route('admin.payment-methods.index', ['search' => request('search')]) }}"
                   class="badge {{ empty(request('tipe')) ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    Semua
                </a>
                <a href="{{ route('admin.payment-methods.index', ['tipe' => 'cash', 'search' => request('search')]) }}"
                   class="badge {{ request('tipe') == 'cash' ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    <i class="fas fa-money-bill-wave me-1"></i> Cash (COD)
                </a>
                <a href="{{ route('admin.payment-methods.index', ['tipe' => 'e_wallet', 'search' => request('search')]) }}"
                   class="badge {{ request('tipe') == 'e_wallet' ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    <i class="fas fa-qrcode me-1"></i> E-Wallet / QRIS
                </a>
                <a href="{{ route('admin.payment-methods.index', ['tipe' => 'bank', 'search' => request('search')]) }}"
                   class="badge {{ request('tipe') == 'bank' ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    <i class="fas fa-university me-1"></i> Transfer Bank
                </a>
            </div>

            <div class="input-group" style="max-width: 280px;">
                @if(request('tipe'))
                    <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                @endif
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, rekening..." value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Payment Methods Grid / Cards -->
<div class="row g-4 mb-4">
    <!-- Card: Tambah Metode Pembayaran Baru -->
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('admin.payment-methods.create') }}" class="text-decoration-none">
            <div class="card card-round h-100 border-2 border-dashed shadow-none text-center d-flex justify-content-center align-items-center p-4 hover-shadow" style="border: 2px dashed #b5b5c3; min-height: 320px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-primary mb-3">
                        <i class="fas fa-plus-circle" style="font-size: 56px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Tambah Metode Baru</h4>
                    <p class="text-muted small mb-0">Tambah metode Cash (COD), QRIS / E-Wallet, atau Bank Transfer</p>
                </div>
            </div>
        </a>
    </div>

    @forelse($paymentMethods as $method)
    <div class="col-md-6 col-lg-4">
        <div class="card card-round h-100 shadow-sm border-0 d-flex flex-column justify-content-between overflow-hidden">
            <div>
                <!-- Header with Type & Status -->
                <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center py-3 px-4">
                    <span class="badge {{ $method->tipe_badge_class }} px-2 py-1">
                        @if($method->tipe === 'cash')
                            <i class="fas fa-money-bill-wave me-1"></i> Cash (COD)
                        @elseif($method->tipe === 'e_wallet')
                            <i class="fas fa-qrcode me-1"></i> E-Wallet / QRIS
                        @else
                            <i class="fas fa-university me-1"></i> Transfer Bank
                        @endif
                    </span>
                    <span class="badge {{ $method->is_aktif ? 'bg-success' : 'bg-secondary' }}">
                        {{ $method->is_aktif ? 'Aktif di Checkout' : 'Nonaktif' }}
                    </span>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        @if($method->gambar_url)
                            <div class="flex-shrink-0">
                                <img src="{{ $method->gambar_url }}" alt="{{ $method->nama }}" class="rounded border p-1 bg-white shadow-sm" style="width: 70px; height: 70px; object-fit: contain;">
                            </div>
                        @else
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded border bg-light text-muted" style="width: 70px; height: 70px;">
                                @if($method->tipe === 'cash')
                                    <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
                                @elseif($method->tipe === 'e_wallet')
                                    <i class="fas fa-wallet fa-2x text-primary"></i>
                                @else
                                    <i class="fas fa-university fa-2x text-success"></i>
                                @endif
                            </div>
                        @endif

                        <div class="flex-grow-1 overflow-hidden">
                            <h4 class="fw-bold text-dark mb-1 text-truncate" title="{{ $method->nama }}">{{ $method->nama }}</h4>
                            @if($method->nomor_rekening)
                                <div class="text-dark small fw-semibold font-monospace">
                                    {{ $method->nomor_rekening }}
                                </div>
                            @endif
                            @if($method->atas_nama)
                                <div class="text-muted small">
                                    a.n. {{ $method->atas_nama }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($method->instruksi)
                        <div class="p-2 rounded bg-light border small text-muted mb-2 text-truncate-2" style="max-height: 60px; overflow: hidden;" title="{{ $method->instruksi }}">
                            {{ $method->instruksi }}
                        </div>
                    @endif

                    @if($method->tipe !== 'cash')
                        <div class="alert alert-info py-1 px-2 small mb-0 d-flex align-items-center gap-2">
                            <i class="fas fa-file-upload text-info"></i>
                            <span>Wajib upload screenshot bukti transfer saat checkout.</span>
                        </div>
                    @else
                        <div class="alert alert-secondary py-1 px-2 small mb-0 d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-muted"></i>
                            <span>Bayar tunai di tempat saat pesanan tiba.</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="card-footer bg-white border-top px-4 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran {{ $method->nama }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center py-4">
            <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
            Belum ada metode pembayaran yang ditemukan. Silakan tambahkan metode pembayaran baru.
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $paymentMethods->links() }}
</div>
@endsection
