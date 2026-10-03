@extends('layouts.app')

@section('title', 'Tentang Kami - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">TENTANG KAMI</h1>
    </div>
</section>

<!-- Tasty Food Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <!-- Left Text -->
            <div class="reveal-on-scroll">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4">TASTY FOOD</h2>
                <p class="font-bold text-black text-xs sm:text-sm leading-relaxed mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
                </p>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
                </p>
            </div>

            <!-- Right Images -->
            <div class="grid grid-cols-2 gap-4 sm:gap-6 reveal-on-scroll delay-100">
                <div class="rounded-2xl overflow-hidden shadow-md h-72 sm:h-96">
                    <img src="{{ asset('assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg') }}" alt="Tasty Food Dish" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-md h-72 sm:h-96">
                    <img src="{{ asset('assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg') }}" alt="Chef Plating" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <!-- Left Images -->
            <div class="grid grid-cols-2 gap-4 sm:gap-6 order-2 md:order-1 reveal-on-scroll">
                <div class="aspect-square rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ asset('assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg') }}" alt="Table Spread" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="aspect-square rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ asset('assets/img-3.png') }}" alt="Ramen Dish" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>

            <!-- Right Text -->
            <div class="order-1 md:order-2 reveal-on-scroll delay-100">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4">VISI</h2>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ea at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <!-- Left Text -->
            <div class="reveal-on-scroll">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4">MISI</h2>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ea at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                </p>
            </div>

            <!-- Right Image -->
            <div class="reveal-on-scroll delay-100">
                <div class="rounded-2xl overflow-hidden shadow-md h-60 sm:h-72 w-full">
                    <img src="{{ asset('assets/brooke-lark-oaz0raysASk-unsplash.jpg') }}" alt="Misi Food" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
