@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[300px] md:h-[400px]">
    <img src="/assets/img-1.png" alt="Berita Kami Background" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-0 flex items-end pb-8 px-6 md:pb-12 md:px-16 lg:px-24">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white uppercase">BERITA KAMI</h1>
    </div>
</section>

<!-- Featured Article Section -->
<section class="py-16 px-6 md:px-16 lg:px-24 bg-white">
    @if(count($beritaFoods) > 0)
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-start lg:items-stretch">
        <div class="w-full lg:w-1/2">
            <img src="{{ $beritaFoods[0]->image_url }}" alt="{{ $beritaFoods[0]->name }}" class="w-full h-[350px] lg:h-full object-cover rounded-2xl shadow-lg">
        </div>
        <div class="w-full lg:w-1/2 flex flex-col justify-between py-2">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-black uppercase mb-6 leading-tight">{{ $beritaFoods[0]->name }}</h2>
                <p class="text-gray-700 mb-4 text-justify whitespace-pre-line">
                    {{ $beritaFoods[0]->description }}
                </p>
            </div>
            <div class="self-end mt-4 lg:mt-8">
                <a href="#" class="inline-block bg-black text-white px-8 py-3 font-semibold uppercase tracking-wide hover:bg-gray-800 transition-colors shadow-md">
                    BACA SELENGKAPNYA
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-start lg:items-stretch">
        <div class="w-full lg:w-1/2">
            <img src="/assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg" alt="Makanan Khas Nusantara" class="w-full h-[350px] lg:h-full object-cover rounded-2xl shadow-lg">
        </div>
        <div class="w-full lg:w-1/2 flex flex-col justify-between py-2">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-black uppercase mb-6 leading-tight">APA SAJA MAKANAN KHAS NUSANTARA?</h2>
                <p class="text-gray-700 mb-4 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Donec ac vulputate leo, sit amet eleifend nunc. Nullam non vulputate ipsum. Pellentesque tristique, mi ut vehicula tincidunt, nisl orci commodo sapien, in pulvinar nunc tellus nec purus.
                </p>
                <p class="text-gray-700 mb-8 text-justify">
                    Curabitur quis sapien aliquet, semper eros sed, auctor nunc. Quisque vitae justo at ex faucibus bibendum. Sed elementum sollicitudin facilisis. Vestibulum varius id nisl a aliquet. Sed eu libero efficitur, dictum diam at, venenatis urna. Cras sodales metus massa, efficitur commodo orci euismod in. Suspendisse potenti. Nunc eu pretium erat.
                </p>
            </div>
            <div class="self-end mt-4 lg:mt-8">
                <a href="#" class="inline-block bg-black text-white px-8 py-3 font-semibold uppercase tracking-wide hover:bg-gray-800 transition-colors shadow-md">
                    BACA SELENGKAPNYA
                </a>
            </div>
        </div>
    </div>
    @endif
</section>

<!-- Berita Lainnya Section -->
<section class="py-16 px-6 md:px-16 lg:px-24 bg-gray-50">
    <div class="mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-black uppercase mb-2">BERITA LAINNYA</h2>
        <div class="w-32 h-1 bg-amber-500 rounded"></div>
    </div>
    
    <div class="flex flex-col gap-8">
        @if(count($beritaFoods) > 1)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($beritaFoods->skip(1) as $food)
            <!-- Card -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">{{ $food->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            {{ Str::limit($food->description, 150) }}
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/brooke-lark-oaz0raysASk-unsplash.jpg" alt="News Image 1" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg" alt="News Image 2" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/monika-grabkowska-P1aohbiT-EY-unsplash.jpg" alt="News Image 3" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg" alt="News Image 4" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-4">
            <!-- Card 5 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg" alt="News Image 5" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/luisa-brimble-HvXEbkcXjSk-unsplash.jpg" alt="News Image 6" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/sanket-shah-SVA7TyHxojY-unsplash.jpg" alt="News Image 7" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                <img src="/assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg" alt="News Image 8" class="w-full h-48 object-cover">
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-3 text-black">LOREM IPSUM</h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra in aliquet sem vitae et. Consequat ornare dui vel.
                        </p>
                    </div>
                    <div class="flex justify-between items-center text-amber-500 font-bold text-sm mt-4">
                        <a href="#" class="hover:text-amber-600 transition-colors">Baca selengkapnya</a>
                        <span class="text-xl leading-none">...</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
