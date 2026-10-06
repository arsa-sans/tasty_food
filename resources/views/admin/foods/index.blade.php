@extends('layouts.kaiadmin')

@section('page-title', 'Kelola Makanan')

@section('breadcrumbs')
<li class="nav-item">
    <a href="{{ route('admin.foods.index') }}">Makanan</a>
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
                        <h4 class="card-title mb-0">Daftar Makanan</h4>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <form method="GET" action="{{ route('admin.foods.index') }}" class="d-flex gap-2">
                            <select name="section" class="form-select form-select-sm" style="width: auto;">
                                <option value="">Semua Section</option>
                                <option value="semua" {{ request('section') == 'semua' ? 'selected' : '' }}>Semua Section</option>
                                <option value="tentang" {{ request('section') == 'tentang' ? 'selected' : '' }}>Tentang Kami</option>
                                <option value="berita" {{ request('section') == 'berita' ? 'selected' : '' }}>Berita</option>
                                <option value="galeri" {{ request('section') == 'galeri' ? 'selected' : '' }}>Galeri</option>
                            </select>
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari makanan..." class="form-control">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('admin.foods.create') }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center">
                            <i class="fas fa-plus me-1"></i> Tambah Makanan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 80px;">Gambar</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($foods as $index => $food)
                            <tr>
                                <td>{{ $foods->firstItem() + $index }}</td>
                                <td>
                                    @if($food->image)
                                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted border" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $food->name }}</span>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 250px;" title="{{ $food->description }}">
                                        {{ $food->description }}
                                    </span>
                                </td>
                                <td>
                                    @if($food->section === 'semua')
                                        <span class="badge badge-secondary">Semua Section</span>
                                    @else
                                        <span class="badge badge-info text-capitalize">{{ $food->section }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($food->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-button-action">
                                        <a href="{{ route('admin.foods.edit', $food) }}" class="btn btn-link btn-primary btn-lg p-2" title="Edit Makanan">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.foods.destroy', $food) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus makanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger btn-lg p-2" title="Hapus Makanan">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data makanan yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($foods->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $foods->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
