@extends('layouts.admin')

@section('page-title', 'Tambah Makanan')

@section('content')
<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah Makanan</h3>
        <p class="text-sm text-gray-500 mt-1">Isi detail makanan yang ingin ditambahkan.</p>
    </div>

    <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div class="space-y-6">
            <!-- Nama Makanan -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Makanan <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="section" class="block text-sm font-medium text-gray-700 mb-2">Section <span class="text-red-500">*</span></label>
                    <select name="section" id="section" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 @error('section') border-red-500 @enderror">
                        <option value="">Pilih Section...</option>
                        <option value="tentang" {{ old('section') == 'tentang' ? 'selected' : '' }}>Tentang Kami</option>
                        <option value="berita" {{ old('section') == 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="galeri" {{ old('section') == 'galeri' ? 'selected' : '' }}>Galeri</option>
                    </select>
                    @error('section')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center mt-8">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-5 w-5 text-amber-500 focus:ring-amber-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700">
                        Status Aktif (Ditampilkan)
                    </label>
                </div>
            </div>

            <!-- Gambar -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar <span class="text-red-500">*</span></label>
                
                <div class="mt-1 flex items-center gap-4">
                    <div id="imagePreview" class="w-32 h-32 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 overflow-hidden">
                        <span class="text-gray-400 text-sm" id="previewText">Preview</span>
                        <img id="imgTag" src="" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>
                    
                    <div class="flex-1">
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)" required
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal: 2MB.</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.foods.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-black rounded-lg text-sm font-medium transition-colors">Simpan Makanan</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var imgTag = document.getElementById('imgTag');
            var previewText = document.getElementById('previewText');
            imgTag.src = reader.result;
            imgTag.classList.remove('hidden');
            previewText.classList.add('hidden');
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
