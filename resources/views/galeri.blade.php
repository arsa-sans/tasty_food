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

<!-- Carousel Section -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden shadow-xl bg-orange-500 reveal-on-scroll" id="gallery-carousel">
            <!-- Carousel Slides -->
            <div class="relative h-[240px] sm:h-[360px] md:h-[420px] w-full overflow-hidden">
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-100 flex items-center justify-center">
                    <img src="{{ asset('assets/img-4.png') }}" alt="Salmon Dish" class="w-full h-full object-cover">
                </div>
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-0 flex items-center justify-center">
                    <img src="{{ asset('assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg') }}" alt="Salad Dish" class="w-full h-full object-cover">
                </div>
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-0 flex items-center justify-center">
                    <img src="{{ asset('assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg') }}" alt="Feast Spread" class="w-full h-full object-cover">
                </div>
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

<!-- Photo Grid Section (3 rows x 4 cols = 12 photos) -->
<section class="pb-20 sm:pb-28 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @php
                $galleryPhotos = [
                    'assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg',
                    'assets/brooke-lark-nBtmglfY0HU-unsplash.jpg',
                    'assets/anna-pelzer-IGfIGP5ONV0-unsplash.jpg',
                    'assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg',
                    'assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg',
                    'assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg',
                    'assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg',
                    'assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg',
                    'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg',
                    'assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg',
                    'assets/brooke-lark-oaz0raysASk-unsplash.jpg',
                    'assets/Group 70.png',
                ];
            @endphp

            @php
                $displayPhotos = [];
                if (isset($galeriFoods) && $galeriFoods->count() > 0) {
                    foreach ($galeriFoods as $gf) {
                        $displayPhotos[] = $gf->image_url;
                    }
                }

                $defIdx = 0;
                while (count($displayPhotos) < 12) {
                    $displayPhotos[] = asset($galleryPhotos[$defIdx % count($galleryPhotos)]);
                    $defIdx++;
                }
            @endphp

            @foreach($displayPhotos as $index => $photo)
            <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-{{ (($index % 4) + 1) * 100 }}">
                <img src="{{ $photo }}" alt="Gallery Image {{ $index + 1 }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });
        }

        document.getElementById('prevSlide')?.addEventListener('click', function() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        document.getElementById('nextSlide')?.addEventListener('click', function() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });
    });
</script>
@endsection
