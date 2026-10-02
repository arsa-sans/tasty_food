@extends('layouts.admin')

@section('page-title', 'Kelola Makanan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    
    <!-- Top Actions & Filters -->
    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.foods.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-black font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Makanan
            </a>
        </div>
        
        <form method="GET" action="{{ route('admin.foods.index') }}" class="flex flex-col sm:flex-row gap-3">
            <select name="section" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 text-sm">
                <option value="">Semua Section</option>
                <option value="tentang" {{ request('section') == 'tentang' ? 'selected' : '' }}>Tentang Kami</option>
                <option value="berita" {{ request('section') == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="galeri" {{ request('section') == 'galeri' ? 'selected' : '' }}>Galeri</option>
            </select>
            
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari makanan..." 
                    class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500 text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">Filter</button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Section</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($foods as $index => $food)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $foods->firstItem() + $index }}
                    </td>
                    <td class="px-6 py-4">
                        @if($food->image)
                            <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                        @else
                            <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $food->name }}</div>
                        <div class="text-xs text-gray-500 w-48 truncate">{{ $food->description }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                            {{ $food->section }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($food->is_active)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('admin.foods.edit', $food) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.foods.destroy', $food) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus makanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        Tidak ada data makanan ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($foods->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $foods->links() }}
    </div>
    @endif
</div>
@endsection
