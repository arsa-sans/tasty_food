@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Makanan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="p-4 bg-amber-100 text-amber-600 rounded-lg">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Makanan</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalFoods ?? 0 }}</h3>
        </div>
    </div>

    <!-- Makanan Aktif -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="p-4 bg-green-100 text-green-600 rounded-lg">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Makanan Aktif</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $activeFoods ?? 0 }}</h3>
        </div>
    </div>

    <!-- Total Ulasan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="p-4 bg-blue-100 text-blue-600 rounded-lg">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Ulasan</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalReviews ?? 0 }}</h3>
        </div>
    </div>

    <!-- Ulasan Belum Dibaca -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="p-4 bg-red-100 text-red-600 rounded-lg">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Ulasan Baru</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $unreadReviews ?? 0 }}</h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Recent Reviews -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-800">Ulasan Terbaru</h3>
            <a href="{{ route('admin.reviews.index') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">Lihat Semua</a>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Pesan</th>
                        <th class="px-6 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($latestReviews ?? [] as $review)
                    <tr class="hover:bg-gray-50 transition-colors {{ !$review->is_read ? 'bg-amber-50/50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-800">{{ $review->name }}</div>
                            <div class="text-xs text-gray-500">{{ $review->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-xs truncate">{{ Str::limit($review->message, 40) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $review->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">Tidak ada ulasan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Foods -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-800">Makanan Terbaru</h3>
            <a href="{{ route('admin.foods.index') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">Lihat Semua</a>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Makanan</th>
                        <th class="px-6 py-3">Section</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($latestFoods ?? [] as $food)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 flex items-center">
                            @if($food->image)
                                <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="w-10 h-10 rounded-md object-cover mr-3">
                            @else
                                <div class="w-10 h-10 rounded-md bg-gray-200 flex items-center justify-center mr-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <span class="text-sm font-medium text-gray-800">{{ $food->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-600 capitalize">{{ $food->section }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($food->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">Tidak ada makanan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
