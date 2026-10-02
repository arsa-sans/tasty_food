@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative w-full h-[300px] md:h-[400px]">
        <img src="/assets/img-1.png" alt="Galeri Background" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-end pb-12">
            <h1 class="text-white text-4xl md:text-5xl font-bold uppercase tracking-wide">Galeri Kami</h1>
        </div>
    </div>

    <!-- Image Carousel/Slider Section -->
    <div class="bg-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-center">
                <!-- Left Arrow -->
                <button id="prevBtn" class="absolute left-2 md:left-8 lg:left-16 z-10 p-3 text-white bg-black/40 hover:bg-black/70 rounded-full focus:outline-none transition-colors shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Featured Image -->
                <div class="w-full max-w-5xl px-12 md:px-24 overflow-hidden rounded-3xl h-[300px] md:h-[500px]">
                    <img id="carouselImage" src="/assets/img-4.png" alt="Featured Food" class="w-full h-full object-cover rounded-3xl shadow-xl transition-opacity duration-300" />
                </div>

                <!-- Right Arrow -->
                <button id="nextBtn" class="absolute right-2 md:right-8 lg:right-16 z-10 p-3 text-white bg-black/40 hover:bg-black/70 rounded-full focus:outline-none transition-colors shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Photo Grid Gallery Section -->
    <div class="bg-white pb-24 md:pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-12 gap-4 md:gap-6">
                <!-- Row 1: 4 images -->
                <img src="/assets/anna-pelzer-IGfIGP5ONV0-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-4" alt="Gallery 1" />
                <img src="/assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 2" />
                <img src="/assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 3" />
                <img src="/assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-4" alt="Gallery 4" />

                <!-- Row 2: 4 images -->
                <img src="/assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-3" alt="Gallery 5" />
                <img src="/assets/monika-grabkowska-P1aohbiT-EY-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-4" alt="Gallery 6" />
                <img src="/assets/brooke-lark-oaz0raysASk-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 7" />
                <img src="/assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-3" alt="Gallery 8" />
                
                <!-- Row 3: 5 images -->
                <img src="/assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-3" alt="Gallery 9" />
                <img src="/assets/luisa-brimble-HvXEbkcXjSk-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 10" />
                <img src="/assets/sanket-shah-SVA7TyHxojY-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 11" />
                <img src="/assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm md:col-span-2" alt="Gallery 12" />
                <img src="/assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg" class="w-full h-48 md:h-72 object-cover rounded-2xl shadow-sm col-span-2 md:col-span-3" alt="Gallery 13" />
            </div>
            
        </div>
    </div>

    <!-- Simple JavaScript for Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                '/assets/img-4.png',
                '/assets/img-1.png',
                '/assets/img-2.png',
                '/assets/img-3.png'
            ];
            
            let currentIndex = 0;
            const imgElement = document.getElementById('carouselImage');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            
            function updateImage() {
                imgElement.style.opacity = 0;
                setTimeout(() => {
                    imgElement.src = images[currentIndex];
                    imgElement.style.opacity = 1;
                }, 150);
            }
            
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
                updateImage();
            });
            
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
                updateImage();
            });
        });
    </script>
@endsection
