@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<div class="relative w-full h-80 md:h-[400px] bg-cover bg-center" style="background-image: url('/assets/img-1.png');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute bottom-0 left-0 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 md:pb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-wider">TENTANG KAMI</h1>
        </div>
    </div>
</div>

<!-- TASTY FOOD SECTION -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-black mb-6">TASTY FOOD</h2>
            <p class="text-gray-600 mb-4 leading-relaxed font-semibold">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex.
            </p>
            <p class="text-gray-600 leading-relaxed text-sm">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Donec venenatis porttitor facilisis. Nunc condimentum efficitur elit. Nunc facilisis est id quam fermentum porta. Quisque eget commodo felis, a lacinia enim. Morbi accumsan elit velit, in tempus tellus mattis nec. Suspendisse sagittis scelerisque massa ut aliquam. Nulla sed velit quis leo pulvinar vulputate vel vel velit. 
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <img src="/assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg" alt="Tasty Food 1" class="w-full h-56 md:h-72 object-cover rounded-xl shadow-sm">
            <img src="/assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg" alt="Tasty Food 2" class="w-full h-56 md:h-72 object-cover rounded-xl shadow-sm">
        </div>
    </div>
</div>

<!-- VISI SECTION -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="grid grid-cols-2 gap-4 order-2 md:order-1">
            <img src="/assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg" alt="Visi Image 1" class="w-full h-56 md:h-72 object-cover rounded-xl shadow-sm">
            <img src="/assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg" alt="Visi Image 2" class="w-full h-56 md:h-72 object-cover rounded-xl shadow-sm">
        </div>
        <div class="order-1 md:order-2">
            <h2 class="text-3xl font-bold text-black mb-6">VISI</h2>
            <p class="text-gray-600 leading-relaxed text-sm">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Donec venenatis porttitor facilisis. Nunc condimentum efficitur elit. Nunc facilisis est id quam fermentum porta. Quisque eget commodo felis, a lacinia enim. Morbi accumsan elit velit, in tempus tellus mattis nec. Suspendisse sagittis scelerisque massa ut aliquam. Nulla sed velit quis leo pulvinar vulputate vel vel velit.
            </p>
        </div>
    </div>
</div>

<!-- MISI SECTION -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 bg-white mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-black mb-6">MISI</h2>
            <p class="text-gray-600 leading-relaxed text-sm">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Donec venenatis porttitor facilisis. Nunc condimentum efficitur elit. Nunc facilisis est id quam fermentum porta. Quisque eget commodo felis, a lacinia enim. Morbi accumsan elit velit, in tempus tellus mattis nec. Suspendisse sagittis scelerisque massa ut aliquam. Nulla sed velit quis leo pulvinar vulputate vel vel velit.
            </p>
        </div>
        <div>
            <img src="/assets/jonathan-borba-Gkc_xM3VY34-unsplash.jpg" alt="Misi Image" class="w-full h-64 md:h-80 object-cover rounded-xl shadow-sm">
        </div>
    </div>
</div>
@endsection
