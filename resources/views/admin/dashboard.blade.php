@extends('layouts.kaiadmin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data, menu makanan, dan pesanan pelanggan Tasty Food')

@section('content')
<!-- Row 1: Welcome Banner & Stats -->
<div class="row">
    <!-- Welcome Card -->
    <div class="col-lg-6 mb-4">
        <div class="card card-round h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #1d253b 0%, #17192b 100%);">
            <div class="card-body p-4 text-white d-flex flex-column justify-content-between">
                <div>
                    <div class="badge bg-warning text-dark mb-2 px-3 py-2 fw-bold">Selamat Datang</div>
                    <h3 class="fw-bold mb-2">Halo, {{ auth()->user()->name ?? 'Admin' }}!</h3>
                    <p class="text-white-50 mb-4" style="max-width: 480px;">
                        @if($unconfirmedOrdersCount > 0)
                            Terdapat <strong class="text-warning">{{ $unconfirmedOrdersCount }} pesanan baru</strong> yang menunggu konfirmasi Anda! Segera proses agar pelanggan mendapat kepastian.
                        @elseif($unreadMessagesCount > 0)
                            Kamu punya <strong class="text-warning">{{ $unreadMessagesCount }} pesan</strong> yang belum dibaca dari kontak website.
                        @else
                            Semua pesanan dan pesan pelanggan dalam pantauan. Kelola menu makanan dan pantau pesanan Tasty Food di sini.
                        @endif
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.orders.index', ['status' => 'menunggu_konfirmasi']) }}" class="btn btn-warning fw-bold px-3 py-2">
                        <i class="fas fa-shopping-bag me-1"></i> Pesanan Baru ({{ $unconfirmedOrdersCount }})
                    </a>
                    <a href="{{ route('admin.menu.create') }}" class="btn btn-outline-light px-3 py-2">
                        <i class="fas fa-plus me-1"></i> Tambah Menu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Quick Stats Cards -->
    <div class="col-lg-6 mb-4">
        <div class="row g-3">
            <!-- Pesanan -->
            <div class="col-sm-6">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1">Pesanan</p>
                                    <h4 class="card-title fw-bold mb-1">{{ $totalOrders }}</h4>
                                    <a href="{{ route('admin.orders.index') }}" class="text-danger small fw-semibold text-decoration-none">
                                        Kelola Pesanan &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Makanan -->
            <div class="col-sm-6">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-utensils"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1">Menu Makanan</p>
                                    <h4 class="card-title fw-bold mb-1">{{ $totalMenu }}</h4>
                                    <a href="{{ route('admin.menu.index') }}" class="text-warning small fw-semibold text-decoration-none">
                                        Daftar Menu &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berita -->
            <div class="col-sm-6">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1">Artikel Berita</p>
                                    <h4 class="card-title fw-bold mb-1">{{ $totalBerita }}</h4>
                                    <a href="{{ route('admin.berita.index') }}" class="text-success small fw-semibold text-decoration-none">
                                        Kelola Berita &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galeri -->
            <div class="col-sm-6">
                <div class="card card-stats card-round shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-images"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1">Foto Galeri</p>
                                    <h4 class="card-title fw-bold mb-1">{{ $totalGaleri }}</h4>
                                    <a href="{{ route('admin.galeri.index') }}" class="text-primary small fw-semibold text-decoration-none">
                                        Kelola Galeri &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: Pesanan Terbaru & Pesan Masuk -->
<div class="row">
    <!-- Pesanan Terbaru -->
    <div class="col-lg-7 mb-4">
        <div class="card card-round h-100 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-shopping-bag text-danger me-2"></i> Pesanan Pelanggan Terbaru
                </h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestOrders as $ord)
                            <tr>
                                <td>
                                    <span class="badge bg-dark font-monospace">{{ $ord->order_code }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ $ord->nama_pelanggan }}</span>
                                    <small class="text-muted">{{ $ord->telepon }}</small>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">{{ $ord->formatted_total }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $ord->status_badge_class }}">
                                        {{ $ord->status_label }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-xs btn-primary py-1 px-2">
                                        <i class="fas fa-eye fa-xs me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesan Terbaru -->
    <div class="col-lg-5 mb-4">
        <div class="card card-round h-100 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-envelope text-warning me-2"></i> Pesan Masuk Terbaru
                </h5>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($latestMessages as $msg)
                        <li class="list-group-item px-4 py-3 border-0 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div>
                                    <span class="fw-bold text-dark">{{ $msg->nama }}</span>
                                </div>
                                <span class="badge {{ $msg->status === 'belum_dibaca' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ $msg->status === 'belum_dibaca' ? 'Baru' : 'Dibaca' }}
                                </span>
                            </div>
                            <span class="text-truncate d-block small fw-semibold text-secondary" style="max-width: 280px;">
                                {{ $msg->subjek }}
                            </span>
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $msg->created_at ? $msg->created_at->diffForHumans() : '-' }}</small>
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-xs btn-outline-primary py-1 px-2">
                                    Buka &rarr;
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center py-4 text-muted">Belum ada pesan masuk.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
