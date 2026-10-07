@extends('layouts.kaiadmin')

@section('title', 'All Berita')
@section('page-title', 'All Berita')
@section('page-subtitle', 'Kelola semua berita dan artikel Tasty Food')

@section('breadcrumbs')
<a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-round">
    <i class="fas fa-plus me-1"></i> Tambah Berita
</a>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <!-- Card Tambah Berita (First Card) -->
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('admin.berita.create') }}" class="text-decoration-none">
            <div class="card card-round h-100 border-2 border-dashed shadow-none text-center d-flex justify-content-center align-items-center p-4 hover-shadow" style="border: 2px dashed #b5b5c3; min-height: 380px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-primary mb-3">
                        <i class="fas fa-plus-circle" style="font-size: 56px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Tambah Berita</h4>
                    <p class="text-muted small mb-0">Klik di sini untuk menambahkan berita baru</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Berita Cards -->
    @foreach($beritas as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card card-round h-100 shadow-sm border-0 overflow-hidden d-flex flex-column justify-content-between">
            <div>
                <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" class="w-100" style="height: 220px; object-fit: cover;" />
                <div class="card-body p-4 pb-2">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge {{ $item->status === 'published' ? 'bg-success' : 'bg-warning text-dark' }} px-2 py-1">
                            {{ ucfirst($item->status) }}
                        </span>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $item->tanggal ? $item->tanggal->format('Y-m-d') : $item->created_at->format('Y-m-d') }}
                        </small>
                    </div>
                    <h5 class="card-title fw-bold text-dark line-clamp-2 mb-2" title="{{ $item->judul }}">
                        {{ $item->judul }}
                    </h5>
                    <p class="text-muted small line-clamp-2 mb-0">
                        {{ Str::limit(strip_tags($item->konten), 90) }}
                    </p>
                </div>
            </div>

            <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <form action="{{ route('admin.berita.destroy', $item->slug) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </form>
                    <div class="btn-group gap-1">
                        <a href="{{ route('makanan.detail', $item->slug) }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        <a href="{{ route('admin.berita.edit', $item->slug) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $beritas->links() }}
</div>
@endsection
