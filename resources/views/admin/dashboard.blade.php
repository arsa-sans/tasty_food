@extends('layouts.kaiadmin')

@section('page-title', 'Dashboard')

@section('breadcrumbs')
<li class="nav-item">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Makanan</p>
                            <h4 class="card-title">{{ $totalFoods ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Makanan Aktif</p>
                            <h4 class="card-title">{{ $activeFoods ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Ulasan</p>
                            <h4 class="card-title">{{ $totalReviews ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Ulasan Baru</p>
                            <h4 class="card-title">{{ $unreadReviews ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Ulasan Terbaru -->
    <div class="col-md-6">
        <div class="card card-round">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Ulasan Terbaru</div>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestReviews ?? [] as $review)
                            <tr class="{{ !$review->is_read ? 'table-warning' : '' }}">
                                <td>
                                    <div class="fw-bold">{{ $review->name }}</div>
                                    <small class="text-muted">{{ $review->email }}</small>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 220px;" title="{{ $review->message }}">
                                        {{ Str::limit($review->message, 45) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada ulasan terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Makanan Terbaru -->
    <div class="col-md-6">
        <div class="card card-round">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Makanan Terbaru</div>
                <a href="{{ route('admin.foods.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Section</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestFoods ?? [] as $food)
                            <tr>
                                <td>
                                    @if($food->image)
                                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="rounded" style="width: 42px; height: 42px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted" style="width: 42px; height: 42px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $food->name }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-info text-capitalize">{{ $food->section }}</span>
                                </td>
                                <td>
                                    @if($food->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada makanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
