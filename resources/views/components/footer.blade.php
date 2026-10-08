<!-- Footer -->
<footer class="bg-[#1a1a1a] text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            <!-- Column 1: Tasty Food -->
            <div>
                <h3 class="text-2xl font-extrabold mb-4 tracking-wider uppercase text-white">Tasty Food</h3>
                <p class="text-gray-400 text-xs sm:text-sm leading-relaxed mb-6">
                    Tasty Food hadir untuk menghadirkan kelezatan masakan khas Indonesia dengan cita rasa autentik dan bahan-bahan segar pilihan terbaik Nusantara.
                </p>
                <div class="flex space-x-3">
                    <a href="#" class="w-9 h-9 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-amber-500 transition">
                        <img src="{{ asset('assets/001-facebook.png') }}" alt="Facebook" class="w-4 h-4">
                    </a>
                    <a href="#" class="w-9 h-9 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-amber-500 transition">
                        <img src="{{ asset('assets/002-twitter.png') }}" alt="Twitter" class="w-4 h-4">
                    </a>
                </div>
            </div>

            <!-- Column 2: Useful Links -->
            <div>
                <h3 class="text-base font-bold mb-4 uppercase tracking-wider text-white">Useful Links</h3>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition">Home</a></li>
                    <li><a href="{{ route('tentang') }}" class="text-gray-400 hover:text-amber-400 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('menu') }}" class="text-gray-400 hover:text-amber-400 transition">Menu Makanan</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-amber-400 transition">Keranjang Pesanan</a></li>
                    <li><a href="{{ route('order.history') }}" class="text-gray-400 hover:text-amber-400 transition">Riwayat & Lacak Pesanan</a></li>
                    <li><a href="{{ route('berita') }}" class="text-gray-400 hover:text-amber-400 transition">Berita Kuliner</a></li>
                    <li><a href="{{ route('galeri') }}" class="text-gray-400 hover:text-amber-400 transition">Galeri Foto</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-gray-400 hover:text-amber-400 transition">Kontak</a></li>
                </ul>
            </div>

            <!-- Column 3: Privacy -->
            <div>
                <h3 class="text-base font-bold mb-4 uppercase tracking-wider text-white">Privacy</h3>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition">Accessibility</a></li>
                    <li><a href="{{ route('tentang') }}" class="text-gray-400 hover:text-amber-400 transition">Terms of Service</a></li>
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition">Privacy Policy</a></li>
                    <li><a href="{{ route('kontak') }}" class="text-gray-400 hover:text-amber-400 transition">Bantuan & FAQ</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact Info -->
            <div>
                <h3 class="text-base font-bold mb-4 uppercase tracking-wider text-white">Contact Info</h3>
                <ul class="space-y-3.5 text-xs sm:text-sm">
                    <li class="flex items-center space-x-3">
                        <img src="{{ asset('assets/ic_markunread_24px.png') }}" alt="Email" class="w-5 h-5 flex-shrink-0">
                        <span class="text-gray-400">admin@tastyfood.com</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <img src="{{ asset('assets/ic_call_24px.png') }}" alt="Phone" class="w-5 h-5 flex-shrink-0">
                        <span class="text-gray-400">+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <img src="{{ asset('assets/ic_place_24px.png') }}" alt="Location" class="w-5 h-5 mt-0.5 flex-shrink-0">
                        <span class="text-gray-400">CyberLabs, Kota Bandung, Jawa Barat</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-neutral-800 pt-6 text-center">
            <p class="text-gray-500 text-xs">
                Copyright &copy; {{ date('Y') }} Tasty Food. All rights reserved. Made with ❤️ untuk Masakan Nusantara.
            </p>
        </div>
    </div>
</footer>
