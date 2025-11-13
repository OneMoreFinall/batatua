<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('Assets/Logo Kedai Batatua 1928.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(251, 191, 36, 0.5); }
            50% { box-shadow: 0 0 40px rgba(251, 191, 36, 0.8); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .gallery-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .gallery-item:hover {
            transform: scale(1.05);
            z-index: 10;
        }
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
        }
        .lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(255, 255, 255, 0.3);
        }
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .gradient-text {
            background: linear-gradient(135deg, #f59e0b, #d97706, #92400e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
         .nav-link {
            position: relative;
            color: #000;
            transition: color 0.3s;
        }
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0;
            height: 2px;
            background-color: #facc15;
            transition: width 0.3s;
        }
        .nav-link:hover::after {
            width: 100%;
        }
         .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-b from-amber-50 via-yellow-50 to-amber-50 scroll-smooth">
    <header>
        <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-4 transition-all duration-500">
            <div class="container mx-auto px-6 flex items-center justify-between">
                <div class="flex items-center -ml-2">
                     <a href="{{ route('home') }}" class="flex items-center">
                         <img src="{{ asset('Assets/Logo Kedai Batatua 1928.png') }}" alt="Kedai Batatua 1928 Logo" class="h-16 w-auto md:h-20 transition-transform duration-300 group-hover:scale-105">
                     </a>
                </div>

                <ul class="hidden md:flex items-center space-x-10 text-sm font-semibold tracking-wide">
                    <li><a href="{{ route('home') }}#home" class="text-gray-800 hover:text-amber-600 transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-1 after:bg-gradient-to-r after:from-amber-500 after:to-yellow-500 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">HOME</a></li>
                    <li><a href="{{ route('home') }}#about" class="text-gray-800 hover:text-amber-600 transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-1 after:bg-gradient-to-r after:from-amber-500 after:to-yellow-500 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">ABOUT</a></li>
                    <li><a href="{{ route('menu') }}" class="text-gray-800 hover:text-amber-600 transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-1 after:bg-gradient-to-r after:from-amber-500 after:to-yellow-500 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">MENU</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-800 hover:text-amber-600 transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-1 after:bg-gradient-to-r after:from-amber-500 after:to-yellow-500 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">CONTACT</a></li>
                    <li><a href="{{ route('home') }}#location" class="text-gray-800 hover:text-amber-600 transition-all duration-300 relative after:content-[''] after:absolute after:w-0 after:h-1 after:bg-gradient-to-r after:from-amber-500 after:to-yellow-500 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">LOCATION</a></li>
                </ul>

                <button id="mobile-menu-btn" class="md:hidden focus:outline-none text-gray-800 hover:text-amber-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden bg-white/98 backdrop-blur-md border-t border-gray-200 shadow-lg">
                <ul class="flex flex-col px-6 py-4 text-sm font-semibold tracking-wide space-y-2">
                    <li><a href="{{ route('home') }}#home" class="block py-3 text-gray-700 hover:text-amber-600 transition-colors duration-300 border-b border-gray-100">HOME</a></li>
                    <li><a href="{{ route('home') }}#about" class="block py-3 text-gray-700 hover:text-amber-600 transition-colors duration-300 border-b border-gray-100">ABOUT</a></li>
                    <li><a href="{{ route('menu') }}" class="block py-3 text-gray-700 hover:text-amber-600 transition-colors duration-300 border-b border-gray-100">MENU</a></li>
                    <li><a href="{{ route('contact') }}" class="block py-3 text-gray-700 hover:text-amber-600 transition-colors duration-300 border-b border-gray-100">CONTACT</a></li>
                    <li><a href="{{ route('home') }}#location" class="block py-3 text-gray-700 hover:text-amber-600 transition-colors duration-300">LOCATION</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>
    
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="Gallery Image">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-amber-400 transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <footer id="location" class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div class="animate-fade-in-up">
                    <h3 class="text-3xl font-bold mb-6 text-amber-400">
                        <i class="fas fa-map-marker-alt mr-2"></i>Lokasi
                    </h3>
                    <p class="text-gray-300 mb-2 text-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3415947101084!2d112.7226184!3d-7.315469800000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb004ef3acf7%3A0x4e80d1bd83304316!2sKedai%20Batatua%201928%20Ketintang%20Surabaya!5e0!3m2!1sid!2sid!4v1762177314832!5m2!1sid!2sid"
                            width="350" height="230" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        Jl. Ketintang Madya No. 82, Surabaya
                    </p>
                     <div>
                </div>
                </div>
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <h3 class="text-3xl font-bold mb-6 text-amber-400">
                        <i class="fas fa-clock mr-2"></i>Batatua1928
                    </h3>
                    <p class="text-2xl italic mb-4 text-yellow-300 font-semibold">"Semangat Muda Menolak Tua"</p>
                    <div class="space-y-2 text-gray-300 text-lg">
                        <p><i class="fas fa-calendar-day text-amber-500 mr-2"></i>Setiap Hari</p>
                        <p><i class="fas fa-clock text-amber-500 mr-2"></i>09.00 - 00.00 WIB</p>
                    </div>
                </div>

                <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                    <h3 class="text-3xl font-bold mb-6 text-amber-400">
                        <i class="fas fa-phone mr-2"></i>Contact us
                    </h3>
                    <div class="flex justify-center md:justify-start space-x-4 mb-6">
                        <a href="https://www.instagram.com/kedaibatatua.id/" target="_blank" class="w-14 h-14 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center hover:from-purple-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-instagram text-white text-xl"></i>
                        </a>
                        <a href="mailto:batatua1928@gmail.com" class="w-14 h-14 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </a>
                        <a href="#" class="w-14 h-14 bg-gradient-to-br from-black to-gray-800 rounded-full flex items-center justify-center hover:from-gray-800 hover:to-black transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-tiktok text-white text-xl"></i>
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm mt-4">Ikuti kami di media sosial untuk update terbaru!</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} Kedai Batatua 1928. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    @stack('scripts') 

</body>
</html>