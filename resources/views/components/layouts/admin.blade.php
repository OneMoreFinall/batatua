<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Batatua 1928 - Admin Panel' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('Assets/Logo Kedai Batatua 1928.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .activity-item {
            transition: all 0.3s ease;
        }
        .activity-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 via-yellow-50 to-amber-100">
    <div class="flex min-h-screen">
        <div class="w-80 p-8 flex flex-col shadow-2xl" style="background: linear-gradient(180deg, #A18686 0%, #8B6F6F 100%);">
            <a href="{{ route('home') }}" class="group">
                <div class="text-center mb-16 animate-fade-in">
                    <div class="text-5xl font-bold tracking-widest text-white group-hover:scale-110 transition-transform duration-300">BATA</div>
                    <div class="text-xl text-amber-200">- 1928 -</div>
                    <div class="text-5xl font-bold tracking-widest mt-1 text-white group-hover:scale-110 transition-transform duration-300">TUA</div>
                </div>
            </a>

            <nav class="flex-1 space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 text-white hover:bg-white/30 backdrop-blur-sm px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 shadow-lg' : '' }}">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                    </svg>
                    <span class="text-xl font-bold">Dashboard</span>
                </a>

                <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-4 text-white hover:bg-white/30 backdrop-blur-sm px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.menu.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="6" width="18" height="2"/>
                        <rect x="3" y="11" width="18" height="2"/>
                        <rect x="3" y="16" width="18" height="2"/>
                    </svg>
                    <span class="text-xl font-bold">Kelola Menu</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="flex items-center space-x-4 text-white hover:bg-white/30 backdrop-blur-sm px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.gallery.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="4" y="4" width="16" height="12" rx="1" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="8.5" cy="9" r="1.5"/>
                        <path d="M4 15l4-4 3 3 5-6 4 5v3H4z"/>
                    </svg>
                    <span class="text-xl font-bold">Kelola Galeri</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-4 text-white hover:bg-white/30 backdrop-blur-sm px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.profile.*') ? 'bg-white/20 shadow-lg' : '' }}">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span class="text-xl font-bold">Kelola Profil</span>
                </a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center space-x-4 text-white hover:bg-red-600/30 backdrop-blur-sm px-4 py-3 rounded-xl transition-all duration-300 border border-red-400/30">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                    </svg>
                    <span class="text-xl font-bold">Logout</span>
                </a>
            </form>
        </div>
        
        <div class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-8 animate-fade-in">
                <div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-2">
                        BATATUA 1928 - <span class="font-normal text-amber-600">ADMIN PANEL</span>
                    </h1>
                    <p class="text-gray-600 text-lg">Selamat datang kembali, {{ auth()->user()->name }}!</p>
                </div>
                <div class="flex items-center space-x-4 bg-white/80 backdrop-blur-sm px-6 py-3 rounded-full shadow-lg">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>

            {{ $slot }}

        </div>
    </div>

    @stack('scripts')

</body>
</html>