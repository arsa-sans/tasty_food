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
            <!-- Gray Accent Line -->
            <div class="w-14 h-1 bg-gray-400 mb-6"></div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-light text-black tracking-wide mb-1 uppercase">HEALTHY</h2>
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-black tracking-tight mb-6 uppercase">TASTY FOOD</h1>

            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-8 max-w-md">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget dictum mi enim eget mauris. Donec interdum, lectus sed sollicitudin lobortis, arcu sapien imperdiet libero.
            </p>

            <a href="{{ route('tentang') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-8 py-3.5 transition-all shadow-md">
                TENTANG KAMI
            </a>
        </div>
    </div>
</section>

<!-- Tentang Kami Section -->
<section class="bg-white pt-20 pb-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal-on-scroll">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-3">TENTANG KAMI</h2>
        <p class="max-w-2xl mx-auto text-gray-500 text-xs sm:text-sm leading-relaxed mb-16">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget dictum mi enim eget mauris. Donec interdum, lectus sed sollicitudin lobortis, arcu sapien imperdiet libero.
        </p>
    </div>

    <!-- Dark Banner with 4 White Floating Cards -->
    <div class="relative bg-cover bg-center py-20 px-4 sm:px-6 lg:px-8" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="max-w-7xl mx-auto relative z-10 pt-10 pb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 sm:gap-8 lg:gap-6">
                @if(isset($tentangFoods) && $tentangFoods->count() > 0)
                    @foreach($tentangFoods->take(4) as $index => $food)
                    <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-{{ ($index + 1) * 100 }}">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                            <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="w-full h-full object-cover rounded-full drop-shadow-xl" loading="lazy" decoding="async">
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2">{{ $food->name }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">{{ $food->description }}</p>
                    </div>
                    @endforeach
                @else
                    <!-- Card 1 -->
                    <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-100">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                            <img src="{{ asset('assets/img-1.png') }}" alt="Tofu Bowl" class="w-full h-full object-cover rounded-full drop-shadow-xl" loading="lazy" decoding="async">
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2">LOREM IPSUM</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-200">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                            <img src="{{ asset('assets/img-2.png') }}" alt="Salmon Broccoli" class="w-full h-full object-cover rounded-full drop-shadow-xl" loading="lazy" decoding="async">
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2">LOREM IPSUM</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-300">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                            <img src="{{ asset('assets/img-3.png') }}" alt="Ramen Bowl" class="w-full h-full object-cover rounded-full drop-shadow-xl" loading="lazy" decoding="async">
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2">LOREM IPSUM</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white rounded-3xl p-6 pt-0 text-center flex flex-col items-center shadow-2xl relative reveal-on-scroll delay-400">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 -mt-16 sm:-mt-20 mb-4 rounded-full p-1 flex items-center justify-center">
                            <img src="{{ asset('assets/img-4-2000x2000.png') }}" alt="Platter" class="w-full h-full object-cover rounded-full drop-shadow-xl" loading="lazy" decoding="async">
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-2">LOREM IPSUM</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Berita Kami Section -->
<section class="bg-[#F9F9F9] py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase text-center mb-12 reveal-on-scroll">BERITA KAMI</h2>

        @php
            // Default fallbacks matching the exact design
            $defaultFeatured = (object) [
                'name' => 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget dictum mi enim eget mauris. Donec interdum, lectus sed sollicitudin lobortis, arcu sapien imperdiet libero.',
                'image_url' => asset('assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg'),
            ];

            $defaultSmall = [
                (object) [
                    'name' => 'LOREM IPSUM',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.',
                    'image_url' => asset('assets/brooke-lark-oaz0raysASk-unsplash.jpg'),
                ],
                (object) [
                    'name' => 'LOREM IPSUM',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.',
                    'image_url' => asset('assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg'),
                ],
                (object) [
                    'name' => 'LOREM IPSUM',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.',
                    'image_url' => asset('assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg'),
                ],
                (object) [
                    'name' => 'LOREM IPSUM',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.',
                    'image_url' => asset('assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg'),
                ],
            ];

            // Priority: newest food item becomes the featured big card!
            $featured = (isset($beritaFoods) && $beritaFoods->count() > 0) ? $beritaFoods[0] : $defaultFeatured;

            // Next 4 newest items go into the 2x2 grid, supplemented by defaults if fewer than 5 exist
            $smallCards = [];
            for ($i = 0; $i < 4; $i++) {
                if (isset($beritaFoods) && isset($beritaFoods[$i + 1])) {
                    $smallCards[] = $beritaFoods[$i + 1];
                } else {
                    $smallCards[] = $defaultSmall[$i];
                }
            }
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Large Article (Priority: Newest Item) -->
            <div class="lg:col-span-6 flex flex-col reveal-on-scroll">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm flex flex-col h-full border border-gray-100 hover:shadow-md transition">
                    <img src="{{ $featured->image_url }}" alt="{{ $featured->name }}" class="h-64 sm:h-72 lg:h-80 w-full object-cover" loading="lazy" decoding="async">
                    <div class="p-6 sm:p-8 flex flex-col flex-1 justify-between">
                        <div>
                            <h3 class="font-extrabold text-base sm:text-lg text-black uppercase mb-3 leading-snug">
                                {{ $featured->name }}
                            </h3>
                            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-6">
                                {{ $featured->description }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('berita') }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition uppercase">
                                baca selengkapnya
                            </a>
                            <span class="text-gray-400 font-bold tracking-widest text-base">...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 2x2 Small Articles -->
            <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($smallCards as $idx => $card)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition reveal-on-scroll delay-{{ ($idx + 1) * 100 }}">
                    <div>
                        <img src="{{ $card->image_url }}" alt="{{ $card->name }}" class="h-36 sm:h-40 w-full object-cover" loading="lazy" decoding="async">
                        <div class="p-4 sm:p-5">
                            <h4 class="font-extrabold text-sm text-black uppercase mb-2 line-clamp-1">{{ $card->name }}</h4>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">{{ $card->description }}</p>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 pt-0 flex items-center justify-between">
                        <a href="{{ route('berita') }}" class="text-xs font-bold text-amber-500 hover:text-amber-600 transition">baca selengkapnya</a>
                        <span class="text-gray-400 font-bold tracking-widest text-sm">...</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Galeri Kami Section -->
