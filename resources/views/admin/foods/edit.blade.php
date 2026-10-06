@extends('layouts.kaiadmin')

@section('page-title', 'Edit Makanan')

@section('breadcrumbs')
<li class="nav-item">
    <a href="{{ route('admin.foods.index') }}">Makanan</a>
</li>
<li class="separator">
    <i class="icon-arrow-right"></i>
</li>
<li class="nav-item">
    <a href="#">Edit</a>
</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">Form Edit Makanan</div>
                <div class="card-category">Perbarui informasi makanan yang sudah tersimpan.</div>
            </div>
            <form action="{{ route('admin.foods.update', $food) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-3 @error('name') has-error @enderror">
                        <label for="name" class="form-label fw-bold">Nama Makanan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $food->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 @error('description') has-error @enderror">
                        <label for="description" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $food->description) }}</textarea>
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
                                    <option value="semua" {{ old('section', $food->section) == 'semua' ? 'selected' : '' }}>Semua Section (Tentang, Berita, Galeri)</option>
                                    <option value="tentang" {{ old('section', $food->section) == 'tentang' ? 'selected' : '' }}>Tentang Kami</option>
                                    <option value="berita" {{ old('section', $food->section) == 'berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="galeri" {{ old('section', $food->section) == 'galeri' ? 'selected' : '' }}>Galeri</option>
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" value="1" {{ old('is_active', $food->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif (Tampilkan di website)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 @error('image') has-error @enderror">
                        <label for="image" class="form-label fw-bold">Foto Makanan</label>
                        @if($food->image)
                            <div class="mb-2">
                                <p class="text-muted mb-1 small">Foto saat ini:</p>
                                <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="rounded border" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks 2MB.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save me-1"></i> Perbarui
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
