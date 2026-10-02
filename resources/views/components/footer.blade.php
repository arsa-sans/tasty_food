<!-- Footer -->
<footer class="bg-[#1a1a1a] text-white pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Column 1: Tasty Food -->
            <div>
                <h3 class="text-xl font-bold mb-4">Tasty Food</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="flex space-x-3">
                    <a href="#" class="w-8 h-8">
                        <img src="{{ asset('assets/001-facebook.png') }}" alt="Facebook" class="w-8 h-8">
                    </a>
                    <a href="#" class="w-8 h-8">
                        <img src="{{ asset('assets/002-twitter.png') }}" alt="Twitter" class="w-8 h-8">
                    </a>
                </div>
            </div>

            <!-- Column 2: Useful Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Useful links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Blog</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Hewan</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Galeri</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Testimonial</a></li>
                </ul>
            </div>

            <!-- Column 3: Privacy -->
            <div>
                <h3 class="text-lg font-bold mb-4">Privacy</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Karir</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Kontak Kami</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-yellow-400 transition">Servis</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact Info -->
            <div>
                <h3 class="text-lg font-bold mb-4">Contact Info</h3>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <img src="{{ asset('assets/ic_markunread_24px.png') }}" alt="Email" class="w-5 h-5">
                        <span class="text-gray-400 text-sm">tastyfood@gmail.com</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <img src="{{ asset('assets/ic_call_24px.png') }}" alt="Phone" class="w-5 h-5">
                        <span class="text-gray-400 text-sm">+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <img src="{{ asset('assets/ic_place_24px.png') }}" alt="Location" class="w-5 h-5 mt-0.5">
                        <span class="text-gray-400 text-sm">Kota Bandung, Jawa Barat</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 pt-6 text-center">
            <p class="text-gray-500 text-sm">Copyright ©2023 All rights reserved.</p>
        </div>
    </div>
</footer>
