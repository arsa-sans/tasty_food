@extends('layouts.kaiadmin')

@section('title', 'Edit Menu Makanan')
@section('page-title', 'Edit Menu Makanan')
@section('page-subtitle', 'Perbarui informasi dan harga menu makanan Tasty Food')

@section('breadcrumbs')
<a href="{{ route('admin.menu.index') }}" class="btn btn-secondary btn-round">
    <i class="fas fa-arrow-left me-1"></i> Kembali ke Menu
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-round shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">Form Edit Menu: {{ $menu->nama }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.menu.update', $menu->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Menu -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Menu Makanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Kategori -->
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                            <input type="text" list="category-list" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" value="{{ old('kategori', $menu->kategori) }}" required>
                            <datalist id="category-list">
                                <option value="Makanan Utama">
                                <option value="Camilan & Tambahan">
                                <option value="Minuman">
                                <option value="Paket Spesial">
                                @foreach($existingCategories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-bold">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" step="500" min="0" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" required>
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi Menu</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Ganti Foto Makanan</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewMenuImage(this)">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP (Max 3MB).</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Current Preview -->
                        <div class="mt-3">
                            <span class="text-xs text-muted d-block mb-1">Foto Saat Ini / Preview:</span>
                            <img id="preview-img" src="{{ $menu->image_url }}" alt="{{ $menu->nama }}" class="rounded-3 shadow-sm" style="max-height: 200px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Status Ketersediaan -->
                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_tersedia" name="is_tersedia" value="1" {{ old('is_tersedia', $menu->is_tersedia) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_tersedia">Menu Tersedia untuk Dipesan</label>
                    </div>

                    <div class="d-flex justify-content-end space-x-2 gap-2">
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewMenuImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
