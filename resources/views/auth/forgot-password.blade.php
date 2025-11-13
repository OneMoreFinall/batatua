<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Lupa Password</title>

        <link rel="icon" href="{{ asset('Assets/Logo Kedai Batatua 1928.png') }}">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
            
            <div class="absolute inset-0 bg-black/70"></div>

            <div class="relative w-full sm:max-w-md p-8 bg-white shadow-xl overflow-hidden sm:rounded-lg z-10">
                
                <h2 class="text-center text-3xl font-bold text-gray-900 mb-2">
                    LUPA PASSWORD
                </h2>
                <p class="text-center text-sm text-gray-600 mb-6">
                    Masukkan email Anda untuk reset password.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-amber-500 focus:ring-amber-500" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="w-full justify-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Kirim Link Reset Password
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                            Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>