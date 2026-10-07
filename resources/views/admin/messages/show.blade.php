@extends('layouts.kaiadmin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('page-subtitle', 'Informasi lengkap pesan dari pengunjung')

@section('breadcrumbs')
<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-round">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesan
</a>
@endsection

@section('content')
<div class="row align-items-stretch">
    <!-- Left Column: Isi Pesan -->
    <div class="col-md-8 mb-4">
        <div class="card card-round h-100 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-comment-alt text-primary me-2"></i> Isi Pesan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="p-3 bg-light rounded-3 text-dark leading-relaxed" style="white-space: pre-wrap; font-size: 15px; min-height: 250px;">
{{ $message->pesan }}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Informasi Pesan -->
    <div class="col-md-4 mb-4">
        <div class="card card-round h-100 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-info-circle text-info me-2"></i> Informasi Pesan
                </h5>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-1">Subjek</label>
                        <h6 class="fw-bold text-dark mb-0">{{ $message->subjek }}</h6>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-1">Pengirim</label>
                        <p class="fw-semibold text-dark mb-0">{{ $message->nama }}</p>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-1">Email</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $message->email }}" class="text-primary text-decoration-none">
                                <i class="fas fa-envelope fa-xs me-1"></i> {{ $message->email }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3 pb-2 border-bottom">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-1">Status</label>
                        <div>
                            @if($message->status === 'belum_dibaca')
                                <span class="badge bg-warning text-dark px-2 py-1">Belum Dibaca</span>
                            @else
                                <span class="badge bg-success px-2 py-1">Sudah Dibaca</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-1">Tanggal Masuk</label>
                        <p class="text-secondary small mb-0">
                            <i class="far fa-clock me-1"></i> {{ $message->created_at ? $message->created_at->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    @if($message->status === 'belum_dibaca')
                        <form action="{{ route('admin.messages.mark-as-read', $message->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 fw-bold">
                                <i class="fas fa-check me-2"></i> Tandai Sudah Dibaca
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash-alt me-2"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
