@extends('layouts.app')

@section('content')
<!-- 1. HERO SECTION -->
<section class="relative w-full h-[300px] md:h-[400px]">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/img-1.png');"></div>
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>
    
    <!-- Text -->
    <div class="absolute inset-0 flex flex-col justify-end container mx-auto px-4 pb-8 md:pb-12">
        <h1 class="text-white text-3xl md:text-5xl font-bold uppercase">Kontak Kami</h1>
    </div>
</section>

<!-- 2. CONTACT FORM SECTION -->
<section class="py-12 md:py-16 container mx-auto px-4 max-w-5xl">
    <h2 class="text-2xl md:text-3xl font-bold mb-8 uppercase">Kontak Kami</h2>
    
    <div class="border border-gray-300 rounded-2xl p-6 md:p-8 shadow-sm">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif
        <form method="POST" action="{{ route('kontak.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="flex flex-col gap-6">
                    <div>
                        <input type="text" name="phone" placeholder="Telepon" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-black focus:ring-1 focus:ring-black" required value="{{ old('phone') }}" />
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="text" name="name" placeholder="Nama" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-black focus:ring-1 focus:ring-black" required value="{{ old('name') }}" />
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-black focus:ring-1 focus:ring-black" required value="{{ old('email') }}" />
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="h-full flex flex-col">
                    <textarea name="message" placeholder="Message" class="w-full h-full min-h-[150px] md:min-h-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-black focus:ring-1 focus:ring-black resize-none" required>{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            
            <!-- Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-black text-white font-semibold py-3 rounded-lg hover:bg-gray-800 transition uppercase">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</section>

<!-- 3. CONTACT INFO ICONS SECTION -->
<section class="py-12 container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center max-w-4xl mx-auto">
        <!-- Email -->
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mb-4 p-4">
                <img src="/assets/Group 66.png" alt="Email Icon" class="w-full h-full object-contain" />
            </div>
            <h3 class="font-bold text-lg mb-2 uppercase">Email</h3>
            <p class="text-gray-600">tastyfood@gmail.com</p>
        </div>
        
        <!-- Phone -->
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mb-4 p-4">
                <img src="/assets/Group 67.png" alt="Phone Icon" class="w-full h-full object-contain" />
            </div>
            <h3 class="font-bold text-lg mb-2 uppercase">Phone</h3>
            <p class="text-gray-600">+62 812 3456 7890</p>
        </div>
        
        <!-- Location -->
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mb-4 p-4">
                <img src="/assets/Group 68.png" alt="Location Icon" class="w-full h-full object-contain" />
            </div>
            <h3 class="font-bold text-lg mb-2 uppercase">Location</h3>
            <p class="text-gray-600">Kota Bandung, Jawa Barat</p>
        </div>
    </div>
</section>

<!-- 4. MAP SECTION -->
<section class="w-full bg-gray-100 pb-12">
    <div class="w-full h-[400px]">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091244304!2d107.57311652431252!3d-6.903429015182967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1714571822830!5m2!1sen!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>
@endsection
