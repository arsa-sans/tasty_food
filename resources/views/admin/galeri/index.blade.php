@extends('layouts.kaiadmin')

@section('title', 'All Galeri')
@section('page-title', 'All Galeri')
@section('page-subtitle', 'Kelola semua dokumentasi dan galeri foto makanan Tasty Food')

@section('breadcrumbs')
<a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-round">
    <i class="fas fa-plus me-1"></i> Tambah Galeri
</a>
@endsection

@section('content')
<!-- Bootstrap Carousel on top (matching live site) -->
@if($galeris->count() > 0)
<div class="row mb-5">
    <div class="col-12">
        <div class="card card-round overflow-hidden shadow-sm border-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($galeris->take(5) as $idx => $g)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $idx }}" class="{{ $idx === 0 ? 'active' : '' }}" aria-label="Slide {{ $idx + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($galeris->take(5) as $idx => $g)
                        <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                            <img src="{{ $g->image_url }}" class="d-block w-100" style="height: 380px; object-fit: cover; filter: brightness(0.85);" alt="{{ $g->judul }}">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3 mb-4">
                                <h4 class="fw-bold mb-1">{{ $g->judul }}</h4>
                                <p class="mb-0 text-white-50">{{ $g->deskripsi ?? 'Galeri Tasty Food' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Galeri Grid (matching live site) -->
<div class="row g-4 mb-4">
    <!-- Card Tambah Galeri (First Card) -->
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('admin.galeri.create') }}" class="text-decoration-none">
            <div class="card card-round h-100 border-2 border-dashed shadow-none text-center d-flex justify-content-center align-items-center p-4" style="border: 2px dashed #b5b5c3; min-height: 350px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-primary mb-3">
                        <i class="fas fa-plus-circle" style="font-size: 56px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Tambah Galeri</h4>
                    <p class="text-muted small mb-0">Klik di sini untuk menambahkan foto galeri baru</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Galeri Item Cards -->
    @foreach($galeris as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card card-round h-100 shadow-sm border-0 overflow-hidden d-flex flex-column justify-content-between">
            <div>
                <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" class="w-100" style="height: 220px; object-fit: cover;" />
                <div class="card-body p-4 pb-2">
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $item->judul }}</h5>
                    <p class="card-text text-muted small line-clamp-2">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>

            <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto galeri ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </form>
                    <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Show & Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
