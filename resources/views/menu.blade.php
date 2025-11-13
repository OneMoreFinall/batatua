<x-app-layout>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: fadeIn 0.6s ease-out;
        }
        .product-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        .category-btn {
            transition: all 0.3s ease;
            position: relative;
        }
        .category-btn.active {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            transform: scale(1.05);
        }
        .category-btn.active::after {
            width: 100%;
        }
        .search-container {
            position: relative;
        }
        .search-container input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
        }
        .no-results {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }
        .no-results.show {
            display: block;
        }
    </style>

    <section id="home" class="relative h-screen flex items-center justify-center parallax" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/50"></div>
        <div class="relative z-10 text-center text-white px-4 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-2">
                <span class="bg-gradient-to-r from-amber-300 via-yellow-300 to-amber-400 bg-clip-text text-transparent">Menu</span> <span class="text-white">Kami</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200">Pilih menu favoritmu</p>
        </div>
    </section>

    <div class="bg-gradient-to-b from-[#fff8f0] to-amber-50 min-h-screen py-12 px-5">
        <div class="container mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-4 bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">Product Kami</h2>
            <p class="text-center text-gray-600 mb-8 text-lg">Temukan menu favoritmu dengan mudah</p>

            <div class="max-w-2xl mx-auto mb-8 search-container">
                <div class="relative">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari menu favoritmu..."
                        class="w-full px-6 py-4 pl-14 rounded-full border-2 border-amber-200 focus:border-amber-500 transition-all duration-300 text-lg shadow-lg"
                    >
                    <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-amber-500 text-xl"></i>
                    <button id="clearSearch" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                        <i class="fas fa-times-circle text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="flex justify-center gap-4 mb-12 flex-wrap">
                <button class="category-btn active px-6 py-3 rounded-full text-sm font-semibold bg-gradient-to-r from-amber-500 to-yellow-500 text-white shadow-lg" data-category="all">
                    <i class="fas fa-th mr-2"></i>All
                </button>
                <button class="category-btn px-6 py-3 rounded-full text-sm font-semibold text-gray-700 hover:text-amber-600 bg-white shadow-md hover:shadow-lg" data-category="makanan-ringan">
                    <i class="fas fa-cookie-bite mr-2"></i>Makanan Ringan
                </button>
                <button class="category-btn px-6 py-3 rounded-full text-sm font-semibold text-gray-700 hover:text-amber-600 bg-white shadow-md hover:shadow-lg" data-category="makanan-berat">
                    <i class="fas fa-utensils mr-2"></i>Makanan Berat
                </button>
                <button class="category-btn px-6 py-3 rounded-full text-sm font-semibold text-gray-700 hover:text-amber-600 bg-white shadow-md hover:shadow-lg" data-category="non-coffe">
                    <i class="fas fa-glass-water mr-2"></i>Non Coffee
                </button>
                <button class="category-btn px-6 py-3 rounded-full text-sm font-semibold text-gray-700 hover:text-amber-600 bg-white shadow-md hover:shadow-lg" data-category="coffee">
                    <i class="fas fa-coffee mr-2"></i>Coffee
                </button>
            </div>

            <div id="noResults" class="no-results">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Menu tidak ditemukan</h3>
                <p class="text-gray-500">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda</p>
            </div>

            <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <p class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-500">Memuat menu...</p>
            </div>

            <div class="flex justify-center mt-16 mb-8">
                <a href="{{ route('home') }}">
                    <button class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-10 py-4 rounded-full text-lg font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </button>
                </a>
            </div>
        </div>
    </div>

</x-app-layout>

