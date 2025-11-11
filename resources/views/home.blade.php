<x-app-layout>


    <section id="home" class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('Assets/Hero Image (2).png');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-white">Batatua1928</h1>
            <p class="text-white text-lg md:text-2xl mb-8 max-w-2xl mx-auto">Kedai Batatua 1928, tempat yang nyaman dengan menu lengkap dan harga terjangkau.</p>
        </div>
    </section>

    <section id="about" class="py-20 bg-[#fff9e6]">
         <div class="flex flex-col md:flex-row items-center justify-center space-x-0 md:space-x-6 p-6">
            <img src="{{ asset('Assets/Rectangle 1.png') }}" alt="logo batatua" class="w-80 md:w-96 rounded-lg mb-6 md:mb-0">
            <p class="max-w-md text-lg text-black text-center md:text-left">
                Kedai Batatua 1928, tempat yang nyaman dengan menu lengkap dan harga terjangkau. Nikmati suasana hangat untuk makan, santai, dan berkumpul bersama teman atau keluarga.
            </p>
        </div>
    </section>

    <section id="products" class="py-20 bg-amber-100/50">
         <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Product Kami</h2>
            <p class="text-lg text-gray-600 text-center mb-12 max-w-2xl mx-auto">Nikmati berbagai pilihan menu dengan cita rasa terbaik dan harga terjangkau</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @forelse ($featuredMenus as $menu)
                    <div onclick="toggleCard(this)" 
                        class="group relative bg-[#E2AE54] rounded-2xl shadow-lg overflow-hidden cursor-pointer product-card">

                        <img src="{{ asset('Assets/' . $menu->gambar) }}" alt="{{ $menu->nama }}" 
                            class="w-full h-48 object-cover transition-all duration-500 group-[.active]:scale-105">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $menu->nama }}</h3>
                            <p class="text-black font-bold mt-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>

                        {{-- deskripsi (hidden) --}}
                        <div class="absolute inset-0 bg-white/95 p-4 opacity-0 translate-x-5 scale-95 rounded-2xl transition-all duration-500 group-[.active]:opacity-100 group-[.active]:translate-x-0 group-[.active]:scale-100">
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

            <div class="text-center mt-12">
                <a href="menu">
                    <button class="bg-gray-800 text-white px-12 py-4 rounded-lg text-lg font-semibold hover:bg-gray-700 transition duration-300 shadow-md">
                        LIHAT MENU LAINNYA
                    </button>
                </a>
            </div>
        </div>
    </section>


    <section id="gallery" class="py-20 bg-amber-100/50 overflow-hidden">
        <h2 class="text-center text-2xl font-semibold mb-6">Galeri Kita</h2>

        <div id="galleryContainer" 
            class="flex space-x-4 overflow-x-scroll scroll-smooth px-6 py-4 no-scrollbar">

            @foreach ($galleryImages as $image)
                <img src="{{ asset('Assets/' . $image->image_path) }}" alt="{{ $image->slot_name }}"
                    class="w-80 h-56 object-cover rounded-xl transition-transform duration-500 hover:scale-110 flex-shrink-0 shadow-md">
            @endforeach   

        </div>
    </section>

    @push('scripts')
        @vite('resources/js/home.js')
    @endpush

</x-app-layout>

