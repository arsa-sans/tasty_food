@extends('layouts.app')

@section('title', 'Galeri Kami - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">GALERI KAMI</h1>
    </div>
</section>

@php
    $hasGaleris = isset($galeris) && $galeris->count() > 0;
    $carouselItems = $hasGaleris ? $galeris->take(5) : collect();
@endphp

<!-- Carousel Section -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden shadow-xl bg-orange-500 reveal-on-scroll" id="gallery-carousel">
            <!-- Carousel Slides -->
            <div class="relative h-[240px] sm:h-[360px] md:h-[420px] w-full overflow-hidden">
                @if($carouselItems->count() > 0)
                    @foreach($carouselItems as $idx => $item)
                        <div class="carousel-slide absolute inset-0 transition-opacity duration-700 {{ $idx === 0 ? 'opacity-100' : 'opacity-0' }} flex items-center justify-center">
                            <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                            @if($item->judul)
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white text-center">
                                    <h3 class="text-xl font-bold">{{ $item->judul }}</h3>
                                    @if($item->deskripsi)
                                        <p class="text-sm text-gray-200 mt-1">{{ $item->deskripsi }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-100 flex items-center justify-center">
                        <img src="{{ asset('assets/images/foods/opor-ayam.webp') }}" alt="Opor Ayam Nusantara" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <!-- Left Arrow -->
            <button id="prevSlide" aria-label="Previous Slide" class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-black hover:bg-gray-100 transition z-20 focus:outline-none">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Right Arrow -->
            <button id="nextSlide" aria-label="Next Slide" class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-black hover:bg-gray-100 transition z-20 focus:outline-none">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- Photo Grid Section -->
<section class="pb-20 sm:pb-28 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @if($hasGaleris)
                @foreach($galeris as $index => $item)
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-{{ (($index % 4) + 1) * 100 }} group relative">
                    <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4 text-white">
                        <h4 class="font-bold text-sm">{{ $item->judul }}</h4>
                        @if($item->deskripsi)
                            <p class="text-xs text-gray-200 line-clamp-2">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                @php
                    $galleryPhotos = [
                        'assets/images/foods/nasi-goreng.webp',
                        'assets/images/foods/rendang.webp',
                        'assets/images/foods/sate.webp',
                        'assets/images/foods/soto.webp',
                        'storage/galeri_images/HU7vYeKkNe2gAfooNPf4kXL5iagrNM1WVaF0Eouh.jpg',
                        'storage/galeri_images/XvHJ7D3Oypxgp1a5I3EdxBRtJIrWFGd037GlrT9C.jpg',
                        'storage/galeri_images/tEnDEM8LtIFpU77XC6KyF7okstsAGhRhifeTsSFY.jpg',
                        'storage/galeri_images/WxSGPEJEuvKlJc6myHK9NSdSMhHeWlctm1Iufe4y.jpg',
                    ];
                @endphp
                @foreach($galleryPhotos as $index => $photo)
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-{{ (($index % 4) + 1) * 100 }}">
                    <img src="{{ asset($photo) }}" alt="Gallery Image {{ $index + 1 }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        let currentSlide = 0;

        function showSlide(index) {
            if (slides.length === 0) return;
            slides.forEach((s) => {
                s.classList.remove('opacity-100');
                s.classList.add('opacity-0');
            });
            slides[index].classList.remove('opacity-0');
            slides[index].classList.add('opacity-100');
        }

        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            });
        }

        if (slides.length > 1) {
            setInterval(function() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }, 5000);
        }
    });
</script>
@endsection
