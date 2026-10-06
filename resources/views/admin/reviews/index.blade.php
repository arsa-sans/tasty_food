@extends('layouts.kaiadmin')

@section('page-title', 'Ulasan Pengunjung')

@section('breadcrumbs')
<li class="nav-item">
    <a href="#">Ulasan</a>
</li>
<li class="separator">
    <i class="icon-arrow-right"></i>
</li>
<li class="nav-item">
    <a href="#">Daftar</a>
</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h4 class="card-title mb-0">Daftar Pesan & Ulasan</h4>
                        <div class="card-category">Kelola pesan dan ulasan yang dikirim oleh pengunjung website.</div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Pengirim</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $index => $review)
                            <tr class="{{ !$review->is_read ? 'table-warning' : '' }}">
                                <td>{{ $reviews->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold {{ !$review->is_read ? 'text-dark' : 'text-secondary' }}">{{ $review->name }}</div>
                                    <small class="text-muted">{{ $review->email }}</small>
                                    @if($review->phone)
                                        <br><small class="text-muted"><i class="fas fa-phone fa-xs me-1"></i>{{ $review->phone }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 320px;" title="{{ $review->message }}">
                                        {{ Str::limit($review->message, 60) }}
                                    </span>
                                </td>
                                <td>
                                    @if($review->is_read)
                                        <span class="badge badge-secondary">Dibaca</span>
                                    @else
                                        <span class="badge badge-warning">Baru</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $review->created_at->format('d M Y, H:i') }}</small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada ulasan atau pesan dari pengunjung.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($reviews->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $reviews->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
