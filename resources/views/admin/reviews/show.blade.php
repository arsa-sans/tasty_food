@extends('layouts.admin')

@section('page-title', 'Detail Ulasan')

@section('content')
<div class="max-w-4xl">
    <!-- Back Button -->
    <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-800 mb-6 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Ulasan
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex items-start justify-between border-b border-gray-100 pb-6 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $review->name }}</h2>
                    <div class="mt-2 flex flex-col sm:flex-row sm:items-center text-sm text-gray-500 gap-2 sm:gap-6">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:{{ $review->email }}" class="hover:text-amber-600 transition-colors">{{ $review->email }}</a>
                        </div>
                        
                        @if($review->phone)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <a href="tel:{{ $review->phone }}" class="hover:text-amber-600 transition-colors">{{ $review->phone }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="text-right">
                    <span class="text-sm text-gray-500 block mb-2">{{ $review->created_at->format('l, d M Y H:i') }}</span>
                    @if($review->is_read)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Telah Dibaca</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Baru</span>
                    @endif
                </div>
            </div>

            <div class="prose max-w-none text-gray-700">
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Pesan:</h4>
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                    {!! nl2br(e($review->message)) !!}
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus Ulasan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
