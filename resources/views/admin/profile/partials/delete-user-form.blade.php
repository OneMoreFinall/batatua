<section class="space-y-6">
    <header>
        <h2 class="text-3xl font-bold text-gray-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-md text-gray-700">
            Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Harap berhati-hati.
        </p>
    </header>

    {{-- Tombol Trigger --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105"
    >
        <i class="fas fa-trash-alt mr-2"></i>Hapus Akun
    </button>

    {{-- KEMBALI KE CODINGAN STANDARD (Tanpa Template Teleport Disini) --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-gray-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-md text-gray-700">
                Semua data akan dihapus permanen. Masukkan password Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-6">
                <label for="password_delete" class="block text-gray-700 font-bold mb-2">
                    <i class="fas fa-lock mr-2 text-gray-600"></i>Password
                </label>
                
                <input
                    id="password_delete"
                    name="password"
                    type="password"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all"
                    placeholder="Password"
                >
                
                @error('password', 'userDeletion')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-3 rounded-xl font-bold transition-all duration-300">
                    Batal
                </button>

                <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-3 rounded-xl font-bold transition-all duration-300">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>