<x-layouts.admin>
    <x-slot name="title">Kelola Profil</x-slot>

    <div class="bg-gradient-to-r from-amber-100 to-yellow-100 p-6 rounded-2xl mb-8 flex items-center justify-between shadow-xl animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">BATATUA 1928 - KELOLA PROFIL</h1>
            <p class="text-gray-700">Perbarui informasi profil dan password akun Anda.</p>
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-sm shadow-lg rounded-2xl animate-fade-in">
            <div class="max-w-xl">
                @include('admin.profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-sm shadow-lg rounded-2xl animate-fade-in">
            <div class="max-w-xl">
                @include('admin.profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-sm shadow-lg rounded-2xl animate-fade-in">
            <div class="max-w-xl">
                @include('admin.profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</x-layouts.admin>