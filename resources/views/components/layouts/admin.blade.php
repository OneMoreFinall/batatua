<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('Assets/Logo Kedai Batatua 1928.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Batatua 1928 - Admin Panel' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50">
    <div class="flex min-h-screen">
        <div class="w-80 p-8 flex flex-col" style="background-color: #A18686;">
            <a href="{{ route('home') }}"> 
            <div class="text-center mb-16">
                <div class="text-4xl font-bold tracking-widest">BATA</div>
                <div class="text-lg">- 1928 -</div>
                <div class="text-4xl font-bold tracking-widest mt-1">TUA</div>
            </div>
            </a>

            <nav class="flex-1 space-y-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 text-black hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                    </svg>
                    <span class="text-2xl font-bold">Dashboard</span>
                </a>

                <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-4 text-black hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="6" width="18" height="2"/><rect x="3" y="11" width="18" height="2"/><rect x="3" y="16" width="18" height="2"/>
                    </svg>
                    <span class="text-2xl font-bold">Kelola Menu</span>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center space-x-4 text-black hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="4" y="4" width="16" height="12" rx="1" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="8.5" cy="9" r="1.5"/><path d="M4 15l4-4 3 3 5-6 4 5v3H4z"/>
                    </svg>
                    <span class="text-2xl font-bold">Kelola Galeri</span>
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-4 text-black hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span class="text-2xl font-bold">Kelola Profil</span>
                </a>
            </nav>

            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center space-x-4 text-black hover:text-white transition-colors mt-auto">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                    </svg>
                    <span class="text-2xl font-bold">Logout</span>
                </a>
            </form>
        </div>

        <div class="flex-1 p-12">
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-bold text-gray-900">
                    BATATUA 1928 – <span class="font-normal">ADMIN PANEL</span>
                </h1>
                <div class="text-lg text-gray-700">Halo, {{ auth()->user()->name }}!</div>
            </div>

            {{ $slot }}

        </div>
    </div>

    @stack('scripts')

</body>
</html>