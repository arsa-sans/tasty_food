@extends('layouts.kaiadmin')

@section('page-title', 'Tambah Makanan')

@section('breadcrumbs')
<li class="nav-item">
    <a href="{{ route('admin.foods.index') }}">Makanan</a>
</li>
<li class="separator">
    <i class="icon-arrow-right"></i>
</li>
<li class="nav-item">
    <a href="#">Tambah</a>
</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">Form Tambah Makanan</div>
                <div class="card-category">Isi detail makanan yang ingin ditambahkan ke sistem.</div>
            </div>
            <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3 @error('name') has-error @enderror">
                        <label for="name" class="form-label fw-bold">Nama Makanan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Nasi Goreng Spesial" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 @error('description') has-error @enderror">
                        <label for="description" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi lengkap mengenai makanan..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3 @error('section') has-error @enderror">
                                <label for="section" class="form-label fw-bold">Section Tampilan <span class="text-danger">*</span></label>
                                <select name="section" id="section" class="form-select @error('section') is-invalid @enderror" required>
                                    <option value="">Pilih Section...</option>
                                    <option value="semua" {{ old('section') == 'semua' ? 'selected' : '' }}>Semua Section (Tentang, Berita, Galeri)</option>
                                    <option value="tentang" {{ old('section') == 'tentang' ? 'selected' : '' }}>Tentang Kami</option>
                                    <option value="berita" {{ old('section') == 'berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="galeri" {{ old('section') == 'galeri' ? 'selected' : '' }}>Galeri</option>
                                </select>
                                @error('section')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold d-block">Status Makanan</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif (Tampilkan di website)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 @error('image') has-error @enderror">
                        <label for="image" class="form-label fw-bold">Foto Makanan <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                        <small class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('admin.foods.index') }}" class="btn btn-danger">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
