<x-layouts.admin>
    <x-slot name="title">Admin Dashboard</x-slot>
    
    <style>
        .modal { display: none; }
        .modal.active { display: flex; }
    </style>

    <div class="bg-gradient-to-r from-amber-100 to-yellow-100 p-6 rounded-2xl mb-8 flex items-center justify-between shadow-xl animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Dashboard</h1>
            <p class="text-gray-700">Selamat datang kembali, {{ auth()->user()->name }}!</p>
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
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
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center">
                <i class="fas fa-chart-bar mr-3 text-amber-800"></i>Aktivitas 7 Hari Terakhir
            </h2>
            <div class="mt-6 pt-6 border-t border-amber-800/30">
                <canvas id="activityChart" width="400" height="300"></canvas>
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.2s">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center">
                <i class="fas fa-history mr-3 text-amber-800"></i>Aktivitas Kedai
            </h2>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                
                @forelse ($activities as $activity)
                    <div class="activity-item flex items-center gap-4 p-4 bg-white/20 backdrop-blur-sm rounded-xl cursor-pointer">
                        
                        @if ($activity->action_type == 'add')
                            <div class="w-3 h-3 bg-green-500 rounded-full flex-shrink-0 animate-pulse"></div>
                        @elseif ($activity->action_type == 'edit')
                            <div class="w-3 h-3 bg-blue-500 rounded-full flex-shrink-0"></div>
                        @else
                            <div class="w-3 h-3 bg-red-500 rounded-full flex-shrink-0"></div>
                        @endif
                        
                        <div class="flex-1">
                            <p class="text-lg font-semibold text-gray-900">{{ $activity->description }}</p>
                            <span class="text-xs text-gray-600">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-700 py-4">
                        <p>Belum ada aktivitas.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-[#e5c98f] to-[#d4b87a] rounded-3xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.4s"
         id="notes-container"
         data-store-url="{{ route('admin.notes.store') }}"
         data-update-url-base="{{ route('admin.notes.index') }}"
         data-csrf-token="{{ csrf_token() }}"
    >
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-sticky-note mr-3 text-amber-800"></i>Catatan Admin
            </h2>
            <button id="add-note-btn" class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-5 py-2 rounded-lg font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-lg transform hover:scale-105">
                + Tambah Catatan
            </button>
        </div>

        <div id="notes-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($adminNotes as $note)
                <div class="note-card bg-white/30 backdrop-blur-sm p-6 rounded-xl hover:bg-white/40 transition-all flex flex-col">
                    <p class="font-semibold text-gray-900 text-lg flex-1">{{ $note->content }}</p>
                    <div class="text-xs text-gray-700 mt-4 pt-2 border-t border-amber-800/30 flex justify-between items-center">
                        <span>{{ $note->created_at->format('d M Y') }}</span>
                        <div>
                            <button class="edit-note-btn text-blue-600 hover:text-blue-800 mr-2" data-note='@json($note)'>Edit</button>
                            <button class="delete-note-btn text-red-600 hover:text-red-800" data-id="{{ $note->id }}">Hapus</button>
                        </div>
                    </div>
                </div>
            @empty
                <p id="no-notes-message" class="col-span-4 text-center text-gray-700">Belum ada catatan. Klik 'Tambah Catatan' untuk memulai.</p>
            @endforelse
        </div>
    </div>
    
    <div id="noteModal" class="modal fixed top-0 left-0 w-full h-full bg-black/50 z-50 items-center justify-center p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md animate-fade-in">
            <h2 id="noteModalTitle" class="text-2xl font-bold mb-4">Tambah Catatan Baru</h2>
            <form id="noteForm">
                <input type="hidden" id="noteFormMethod" name="_method" value="POST">
                <input type="hidden" id="noteId" name="note_id">
                
                <div id="note-error-container" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 hidden">
                    <p id="note-error-message"></p>
                </div>
                
                <div>
                    <label for="noteContent" class="block text-gray-700 font-semibold mb-2">Isi Catatan</label>
                    <textarea id="noteContent" name="content" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <div class="flex space-x-4 mt-6">
                    <button type="submit" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white py-2 rounded-lg font-bold transition-colors">
                        Simpan
                    </button>
                    <button type="button" id="cancel-note-btn" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-2 rounded-lg font-bold transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('activityChart');
                if (ctx) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($activityLabels),
                            datasets: [{
                                label: 'Total Aktivitas',
                                data: @json($activityData),
                                backgroundColor: 'rgba(146, 64, 14, 0.6)',
                                borderColor: 'rgb(146, 64, 14)',
                                borderWidth: 2
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
                                    ticks: {
                                        stepSize: 1
                                    },
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
        @vite('resources/js/adminDashboard.js')
    @endpush
    
</x-layouts.admin>