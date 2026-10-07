@extends('layouts.kaiadmin')

@section('title', 'Edit Galeri')
@section('page-title', 'Edit Galeri')
@section('page-subtitle', 'Perbarui foto dan informasi galeri Tasty Food')

@section('breadcrumbs')
<a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-round">
    <i class="fas fa-arrow-left me-1"></i> Kembali
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-round shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">Form Edit Galeri</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Gambar Galeri -->
                    <div class="mb-3">
                        <label for="formFile" class="form-label fw-bold">Gambar Galeri</label>
                        <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile" accept="image/*,.avif" />
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Preview Gambar -->
                        <div class="mt-3">
                            <img id="imagePreview" src="{{ $galeri->image_url }}" alt="Preview Gambar" class="img-thumbnail rounded" style="max-width: 280px; max-height: 280px; object-fit: cover;" />
                        </div>
                    </div>

                    <!-- Judul Galeri -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="judul-galeri">Judul Galeri <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul-galeri" placeholder="Masukkan judul galeri" autocomplete="off" value="{{ old('judul', $galeri->judul) }}" required />
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi Galeri -->
                    <div class="mb-4">
                        <label class="form-label fw-bold" for="deskripsi-galeri">Deskripsi Galeri</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi-galeri" rows="4" placeholder="Masukkan deskripsi galeri (opsional)">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary px-4">
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
        var formFile = document.getElementById('formFile');
        var imagePreview = document.getElementById('imagePreview');

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
                }
            });
        }
    });
</script>
@endpush
