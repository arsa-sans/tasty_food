@extends('layouts.app')

@section('title', ($berita->judul ?? 'Detail Makanan') . ' - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <div class="text-white/80 text-xs sm:text-sm uppercase tracking-wider mb-2">
            <a href="{{ route('home') }}" class="hover:underline">Home</a> / 
            <a href="{{ route('berita') }}" class="hover:underline">Berita</a> / 
            <span class="text-amber-400 font-semibold">Detail Makanan</span>
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white uppercase tracking-tight line-clamp-2">
            {{ $berita->judul ?? 'Detail Makanan' }}
        </h1>
    </div>
</section>

<!-- Detail Content Section -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Featured Image -->
        <div class="rounded-3xl overflow-hidden shadow-lg mb-8 max-h-[480px]">
            <img src="{{ $berita->image_url }}" alt="{{ $berita->judul ?? 'Makanan' }}" class="w-full h-full object-cover">
        </div>

        <!-- Meta -->
        <div class="flex items-center gap-3 text-xs sm:text-sm text-gray-400 mb-6 pb-4 border-b border-gray-100">
            @php
                $tgl = '-';
                if (!empty($berita->tanggal)) {
                    $tgl = is_string($berita->tanggal) ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : $berita->tanggal->format('d M Y');
                } elseif (!empty($berita->created_at)) {
                    $tgl = is_string($berita->created_at) ? \Carbon\Carbon::parse($berita->created_at)->format('d M Y') : $berita->created_at->format('d M Y');
                }
            @endphp
            <span><i class="far fa-calendar-alt me-1"></i> {{ $tgl }}</span>
            <span>•</span>
            <span>Ditulis oleh <strong class="text-gray-800">Admin Tasty Food</strong></span>
            <span>•</span>
            <span class="text-amber-600 font-semibold">Kuliner Nusantara</span>
        </div>

        <!-- Article Content -->
        <div class="prose max-w-none text-gray-700 leading-relaxed text-sm sm:text-base space-y-4">
            {!! $berita->konten !!}
        </div>

        <!-- Back Button -->
        <div class="mt-12 pt-6 border-t border-gray-100 flex justify-between items-center">
            <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase px-6 py-3.5 rounded-xl transition shadow">
                &larr; KEMBALI KE BERITA & MENU
            </a>
            <a href="{{ route('home') }}" class="text-xs font-bold text-gray-500 hover:text-black uppercase">
                Ke Halaman Utama
            </a>
        </div>
    </div>
</section>

@if(isset($otherBeritas) && $otherBeritas->count() > 0)
<!-- Berita Terkait Section -->
<section class="py-16 bg-[#F9F9F9] border-t border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl sm:text-2xl font-extrabold text-black uppercase mb-8">PILIHAN KULINER LAINNYA</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($otherBeritas as $other)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="h-44 overflow-hidden">
                            <img src="{{ $other->image_url }}" alt="{{ $other->judul }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <span class="text-[10px] text-gray-400 uppercase font-semibold">
                                {{ $other->tanggal ? (is_string($other->tanggal) ? \Carbon\Carbon::parse($other->tanggal)->format('d M Y') : $other->tanggal->format('d M Y')) : '' }}
                            </span>
                            <h3 class="font-bold text-sm text-gray-900 mt-1 line-clamp-2">{{ $other->judul }}</h3>
                            <p class="text-gray-500 text-xs mt-2 line-clamp-2">
                                {{ Str::limit(strip_tags($other->konten), 70) }}
                            </p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('makanan.detail', $other->slug) }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 inline-block uppercase">
                            Baca selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