<section class="bg-white py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase text-center mb-12 reveal-on-scroll">GALERI KAMI</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @if(isset($galeriFoods) && $galeriFoods->count() >= 6)
                @foreach($galeriFoods->take(6) as $index => $food)
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-{{ ($index + 1) * 100 }}">
                    <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                @endforeach
            @else
                <!-- Photo 1 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-100">
                    <img src="{{ asset('assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg') }}" alt="Gallery 1" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>

                <!-- Photo 2 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-200">
                    <img src="{{ asset('assets/img-4.png') }}" alt="Gallery 2" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>

                <!-- Photo 3 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-300">
                    <img src="{{ asset('assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg') }}" alt="Gallery 3" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>

                <!-- Photo 4 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-400">
                    <img src="{{ asset('assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg') }}" alt="Gallery 4" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>

                <!-- Photo 5 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-500">
                    <img src="{{ asset('assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg') }}" alt="Gallery 5" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>

                <!-- Photo 6 -->
                <div class="aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:scale-[1.02] reveal-on-scroll delay-600">
                    <img src="{{ asset('assets/Group 70.png') }}" alt="Gallery 6" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            @endif
        </div>

        <div class="text-center mt-12 reveal-on-scroll">
            <a href="{{ route('galeri') }}" class="inline-block bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm tracking-wider uppercase px-10 py-3.5 transition-all shadow-md">
                LIHAT LEBIH BANYAK
            </a>
        </div>
    </div>
</section>
@endsection
