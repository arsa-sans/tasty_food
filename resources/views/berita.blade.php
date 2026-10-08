@extends('layouts.app')

@section('title', 'Berita Kami - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">BERITA KAMI</h1>
    </div>
</section>

@php
    $featured = isset($beritas) && $beritas->count() > 0 ? $beritas->first() : null;
    $otherBerita = isset($beritas) && $beritas->count() > 1 ? $beritas->skip(1) : collect();
@endphp

<!-- Featured Article Section (Priority: Newest Item) -->
<section class="py-16 sm:py-24 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <!-- Left Large Image -->
            <div class="rounded-3xl overflow-hidden shadow-md h-72 sm:h-96 reveal-on-scroll">
                @if($featured)
                    <img src="{{ $featured->image_url }}" alt="{{ $featured->judul ?? $featured->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                @else
                    <img src="{{ asset('assets/images/foods/nasi-goreng.webp') }}" alt="Makanan Khas Nusantara" class="w-full h-full object-cover" loading="lazy" decoding="async">
                @endif
            </div>

            <!-- Right Content -->
            <div class="reveal-on-scroll delay-100">
                <div class="text-xs text-amber-600 font-bold uppercase tracking-wider mb-2">
                    {{ isset($featured->tanggal) && $featured->tanggal ? (is_string($featured->tanggal) ? \Carbon\Carbon::parse($featured->tanggal)->format('d F Y') : $featured->tanggal->format('d F Y')) : 'Kuliner Populer' }}
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4 leading-snug">
                    {{ $featured ? ($featured->judul ?? $featured->name) : 'APA SAJA MAKANAN KHAS NUSANTARA?' }}
                </h2>
                <div class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-4">
                    @if($featured && isset($featured->konten))
                        {!! strip_tags($featured->konten) !!}
                    @elseif($featured)
                        {{ $featured->description }}
                    @else
                        Kekayaan kuliner Indonesia menyimpan sejuta cerita dan cita rasa rempah autentik yang diwariskan secara turun-temurun dari berbagai penjuru daerah Nusantara.
                    @endif
                </div>

                @if($featured && isset($featured->slug))
                    <a href="{{ route('makanan.detail', $featured->slug) }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md rounded-lg">
                        BACA SELENGKAPNYA
                    </a>
                @else
                    <a href="#" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md rounded-lg">
                        BACA SELENGKAPNYA
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Berita Lainnya Section -->
<section class="py-12 sm:py-20 bg-[#F9F9F9] overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl sm:text-2xl font-extrabold text-black uppercase mb-8 reveal-on-scroll">BERITA LAINNYA</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($otherBerita as $index => $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition duration-300 reveal-on-scroll delay-{{ (($index % 4) + 1) * 100 }}">
                <div>
                    <div class="h-44 w-full overflow-hidden">
                        <img src="{{ $item->image_url }}" alt="{{ $item->judul ?? $item->name }}" class="h-full w-full object-cover hover:scale-105 transition duration-300" loading="lazy" decoding="async">
                    </div>
                    <div class="p-4 sm:p-5">
                        <span class="text-[10px] text-gray-400 font-semibold uppercase block mb-1">
                            {{ isset($item->tanggal) && $item->tanggal ? (is_string($item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : $item->tanggal->format('d M Y')) : '' }}
                        </span>
                        <h3 class="font-extrabold text-sm text-black uppercase mb-2 line-clamp-2">{{ $item->judul ?? $item->name }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                            {{ isset($item->konten) ? Str::limit(strip_tags($item->konten), 90) : $item->description }}
                        </p>
                    </div>
                </div>
                <div class="p-4 sm:p-5 pt-0 flex items-center justify-between border-t border-gray-50 mt-2">
                    @if(isset($item->slug))
                        <a href="{{ route('makanan.detail', $item->slug) }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition uppercase">baca selengkapnya</a>
                    @else
                        <a href="#" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition uppercase">baca selengkapnya</a>
                    @endif
                    <span class="text-gray-400 font-bold tracking-widest text-sm">•••</span>
                </div>
            </div>
            @empty
                <div class="col-span-4 text-center py-8 text-gray-500">Belum ada berita lainnya.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
