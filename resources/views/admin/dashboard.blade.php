<x-layouts.admin>

    <div id="dashboard-content">
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div class="bg-[#e5c98f] rounded-3xl p-10">
                <h2 class="text-3xl font-bold mb-8 text-gray-900">Statistik Kedai</h2>
                <div class="flex items-center gap-8">
                    <div class="w-28 h-28 bg-[#f5e5c3] rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-6xl font-bold text-gray-900">12</div>
                        <div class="text-xl font-semibold text-gray-900">menu</div>
                        <div class="text-sm text-gray-700">menu siap disajikan</div>
                    </div>
                </div>
            </div>

            <div class="bg-[#e5c98f] rounded-3xl p-10">
                <h2 class="text-3xl font-bold mb-8 text-gray-900">Aktivitas Kedai</h2>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-3 h-3 bg-gray-900 rounded-full flex-shrink-0"></div>
                        <div class="flex-1 flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Admin menambahkan menu baru</span>
                            <span class="text-sm text-gray-700 whitespace-nowrap ml-4">2 jam lalu</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-3 h-3 bg-gray-900 rounded-full flex-shrink-0"></div>
                        <div class="flex-1 flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Admin memperbarui profil kedai</span>
                            <span class="text-sm text-gray-700 whitespace-nowrap ml-4">3 jam lalu</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-3 h-3 bg-gray-900 rounded-full flex-shrink-0"></div>
                        <div class="flex-1 flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Admin menghapus foto galeri</span>
                            <span class="text-sm text-gray-700 whitespace-nowrap ml-4">10 jam lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#e5c98f] rounded-3xl p-10">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center">Catatan Admin</h2>
            <div class="space-y-3 text-lg text-gray-900">
                <div class="font-semibold">1. Update harga menu</div>
                <div class="font-semibold">2. Update penghasilan</div>
                <div class="font-semibold">3. Data bahan baku</div>
                <div class="font-semibold">4. upload story ig baru</div>
            </div>
        </div>
    </div>

</x-layouts.admin>