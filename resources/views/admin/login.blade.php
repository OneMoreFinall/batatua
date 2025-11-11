<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Batatua - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('Assets/Hero Image (1).png') }}');">
            <div class="absolute inset-0 bg-white/40 backdrop-blur-sm"></div>
        </div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-5xl font-bold text-gray-900 mb-2">ADMIN LOGIN</h1>
                </div>

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
                    @csrf 

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ $errors->first('email') }}</span>
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block text-lg font-semibold text-gray-900 mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email" 
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 bg-white focus:outline-none focus:border-gray-400 text-gray-900"
                            required 
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-lg font-semibold text-gray-900 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password" 
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 bg-white focus:outline-none focus:border-gray-400 text-gray-900 pr-12"
                                required
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800"
                            >
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                    <line id="eyeSlash" x1="2" y1="2" x2="22" y2="22" stroke="transparent"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="font-semibold text-gray-800 hover:text-black">
                            Lupa Password?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-lg transition-colors duration-200 text-lg"
                    >
                        LOGIN
                    </button>

                </form> 
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeSlash = document.getElementById('eyeSlash');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeSlash.setAttribute('stroke', 'currentColor');
            } else {
                passwordInput.type = 'password';
                eyeSlash.setAttribute('stroke', 'transparent');
            }
        }
    </script>
</body>
</html>