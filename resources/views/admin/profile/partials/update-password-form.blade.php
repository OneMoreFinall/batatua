<section>
    <header>
        <h2 class="text-3xl font-bold text-gray-900">
            Perbarui Password
        </h2>

        <p class="mt-1 text-md text-gray-700">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-lock mr-2 text-amber-600"></i>Password Saat Ini
            </label>
            <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                   class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-key mr-2 text-amber-600"></i>Password Baru
            </label>
            <input type="password" id="password" name="password" autocomplete="new-password"
                   class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
            @error('password', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-key mr-2 text-amber-600"></i>Konfirmasi Password Baru
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                   class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>

            @if (session('status') === 'password-updated')
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