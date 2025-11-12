<x-layouts.admin>
    <x-slot name="title">Admin Dashboard</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm mb-1">Total Menu</p>
                    <p class="text-4xl font-bold">{{ $totalMenu }}</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-utensils text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-arrow-up mr-2"></i>
                <span>{{ $totalMenu }} menu</span>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl animate-fade-in" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm mb-1">Total Galeri</p>
                    <p class="text-4xl font-bold">{{ $totalGaleri }}</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-images text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-arrow-up mr-2"></i>
                <span>{{ $totalGaleri }} foto</span>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm mb-1">Pengunjung</p>
                    <p class="text-4xl font-bold">1.2K</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-arrow-up mr-2"></i>
                <span>+15% hari ini</span>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-amber-500 to-yellow-500 rounded-2xl p-6 text-white shadow-xl animate-fade-in" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm mb-1">Pendapatan</p>
                    <p class="text-4xl font-bold">Rp 12 jt</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-3xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <i class="fas fa-arrow-up mr-2"></i>
                <span>+8% bulan ini</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center">
                <i class="fas fa-chart-line mr-3 text-amber-800"></i>Statistik Kedai
            </h2>
            <div class="flex items-center gap-8">
                <div class="w-32 h-32 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-utensils text-5xl text-amber-900"></i>
                </div>
                <div>
                    <div class="text-6xl font-bold text-gray-900 mb-2">{{ $totalMenu }}</div>
                    <div class="text-2xl font-semibold text-gray-800 mb-1">Menu</div>
                    <div class="text-sm text-gray-700">Menu siap disajikan</div>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-amber-800/30">
                <canvas id="menuChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.2s">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center">
                <i class="fas fa-history mr-3 text-amber-800"></i>Aktivitas Kedai
            </h2>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <div class="activity-item flex items-center gap-4 p-4 bg-white/20 backdrop-blur-sm rounded-xl cursor-pointer">
                    <div class="w-3 h-3 bg-green-500 rounded-full flex-shrink-0 animate-pulse"></div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-gray-900">Admin menambahkan menu baru</p>
                        <p class="text-sm text-gray-700">Menu "Es Cokelat Jadoel" ditambahkan</p>
                        <span class="text-xs text-gray-600">2 jam lalu</span>
                    </div>
                </div>
                <div class="activity-item flex items-center gap-4 p-4 bg-white/20 backdrop-blur-sm rounded-xl cursor-pointer">
                    <div class="w-3 h-3 bg-blue-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-gray-900">Admin memperbarui profil kedai</p>
                        <p class="text-sm text-gray-700">Informasi jam operasional diperbarui</p>
                        <span class="text-xs text-gray-600">3 jam lalu</span>
                    </div>
                </div>
                <div class="activity-item flex items-center gap-4 p-4 bg-white/20 backdrop-blur-sm rounded-xl cursor-pointer">
                    <div class="w-3 h-3 bg-amber-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-gray-900">Admin menghapus foto galeri</p>
                        <p class="text-sm text-gray-700">Foto lama dihapus dari galeri</p>
                        <span class="text-xs text-gray-600">10 jam lalu</span>
                    </div>
                </div>
                <div class="activity-item flex items-center gap-4 p-4 bg-white/20 backdrop-blur-sm rounded-xl cursor-pointer">
                    <div class="w-3 h-3 bg-purple-500 rounded-full flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-gray-900">Menu populer hari ini</p>
                        <p class="text-sm text-gray-700">Mie Bangladesh menjadi menu terlaris</p>
                        <span class="text-xs text-gray-600">1 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.4s">
        <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center flex items-center justify-center">
            <i class="fas fa-sticky-note mr-3 text-amber-800"></i>Catatan Admin
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl hover:bg-white/40 transition-all cursor-pointer">
                <div class="font-semibold text-gray-900 text-lg">Update harga menu</div>
            </div>
            <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl hover:bg-white/40 transition-all cursor-pointer">
                <div class="font-semibold text-gray-900 text-lg">Update penghasilan</div>
            </div>
            <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl hover:bg-white/40 transition-all cursor-pointer">
                <div class="font-semibold text-gray-900 text-lg">Data bahan baku</div>
            </div>
            <div class="bg-white/30 backdrop-blur-sm p-6 rounded-xl hover:bg-white/40 transition-all cursor-pointer">
                <div class="font-semibold text-gray-900 text-lg">Upload story IG baru</div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('menuChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Menu Terjual',
                            data: [45, 52, 48, 61, 55, 78, 85],
                            borderColor: 'rgb(146, 64, 14)',
                            backgroundColor: 'rgba(146, 64, 14, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(146, 64, 14, 0.1)'
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(146, 64, 14, 0.1)'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
    
</x-layouts.admin>