@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-[600px] sm:h-screen w-full flex items-center bg-black">
    <!-- background image with overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/img-1.png') }}" class="w-full h-full object-cover" alt="Hero Image">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-8 relative z-10">
        <div class="max-w-2xl">
            <h2 class="text-4xl md:text-5xl lg:text-6xl text-white font-normal mb-2">HEALTHY</h2>
            <h1 class="text-5xl md:text-6xl lg:text-7xl text-white font-bold mb-6">TASTY FOOD</h1>
            <p class="text-white/90 text-sm md:text-base mb-8 max-w-lg">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget dictum mi enim eget mauris. Donec interdum, lectus sed sollicitudin lobortis, arcu sapien imperdiet libero.
            </p>
            <a href="#" class="inline-block bg-amber-500 hover:bg-amber-600 text-black font-semibold py-3 px-8 rounded">
                TENTANG KAMI
            </a>
        </div>
    </div>
</section>

<!-- Tentang Kami Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-2 uppercase">Tentang Kami</h2>
            <div class="w-24 h-1 bg-amber-500 mx-auto"></div>
            <p class="mt-6 max-w-3xl mx-auto text-gray-600 text-sm md:text-base">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet. Maecenas sed dui nec ligula faucibus tempus. Donec mattis metus vitae leo pretium hendrerit. Nulla posuere, velit in facilisis tincidunt, magna eros egestas tortor, vitae vestibulum lorem diam non elit.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($tentangFoods as $food)
            <div class="text-center flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="{{ $food->image_url }}" class="w-full h-full object-cover" alt="{{ $food->name }}">
                </div>
                <h3 class="text-xl font-bold mb-3 uppercase">{{ $food->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $food->description }}</p>
            </div>
            @empty
            <!-- Card 1 -->
            <div class="text-center flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="{{ asset('assets/anna-pelzer-IGfIGP5ONV0-unsplash.jpg') }}" class="w-full h-full object-cover" alt="Food 1">
                </div>
                <h3 class="text-xl font-bold mb-3 uppercase">Lorem Ipsum</h3>
                <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.</p>
            </div>
            <!-- Card 2 -->
            <div class="text-center flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="{{ asset('assets/brooke-lark-nBtmglfY0HU-unsplash.jpg') }}" class="w-full h-full object-cover" alt="Food 2">
                </div>
                <h3 class="text-xl font-bold mb-3 uppercase">Lorem Ipsum</h3>
                <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.</p>
            </div>
            <!-- Card 3 -->
            <div class="text-center flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="{{ asset('assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg') }}" class="w-full h-full object-cover" alt="Food 3">
                </div>
                <h3 class="text-xl font-bold mb-3 uppercase">Lorem Ipsum</h3>
                <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.</p>
            </div>
            <!-- Card 4 -->
            <div class="text-center flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="{{ asset('assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg') }}" class="w-full h-full object-cover" alt="Food 4">
                </div>
                <h3 class="text-xl font-bold mb-3 uppercase">Lorem Ipsum</h3>
                <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Berita Kami Section -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-2 uppercase">Berita Kami</h2>
            <div class="w-24 h-1 bg-amber-500 mx-auto"></div>
        </div>
        
        <!-- News Grid -->
        @if(count($beritaFoods) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Left Large Article -->
            <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col h-full">
                <div class="h-64 sm:h-80 w-full relative">
                    <img src="{{ $beritaFoods[0]->image_url }}" class="w-full h-full object-cover" alt="{{ $beritaFoods[0]->name }}">
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl md:text-2xl font-bold mb-3 uppercase">{{ $beritaFoods[0]->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ $beritaFoods[0]->description }}
                    </p>
                    <div class="mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                            Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Smaller Articles (Top 2) -->
            <div class="flex flex-col gap-8">
                @foreach($beritaFoods->slice(1, 2) as $food)
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                    <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                        <img src="{{ $food->image_url }}" class="w-full h-full object-cover" alt="{{ $food->name }}">
                    </div>
                    <div class="p-5 w-full sm:w-3/5 flex flex-col">
                        <h3 class="text-lg font-bold mb-2 uppercase">{{ $food->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            {{ Str::limit($food->description, 100) }}
                        </p>
                        <div class="mt-auto">
                            <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                                Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Bottom Row (2 articles) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($beritaFoods->slice(3, 2) as $food)
            <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                    <img src="{{ $food->image_url }}" class="w-full h-full object-cover" alt="{{ $food->name }}">
                </div>
                <div class="p-5 w-full sm:w-3/5 flex flex-col">
                    <h3 class="text-lg font-bold mb-2 uppercase">{{ $food->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        {{ Str::limit($food->description, 100) }}
                    </p>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                            Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                        </a>
                        <span class="text-amber-500 font-bold text-xl">...</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Left Large Article -->
            <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col h-full">
                <div class="h-64 sm:h-80 w-full relative">
                    <img src="{{ asset('assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg') }}" class="w-full h-full object-cover" alt="News Main">
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl md:text-2xl font-bold mb-3 uppercase">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet. Maecenas sed dui nec ligula faucibus tempus. Donec mattis metus vitae leo pretium hendrerit. Nulla posuere, velit in facilisis tincidunt.
                    </p>
                    <div class="mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                            Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Smaller Articles (Top 2) -->
            <div class="flex flex-col gap-8">
                <!-- Sub article 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                    <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                        <img src="{{ asset('assets/brooke-lark-oaz0raysASk-unsplash.jpg') }}" class="w-full h-full object-cover" alt="News Sub 1">
                    </div>
                    <div class="p-5 w-full sm:w-3/5 flex flex-col">
                        <h3 class="text-lg font-bold mb-2 uppercase">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.
                        </p>
                        <div class="mt-auto">
                            <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                                Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Sub article 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                    <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                        <img src="{{ asset('assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg') }}" class="w-full h-full object-cover" alt="News Sub 2">
                    </div>
                    <div class="p-5 w-full sm:w-3/5 flex flex-col">
                        <h3 class="text-lg font-bold mb-2 uppercase">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit</h3>
                        <p class="text-gray-600 text-sm mb-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.
                        </p>
                        <div class="mt-auto">
                            <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                                Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Row (2 articles) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Bottom article 1 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                    <img src="{{ asset('assets/monika-grabkowska-P1aohbiT-EY-unsplash.jpg') }}" class="w-full h-full object-cover" alt="News Bottom 1">
                </div>
                <div class="p-5 w-full sm:w-3/5 flex flex-col">
                    <h3 class="text-lg font-bold mb-2 uppercase">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.
                    </p>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                            Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                        </a>
                        <span class="text-amber-500 font-bold text-xl">...</span>
                    </div>
                </div>
            </div>
            
            <!-- Bottom article 2 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-sm flex flex-col sm:flex-row h-full">
                <div class="w-full sm:w-2/5 h-48 sm:h-auto">
                    <img src="{{ asset('assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg') }}" class="w-full h-full object-cover" alt="News Bottom 2">
                </div>
                <div class="p-5 w-full sm:w-3/5 flex flex-col">
                    <h3 class="text-lg font-bold mb-2 uppercase">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.
                    </p>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-600 font-semibold text-sm inline-flex items-center">
                            Baca selengkapnya <span class="ml-1 text-xl leading-none">&raquo;</span>
                        </a>
                        <span class="text-amber-500 font-bold text-xl">...</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Galeri Kami Section -->
<section class="py-16 bg-zinc-900">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-2 text-white uppercase">Galeri Kami</h2>
            <div class="w-24 h-1 bg-amber-500 mx-auto"></div>
        </div>
        
        <!-- Masonry-like Grid Layout -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @forelse($galeriFoods as $food)
                @if($loop->index % 2 == 0)
                <div class="grid gap-4">
                    <img src="{{ $food->image_url }}" class="w-full h-full object-cover rounded shadow-lg" alt="{{ $food->name }}" style="min-height: {{ [200, 250, 220, 180][$loop->index / 2 % 4] ?? 200 }}px;">
                    @if(isset($galeriFoods[$loop->index + 1]))
                    <img src="{{ $galeriFoods[$loop->index + 1]->image_url }}" class="w-full h-full object-cover rounded shadow-lg" alt="{{ $galeriFoods[$loop->index + 1]->name }}" style="min-height: {{ [250, 200, 230, 270][$loop->index / 2 % 4] ?? 200 }}px;">
                    @endif
                </div>
                @endif
            @empty
            <div class="grid gap-4">
                <img src="{{ asset('assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 1" style="min-height: 200px;">
                <img src="{{ asset('assets/luisa-brimble-HvXEbkcXjSk-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 5" style="min-height: 250px;">
            </div>
            <div class="grid gap-4">
                <img src="{{ asset('assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 2" style="min-height: 250px;">
                <img src="{{ asset('assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 6" style="min-height: 200px;">
            </div>
            <div class="grid gap-4">
                <img src="{{ asset('assets/jonathan-borba-Gkc_xM3VY34-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 3" style="min-height: 220px;">
                <img src="{{ asset('assets/sanket-shah-SVA7TyHxojY-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 7" style="min-height: 230px;">
            </div>
            <div class="grid gap-4">
                <img src="{{ asset('assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 4" style="min-height: 180px;">
                <img src="{{ asset('assets/brooke-lark-nBtmglfY0HU-unsplash.jpg') }}" class="w-full h-full object-cover rounded shadow-lg" alt="Gallery 8" style="min-height: 270px;">
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="inline-block bg-amber-500 hover:bg-amber-600 text-black font-semibold py-3 px-10 rounded uppercase shadow-lg transition duration-300">
                Lihat Lebih Banyak
            </a>
        </div>
    </div>
</section>
@endsection
