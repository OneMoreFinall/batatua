<section>
    <header>
        <h2 class="text-3xl font-bold text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-md text-gray-700">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <input type="hidden" name="return_route" value="admin.profile.edit">

        <div>
            <label for="name" class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-user mr-2 text-amber-600"></i>Nama
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
            @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-envelope mr-2 text-amber-600"></i>Email
            </label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>