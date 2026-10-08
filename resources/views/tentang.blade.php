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
                    Tasty Food hadir untuk menghadirkan kelezatan masakan khas Indonesia dengan cita rasa autentik dan kualitas terbaik. Setiap hidangan diolah menggunakan bahan-bahan segar serta rempah pilihan untuk menciptakan rasa yang lezat dan menggugah selera.
                </p>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Kami percaya bahwa makanan bukan sekadar pengisi perut, tetapi juga bagian dari budaya dan kebersamaan. Dengan resep turun-temurun yang dipadukan dengan standar kebersihan modern, Tasty Food selalu siap menyajikan makanan lezat untuk menemani setiap momen istimewa Anda.
                </p>
            </div>

            <!-- Right Images -->
            <div class="grid grid-cols-2 gap-4 sm:gap-6 reveal-on-scroll delay-100">
                <div class="rounded-2xl overflow-hidden shadow-md h-72 sm:h-96">
                    <img src="{{ asset('assets/images/foods/rendang.webp') }}" alt="Rendang Sapi" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-md h-72 sm:h-96">
                    <img src="{{ asset('assets/images/foods/sate.webp') }}" alt="Sate Ayam" class="w-full h-full object-cover" loading="lazy" decoding="async">
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
                    <img src="{{ asset('storage/galeri_images/tEnDEM8LtIFpU77XC6KyF7okstsAGhRhifeTsSFY.jpg') }}" alt="Tumpeng Kuning" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="aspect-square rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ asset('storage/galeri_images/gZdNq9JGeVHkfJ63bTtmmfifB8qftzsUSaPAs7tk.jpg') }}" alt="Mie Yamin" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>

            <!-- Right Text -->
            <div class="order-1 md:order-2 reveal-on-scroll delay-100">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-4">VISI</h2>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    Menjadi restoran kuliner Nusantara pilihan utama yang dikenal karena keaslian cita rasa, kualitas bahan premium, dan pelayanan ramah, serta turut melestarikan dan memperkenalkan kekayaan kuliner tradisional Indonesia kepada seluruh kalangan masyarakat luas dan generasi muda.
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
                    1. Menyajikan hidangan khas Nusantara dengan resep autentik dan bumbu rempah alami pilihan berkualitas.<br><br>
                    2. Menjaga higienitas dan standar mutu pangan dalam setiap proses pengolahan bahan hingga ke meja saji.<br><br>
                    3. Memberikan pelayanan bersahabat dan suasana santap yang nyaman bagi setiap pengunjung.<br><br>
                    4. Terus berinovasi dalam penyajian tanpa menghilangkan nilai tradisi rasa asli Indonesia.
                </p>
            </div>

            <!-- Right Image -->
            <div class="reveal-on-scroll delay-100">
                <div class="rounded-2xl overflow-hidden shadow-md h-60 sm:h-72 w-full">
                    <img src="{{ asset('storage/berita_images/0OrgHcMCuu8sK3FMmDfr61o8xqKjZPmiqTzFW5HV.webp') }}" alt="Nasi Uduk" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
