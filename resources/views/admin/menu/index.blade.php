@extends('layouts.kaiadmin')

@section('title', 'Menu Makanan')
@section('page-title', 'Menu Makanan')
@section('page-subtitle', 'Kelola daftar hidangan menu makanan yang dijual di Tasty Food')

@section('content')
<!-- Filter & Search Bar -->
<div class="card card-round shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.menu.index') }}" method="GET" class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small fw-bold text-uppercase">Kategori:</span>
                <a href="{{ route('admin.menu.index', ['search' => request('search')]) }}"
                   class="badge {{ empty(request('kategori')) ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('admin.menu.index', ['kategori' => $cat, 'search' => request('search')]) }}"
                       class="badge {{ request('kategori') == $cat ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <div class="input-group" style="max-width: 280px;">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama menu..." value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Menu Grid Cards -->
<div class="row g-4 mb-4">
    <!-- Card 1: Tambah Menu Baru (Dashed Style matching Berita & Galeri) -->
    <div class="col-md-6 col-lg-4">
        <a href="{{ route('admin.menu.create') }}" class="text-decoration-none">
            <div class="card card-round h-100 border-2 border-dashed shadow-none text-center d-flex justify-content-center align-items-center p-4 hover-shadow" style="border: 2px dashed #b5b5c3; min-height: 380px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-primary mb-3">
                        <i class="fas fa-plus-circle" style="font-size: 56px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Tambah Menu Baru</h4>
                    <p class="text-muted small mb-0">Klik di sini untuk menambahkan hidangan baru yang akan dijual</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Food Cards -->
    @forelse($menus as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card card-round h-100 shadow-sm border-0 overflow-hidden d-flex flex-column justify-content-between">
            <div>
                <!-- Image & Badges -->
                <div class="position-relative" style="height: 200px; overflow: hidden; background-color: #f8f9fa;">
                    <img src="{{ $item->image_url }}" alt="{{ $item->nama }}" class="w-100 h-100" style="object-fit: cover;" />
                    <span class="position-absolute top-0 start-0 m-3 badge {{ $item->is_tersedia ? 'bg-success' : 'bg-danger' }}">
                        {{ $item->is_tersedia ? 'Tersedia' : 'Habis' }}
                    </span>
                    <span class="position-absolute top-0 end-0 m-3 badge bg-dark bg-opacity-75">
                        {{ $item->kategori }}
                    </span>
                </div>

                <!-- Card Content -->
                <div class="card-body p-4 pb-2">
                    <h5 class="card-title fw-bold text-dark mb-1 text-truncate" title="{{ $item->nama }}">
                        {{ $item->nama }}
                    </h5>
                    <div class="fs-5 fw-bold text-success mb-2">
                        {{ $item->formatted_harga }}
                    </div>
                    <p class="text-muted small line-clamp-2 mb-0" style="min-height: 38px;">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi hidangan.' }}
                    </p>
                </div>
            </div>

            <!-- Card Footer: Actions -->
            <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <form action="{{ route('admin.menu.destroy', $item->slug) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $item->nama }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('admin.menu.edit', $item->slug) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-8 col-lg-8">
        <div class="card card-round h-100 shadow-sm border-0 text-center py-5">
            <div class="card-body">
                <i class="fas fa-utensils fa-3x text-muted mb-3 opacity-50"></i>
                <h5 class="fw-bold text-dark">Menu Tidak Ditemukan</h5>
                <p class="text-muted small mb-3">Tidak ada menu dengan kriteria filter atau pencarian saat ini.</p>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-secondary">
                    Reset Filter
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination (Bootstrap 5) -->
@if($menus->hasPages())
<div class="d-flex justify-content-center mt-4 mb-4">
    {{ $menus->links() }}
</div>
@endif
@endsection
