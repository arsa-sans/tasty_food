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
    $featured = (isset($beritaFoods) && $beritaFoods->count() > 0) ? $beritaFoods->first() : null;
    $otherBerita = (isset($beritaFoods) && $beritaFoods->count() > 1) ? $beritaFoods->skip(1) : collect();

    $defaultGridImages = [
        'assets/brooke-lark-oaz0raysASk-unsplash.jpg',
        'assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg',
        'assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg',
        'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg',
        'assets/brooke-lark-oaz0raysASk-unsplash.jpg',
        'assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg',
        'assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg',
        'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg',
    ];
@endphp

<!-- Featured Article Section (Priority: Newest Item) -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <!-- Left Large Image -->
            <div class="rounded-3xl overflow-hidden shadow-md h-80 sm:h-96 reveal-on-scroll">
                @if($featured)
                    <img src="{{ $featured->image_url }}" alt="{{ $featured->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                @else
                    <img src="{{ asset('assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg') }}" alt="Makanan Khas Nusantara" class="w-full h-full object-cover" loading="lazy" decoding="async">
                @endif
            </div>

            <!-- Right Content -->
            <div class="reveal-on-scroll delay-100">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4 leading-snug">
                    {{ $featured ? $featured->name : 'APA SAJA MAKANAN KHAS NUSANTARA?' }}
                </h2>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-4">
                    {{ $featured ? $featured->description : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.' }}
                </p>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-6">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
                </p>
                <a href="#" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md">
                    BACA SELENGKAPNYA
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Berita Lainnya Section -->
<section class="py-12 sm:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl sm:text-2xl font-extrabold text-black uppercase mb-8 reveal-on-scroll">BERITA LAINNYA</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                // Display other dynamic berita first, then fill up to 8 slots with defaults
                $displayCards = [];
                foreach ($otherBerita as $item) {
                    $displayCards[] = (object) [
                        'name' => $item->name,
                        'description' => $item->description,
                        'image_url' => $item->image_url,
                    ];
                }

                $fillIndex = 0;
                while (count($displayCards) < 8) {
                    $img = $defaultGridImages[$fillIndex % count($defaultGridImages)];
                    $displayCards[] = (object) [
                        'name' => 'LOREM IPSUM',
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.',
                        'image_url' => asset($img),
                    ];
                    $fillIndex++;
                }
            @endphp

            @foreach($displayCards as $index => $card)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition duration-300 reveal-on-scroll delay-{{ (($index % 4) + 1) * 100 }}">
                <div>
                    <img src="{{ $card->image_url }}" alt="{{ $card->name }}" class="h-40 w-full object-cover" loading="lazy" decoding="async">
                    <div class="p-4 sm:p-5">
                        <h3 class="font-extrabold text-sm text-black uppercase mb-2 line-clamp-1">{{ $card->name }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">
                            {{ $card->description }}
                        </p>
                    </div>
                </div>
                <div class="p-4 sm:p-5 pt-0 flex items-center justify-between">
                    <a href="#" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition">baca selengkapnya</a>
                    <span class="text-gray-400 font-bold tracking-widest text-sm">...</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
