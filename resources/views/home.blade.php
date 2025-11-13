<x-app-layout>

    <section id="home" class="relative h-screen flex items-center justify-center parallax" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/50"></div>
        <div class="relative z-10 text-center text-white px-4 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-300 via-yellow-300 to-amber-400">Batatua</span><span class="text-white">1928</span>
            </h1>
            <p class="text-white text-xl md:text-3xl mb-8 max-w-3xl mx-auto leading-relaxed font-light">
                Kedai Batatua 1928, tempat yang nyaman dengan menu lengkap dan harga terjangkau.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
                <a href="{{ route('menu') }}" class="px-8 py-4 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-bold rounded-full hover:from-amber-700 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl animate-pulse-glow">
                    <i class="fas fa-utensils mr-2"></i>Lihat Menu
                </a>
                <a href="#about" class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-bold rounded-full hover:bg-white/30 transition-all duration-300 transform hover:scale-105 border-2 border-white/50">
                    <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                </a>
            </div>
        </div>
        
    </section>

    <section id="about" class="py-24 bg-gradient-to-b from-[#fff9e6] via-amber-50 to-[#fff9e6]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-center space-y-8 md:space-y-0 md:space-x-12">
                <div class="flex-shrink-0 animate-fade-in-up">
                    <img src="{{ asset('Assets/Rectangle 1.png') }}" alt="logo batatua" class="w-80 md:w-96 rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500 border-4 border-amber-200">
                </div>
                <div class="max-w-2xl text-center md:text-left animate-fade-in-up overflow-visible" style="animation-delay: 0.2s">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text leading-snug pb-2">Tentang Kedai Batatua 1928</h2>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-4">
                        Kedai Batatua 1928, tempat yang nyaman dengan menu lengkap dan harga terjangkau. Nikmati suasana hangat untuk makan, santai, dan berkumpul bersama teman atau keluarga.
                    </p>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        Dengan semangat "Semangat Muda Menolak Tua", kami menghadirkan pengalaman kuliner yang tak terlupakan dengan cita rasa autentik dan pelayanan terbaik.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4 justify-center md:justify-start">
                        <div class="bg-white/80 backdrop-blur-sm px-6 py-3 rounded-full shadow-md">
                            <i class="fas fa-clock text-amber-600 mr-2"></i>
                            <span class="font-semibold">09.00 - 00.00 WIB</span>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm px-6 py-3 rounded-full shadow-md">
                            <i class="fas fa-map-marker-alt text-amber-600 mr-2"></i>
                            <span class="font-semibold">Surabaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="py-24 bg-gradient-to-b from-amber-100/50 via-yellow-50/50 to-amber-100/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">Product Kami</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Nikmati berbagai pilihan menu dengan cita rasa terbaik dan harga terjangkau</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                @forelse ($featuredMenus as $menu)
                    <div class="product-card bg-white rounded-3xl shadow-xl overflow-hidden group cursor-pointer" onclick="window.toggleCard(this, event)">
                        <div class="aspect-square bg-gray-200 overflow-hidden relative">
                            <img src="{{ asset('Assets/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            @if ($menu->label == 'hot')
                                <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg"><i class="fas fa-fire mr-1"></i>Hot</div>
                            @elseif ($menu->label == 'best_seller')
                                <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg"><i class="fas fa-star mr-1"></i>Best Seller</div>
                            @endif
                            
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2 text-gray-800 group-hover:text-amber-600 transition-colors">{{ $menu->nama }}</h3>
                            <p class="text-2xl font-bold text-amber-700">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>

                        <div class="absolute inset-0 bg-white/95 p-4 opacity-0 translate-x-5 scale-95 rounded-2xl transition-all duration-500 group-[.active]:opacity-100 group-[.active]:translate-x-0 group-[.active]:scale-100 pointer-events-none">
                            <h4 class="font-semibold mb-2">Deskripsi</h4>
                            <p class="text-sm">
                                {{ $menu->deskripsi ?? 'Deskripsi untuk menu ini belum tersedia.' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 col-span-3 text-center">Menu unggulan akan segera hadir!</p>
                @endforelse

            </div>

            <div class="text-center mt-16 animate-fade-in-up">
                <a href="{{ route('menu') }}">
                    <button class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-12 py-5 rounded-full text-lg font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                        <i class="fas fa-arrow-right mr-2"></i>LIHAT MENU LAINNYA
                    </button>
                </a>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-24 bg-gradient-to-b from-amber-100/50 to-amber-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 gradient-text">Galeri Kita</h2>
            </div>
            <div id="galleryContainer"
                class="flex space-x-4 overflow-x-scroll scroll-smooth px-6 py-4 no-scrollbar">

                @foreach ($galleryImages as $image)
                    <img src="{{ asset('Assets/' . $image->image_path) }}" alt="{{ $image->title }}"
                         class="gallery-item w-80 h-56 object-cover rounded-xl shadow-lg hover:shadow-2xl flex-shrink-0"
                         onclick="openLightbox('{{ asset('Assets/' . $image->image_path) }}')">
                @endforeach
                
                @foreach ($galleryImages as $image)
                    <img src="{{ asset('Assets/' . $image->image_path) }}" alt="{{ $image->title }}" aria-hidden="true"
                         class="gallery-item w-80 h-56 object-cover rounded-xl shadow-lg hover:shadow-2xl flex-shrink-0"
                         onclick="openLightbox('{{ asset('Assets/' . $image->image_path) }}')">
                @endforeach

            </div>
        </div>
    </section>

</x-app-layout>

@push('scripts')
    @vite('resources/js/home.js')
@endpush