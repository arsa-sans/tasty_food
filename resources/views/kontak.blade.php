@extends('layouts.app')

@section('title', 'Kontak Kami - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[320px] sm:h-[380px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-14 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">KONTAK KAMI</h1>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-black uppercase mb-8 reveal-on-scroll">KONTAK KAMI</h2>

        <div class="border border-gray-300 rounded-3xl p-6 sm:p-10 shadow-sm reveal-on-scroll delay-100">
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('kontak.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="flex flex-col gap-5">
                        <div>
                            <input type="text" name="subjek" placeholder="Subject" value="{{ old('subjek') }}" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-black focus:ring-1 focus:ring-black text-sm transition">
                            @error('subjek')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <input type="text" name="nama" placeholder="Name" value="{{ old('nama') }}" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-black focus:ring-1 focus:ring-black text-sm transition">
                            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-black focus:ring-1 focus:ring-black text-sm transition">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="h-full flex flex-col">
                        <textarea name="pesan" placeholder="Message" required
                            class="w-full h-full min-h-[170px] border border-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-black focus:ring-1 focus:ring-black text-sm resize-none transition">{{ old('pesan') }}</textarea>
                        @error('pesan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-white font-bold py-4 rounded-xl uppercase tracking-wider transition text-sm shadow-md">
                        KIRIM PESAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Contact Info Icons Section -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Email -->
            <div class="flex flex-col items-center reveal-on-scroll delay-100">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-black rounded-full flex items-center justify-center mb-4 p-4 sm:p-5 shadow-md">
                    <img src="{{ asset('assets/Group 66.png') }}" alt="Email Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-extrabold text-sm sm:text-base text-black uppercase mb-1">EMAIL</h3>
                <p class="text-gray-500 text-xs sm:text-sm">admin@tastyfood.com</p>
            </div>

            <!-- Phone -->
            <div class="flex flex-col items-center reveal-on-scroll delay-200">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-black rounded-full flex items-center justify-center mb-4 p-4 sm:p-5 shadow-md">
                    <img src="{{ asset('assets/Group 67.png') }}" alt="Phone Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-extrabold text-sm sm:text-base text-black uppercase mb-1">PHONE</h3>
                <p class="text-gray-500 text-xs sm:text-sm">+62 812-3456-7890</p>
            </div>

            <!-- Location -->
            <div class="flex flex-col items-center reveal-on-scroll delay-300">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-black rounded-full flex items-center justify-center mb-4 p-4 sm:p-5 shadow-md">
                    <img src="{{ asset('assets/Group 68.png') }}" alt="Location Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="font-extrabold text-sm sm:text-base text-black uppercase mb-1">LOCATION</h3>
                <p class="text-gray-500 text-xs sm:text-sm">CyberLabs, Kota Bandung</p>
            </div>
        </div>
    </div>
</section>

<!-- Maps Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl overflow-hidden shadow-lg h-96 w-full">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.1397016964295!2d107.66334356955295!3d-6.943211399566049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c381e3c323%3A0x5f5160f6c9796e4b!2sCYBERLABS%20-%20Jasa%20Digital%20Marketing%20%7C%20Jasa%20Pembuatan%20Website%20%7C%20Jasa%20Pembuatan%20Aplikasi!5e0!3m2!1sid!2sid!4v1772864065271!5m2!1sid!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection
