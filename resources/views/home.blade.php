@extends('layouts.app')

@section('title', 'Tasty Food - Healthy Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative bg-[#F9F9F9] overflow-hidden min-h-[580px] sm:min-h-[640px] lg:min-h-[720px] flex items-center">
    <!-- Huge Circular Dish Overflowing Top-Right -->
    <div class="absolute -top-16 -right-28 sm:-top-24 sm:-right-24 md:-top-32 md:-right-32 lg:-top-44 lg:-right-48 w-[320px] sm:w-[480px] md:w-[620px] lg:w-[820px] xl:w-[940px] pointer-events-none select-none z-10 opacity-30 sm:opacity-100 transition-all duration-700 animate-hero-plate">
        <img src="{{ asset('assets/img-4-2000x2000.png') }}" alt="Tasty Food Dish" class="w-full h-auto drop-shadow-2xl" fetchpriority="high">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 sm:py-36 relative z-20 w-full">
        <div class="max-w-xl animate-hero-fade">
            <!-- Accent Line -->
            <div class="w-14 h-1 bg-gray-400 mb-6"></div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-light text-black tracking-wide mb-1 uppercase">HEALTHY</h2>
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-black tracking-tight mb-6 uppercase">TASTY FOOD</h1>

            <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-8 max-w-md">
                Nikmati hidangan khas Nusantara yang diolah dari rempah-rempah pilihan, resep autentik, dan bahan-bahan segar berkualitas tinggi untuk menghadirkan pengalaman kuliner terbaik yang tak terlupakan.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('menu') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-black font-extrabold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md">
                    PESAN MAKANAN
                </a>
                <a href="{{ route('tentang') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md">
                    TENTANG KAMI
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami Section -->
<section class="bg-white pt-20 pb-0 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal-on-scroll">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-3">TENTANG KAMI</h2>
        <p class="max-w-2xl mx-auto text-gray-600 text-xs sm:text-sm leading-relaxed mb-16">
            Tasty Food hadir sebagai destinasi kuliner yang menyajikan kekayaan aneka masakan tradisional Indonesia. Kami berkomitmen melestarikan cita rasa asli Nusantara dengan sentuhan penyajian modern yang menggugah selera.
        </p>
    </div>

    <!-- Dark Banner with 4 White Floating Cards -->
    <div class="relative bg-cover bg-center py-20 px-4 sm:px-6 lg:px-8" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="max-w-7xl mx-auto relative z-10 pt-10 pb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 sm:gap-8 lg:gap-6">
                @php
                    $cards = (isset($signatureDishes) && $signatureDishes->count() > 0) ? $signatureDishes->take(4) : ((isset($beritas) && $beritas->count() > 0) ? $beritas->take(4) : collect());
                @endphp
                @foreach($cards as $index => $food)
                <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-{{ ($index + 1) * 100 }}">
                    <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                        <a href="{{ route('makanan.detail', $food->slug) }}" class="w-full h-full block">
                            <img src="{{ $food->image_url }}" alt="{{ $food->judul }}" class="w-full h-full object-cover rounded-full drop-shadow-xl hover:scale-105 transition" loading="lazy" decoding="async">
                        </a>
                    </div>
                    <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2 line-clamp-1">
                        <a href="{{ route('makanan.detail', $food->slug) }}" class="text-black hover:text-amber-600 transition">
                            {{ $food->judul }}
                        </a>
                    </h3>
                    <p class="text-gray-500 text-xs leading-relaxed mb-3 line-clamp-2">
                        {{ Str::limit(strip_tags($food->konten), 80) }}
                    </p>
                    <a href="{{ route('makanan.detail', $food->slug) }}" class="mt-auto text-xs font-bold text-amber-500 hover:text-amber-600 uppercase">
                        Lihat Detail &rarr;
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Berita Kami Section (Synchronized with Berita Model & Detail Links) -->
<section class="bg-[#F9F9F9] py-16 sm:py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase text-center mb-12 reveal-on-scroll">BERITA KAMI</h2>

        @php
            $featured = isset($beritas) && $beritas->count() > 0 ? $beritas->first() : null;
            $otherItems = isset($beritas) && $beritas->count() > 1 ? $beritas->skip(1)->take(4) : collect();
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Large Article (Featured Article) -->
            @if($featured)
            <div class="lg:col-span-6 flex flex-col reveal-on-scroll">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col h-full border border-gray-100 hover:shadow-md transition">
                    <img src="{{ $featured->image_url }}" alt="{{ $featured->judul }}" class="h-64 sm:h-72 lg:h-80 w-full object-cover" loading="lazy" decoding="async">
                    <div class="p-6 sm:p-8 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="text-xs text-gray-400 font-semibold mb-2">
                                {{ $featured->tanggal ? $featured->tanggal->format('d M Y') : 'Artikel Pilihan' }}
                            </div>
                            <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-3 leading-snug">
                                {{ $featured->judul }}
                            </h3>
                            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($featured->konten), 160) }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('makanan.detail', $featured->slug) }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition uppercase">
                                baca selengkapnya
                            </a>
                            <span class="text-gray-400 font-bold tracking-widest text-base">•••</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Right 2x2 Small Articles -->
            <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($otherItems as $idx => $card)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition reveal-on-scroll delay-{{ ($idx + 1) * 100 }}">
                    <div>
                        <img src="{{ $card->image_url }}" alt="{{ $card->judul }}" class="h-36 sm:h-40 w-full object-cover" loading="lazy" decoding="async">
                        <div class="p-4 sm:p-5">
                            <h4 class="font-extrabold text-sm text-black uppercase mb-2 line-clamp-1">
                                {{ $card->judul }}
                            </h4>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                                {{ Str::limit(strip_tags($card->konten), 80) }}
                            </p>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 pt-0 flex items-center justify-between">
                        <a href="{{ route('makanan.detail', $card->slug) }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition">baca selengkapnya</a>
                        <span class="text-gray-400 font-bold tracking-widest text-sm">•••</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Galeri Kami Section (Synchronized with Galeri Model) -->
<section class="bg-white py-16 sm:py-20 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase text-center mb-12 reveal-on-scroll">GALERI KAMI</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($galeris->take(6) as $index => $item)
            <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-{{ (($index % 3) + 1) * 100 }} group relative">
                <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4 text-white">
                    <h4 class="font-bold text-sm">{{ $item->judul }}</h4>
                    @if($item->deskripsi)
                        <p class="text-xs text-gray-200 line-clamp-2 mt-1">{{ $item->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-400">Belum ada foto galeri.</div>
            @endforelse
        </div>

        <div class="text-center mt-12 reveal-on-scroll">
            <a href="{{ route('galeri') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-10 py-3.5 transition-all shadow-md">
                LIHAT LEBIH BANYAK
            </a>
        </div>
    </div>
</section>
@endsection
