@extends('layouts.app')

@section('title', 'Masuk Akun - Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[280px] sm:h-[320px] bg-cover bg-center flex items-end" style="background-image: url('{{ asset('assets/Group 70.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-12 relative z-10 w-full animate-hero-fade">
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white uppercase tracking-tight">MASUK AKUN</h1>
        <p class="text-gray-300 text-xs sm:text-sm mt-2 max-w-xl">
            Akses riwayat pesanan, lacak status pengantaran, dan nikmati kemudahan memesan hidangan lezat di Tasty Food.
        </p>
    </div>
</section>

<!-- Login Form Section -->
<section class="py-14 sm:py-20 bg-[#F9F9F9]">
    <div class="max-w-md mx-auto px-4 sm:px-6">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-start space-x-3 shadow-xs">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-start space-x-3 shadow-xs">
                <svg class="w-5 h-5 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-gray-100">
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-xs">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 uppercase tracking-tight">Selamat Datang</h2>
                <p class="text-xs text-gray-500 mt-1">Silakan masukkan email dan password akun Anda</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-1.5">
                        Alamat Email <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com"
                               class="w-full bg-gray-50 border @error('email') border-rose-400 bg-rose-50/30 @else border-gray-200 @enderror rounded-xl pl-10 pr-4 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                    </div>
                    @error('email')
                        <p class="text-rose-500 text-[11px] font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase">
                            Kata Sandi <span class="text-rose-500">*</span>
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required
                               placeholder="••••••••"
                               class="w-full bg-gray-50 border @error('password') border-rose-400 bg-rose-50/30 @else border-gray-200 @enderror rounded-xl pl-10 pr-11 py-3 text-xs sm:text-sm focus:outline-none focus:border-amber-500 focus:bg-white transition">
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Toggle Password Visibility">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-rose-500 text-[11px] font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-500">
                        <span class="text-gray-600">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-white font-bold text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl transition flex items-center justify-center space-x-2 shadow-md hover:shadow-lg mt-2">
                    <span>Masuk ke Akun</span>
                    <span class="text-amber-400 font-extrabold">&rarr;</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:text-amber-700 hover:underline ml-1">
                        Daftar Akun Baru
                    </a>
                </p>
            </div>
        </div>

    </div>
</section>

<script>
    function togglePasswordVisibility(fieldId, btn) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            btn.classList.add('text-amber-600');
        } else {
            field.type = 'password';
            btn.classList.remove('text-amber-600');
        }
    }
</script>
@endsection
