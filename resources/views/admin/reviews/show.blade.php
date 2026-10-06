@extends('layouts.kaiadmin')

@section('page-title', 'Detail Ulasan')

@section('breadcrumbs')
<li class="nav-item">
    <a href="{{ route('admin.reviews.index') }}">Ulasan</a>
</li>
<li class="separator">
    <i class="icon-arrow-right"></i>
</li>
<li class="nav-item">
    <a href="#">Detail</a>
</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Ulasan dari {{ $review->name }}</h4>
                    <small class="text-muted">{{ $review->created_at->format('l, d F Y - H:i') }} WIB</small>
                </div>
                <div>
                    <span class="badge badge-success">Sudah Dibaca</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-muted small text-uppercase fw-bold">Email</label>
                        <div>
                            <a href="mailto:{{ $review->email }}" class="text-decoration-none fw-bold">
                                <i class="fas fa-envelope text-primary me-2"></i>{{ $review->email }}
                            </a>
                        </div>
                    </div>
                    @if($review->phone)
                    <div class="col-md-6">
                        <label class="form-label text-muted small text-uppercase fw-bold">No. Telepon / WhatsApp</label>
                        <div>
                            <a href="tel:{{ $review->phone }}" class="text-decoration-none fw-bold">
                                <i class="fas fa-phone text-success me-2"></i>{{ $review->phone }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small text-uppercase fw-bold">Isi Pesan / Ulasan</label>
                    <div class="p-3 bg-light rounded border">
                        <p class="mb-0 fs-6 text-dark" style="white-space: pre-wrap; line-height: 1.6;">{{ $review->message }}</p>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Ulasan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
