@extends('layouts.kaiadmin')

@section('title', 'Add Berita')
@section('page-title', 'Add Berita')
@section('page-subtitle', 'Tambah berita baru ke dalam sistem Tasty Food')

@section('breadcrumbs')
<a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-round">
    <i class="fas fa-arrow-left me-1"></i> Kembali
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-round shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">Form Tambah Berita</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Gambar Berita -->
                    <div class="mb-3">
                        <label for="formFile" class="form-label fw-bold">Gambar Berita <span class="text-danger">*</span></label>
                        <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile" accept="image/*" required />
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Preview Gambar -->
                        <div class="mt-3">
                            <img id="imagePreview" src="" alt="Preview Gambar" class="img-thumbnail rounded" style="max-width: 280px; max-height: 280px; object-fit: cover; display: none;" />
                        </div>
                    </div>

                    <!-- Judul Berita -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="judul-berita">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul-berita" placeholder="Masukkan judul berita" autocomplete="off" value="{{ old('judul') }}" required />
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug Berita -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="slug-berita">Slug Berita (dibuat otomatis)</label>
                        <input type="text" name="slug" class="form-control bg-light @error('slug') is-invalid @enderror" id="slug-berita" placeholder="Slug akan terisi otomatis dari judul" value="{{ old('slug') }}" readonly />
                        <small class="text-muted">Slug URL unik yang digenerate otomatis dari judul.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konten Berita -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="basic-default-message">Konten Berita <span class="text-danger">*</span></label>
                        <textarea id="basic-default-message" name="konten" class="form-control @error('konten') is-invalid @enderror" rows="8" placeholder="Masukkan konten berita" required>{{ old('konten') }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Publish -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label fw-bold">Status Publish <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="exampleFormControlSelect1" name="status" required>
                            <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="html5-date-input" class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" type="date" value="{{ old('tanggal', date('Y-m-d')) }}" id="html5-date-input" required />
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var judulInput = document.getElementById('judul-berita');
        var slugInput = document.getElementById('slug-berita');
        var formFile = document.getElementById('formFile');
        var imagePreview = document.getElementById('imagePreview');

        function generateSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        if (judulInput && slugInput) {
            judulInput.addEventListener('input', function () {
                slugInput.value = generateSlug(judulInput.value);
            });
        }

        if (formFile && imagePreview) {
            formFile.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        imagePreview.src = event.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
