<x-layouts.admin>
    <x-slot name="title">Kelola Menu</x-slot>

    <style>
        .menu-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
         .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 20px;
        }
        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
            margin: auto;
        }
        .image-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>

    <div class="flex-1"
     id="menu-management-container"
     data-store-url="{{ route('admin.menu.store') }}"
     data-update-url-base="{{ route('admin.menu.index') }}"
     data-asset-base="{{ asset('Assets') }}"
     data-csrf-token="{{ csrf_token() }}"
    >
        @if (session('success'))
            <div class="bg-green-500 text-white text-center p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <div id="error-container" class="bg-red-500 text-white p-4 rounded-lg mb-6 hidden">
            <strong class="font-bold">Oops! Ada yang salah:</strong>
            <ul id="error-list" class="list-disc pl-5 mt-2"></ul>
        </div>

        <div class="bg-amber-100 p-6 rounded-lg mb-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">BATATUA 1928 - KELOLA MENU</h1>
            <button id="add-menu-btn" class="bg-yellow-700 hover:bg-yellow-300 text-white px-6 py-3 rounded-lg font-bold transition-colors">
                + Tambah Menu
            </button>
        </div>

        @forelse ($menus as $menu)
            @if ($loop->first)
                <div id="menuGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @endif

            <div class="menu-card bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('Assets/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800">{{ $menu->nama }}</h3>
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-orange-500 text-white">{{ $menu->kategori }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-amber-700">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                        <div class="flex space-x-2">
                            
                            <button data-menu='@json($menu)' class="edit-menu-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                                Edit
                            </button>
                            
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if ($loop->last)
                </div>
            @endif

        @empty
            <div id="emptyState" class="text-center py-16">
                <h2 class="text-3xl font-bold mb-4">Belum ada menu tersedia</h2>
                <p class="text-gray-600 mb-6">Silakan tambahkan menu baru untuk mulai mengelola daftar menu Anda.</p>
                <button id="add-menu-btn-empty" class="bg-yellow-700 hover:bg-yellow-300 text-white px-6 py-3 rounded-lg font-bold transition-colors">
                    + Tambah Menu
                </button>
            </div>
        @endforelse
    </div>

    <div id="menuModal" class="modal">
        <div class="modal-content bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <h2 id="modalTitle" class="text-2xl font-bold mb-6">Tambah Menu Baru</h2>
            
            <form id="menuForm">
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="menuId" name="menu_id">

                <div class="mb-4">
                    <label for="menuName" class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                    <input type="text" id="menuName" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="menuPrice" class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                    <input type="number" id="menuPrice" name="harga" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="menuCategory" class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select id="menuCategory" name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Pilih Kategori</option>
                        <option value="makanan-berat">Makanan Berat</option>
                        <option value="makanan-ringan">Makanan Ringan</option>
                        <option value="coffee">Coffee</option>
                        <option value="non-coffe">Non-Coffee</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="menuDeskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi Menu</label>
                    <textarea id="menuDeskripsi" name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Deskripsi singkat..."></textarea>
                </div>
                <div class="mb-6">
                    <label for="menuImage" class="block text-gray-700 font-bold mb-2">Foto Menu</label>
                    <input type="file" id="menuImage" name="gambar" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <div id="imagePreviewContainer" class="mt-3 hidden">
                        <img id="imagePreview" class="image-preview" src="" alt="Preview">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white py-2 rounded-lg font-bold transition-colors">
                        Simpan
                    </button>
                    <button type="button" id="cancel-modal-btn" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-2 rounded-lg font-bold transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const modal = document.getElementById('menuModal');
        const menuForm = document.getElementById('menuForm');
        const modalTitle = document.getElementById('modalTitle');
        const menuId = document.getElementById('menuId');
        const menuName = document.getElementById('menuName');
        const menuPrice = document.getElementById('menuPrice');
        const menuCategory = document.getElementById('menuCategory');
        const menuDeskripsi = document.getElementById('menuDeskripsi');
        const menuImage = document.getElementById('menuImage');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const formMethod = document.getElementById('formMethod');
        const errorContainer = document.getElementById('error-container');
        const errorList = document.getElementById('error-list');

        const container = document.getElementById('menu-management-container');
        
        if (!container) return; 

        const storeUrl = container.dataset.storeUrl;
        const updateUrlBase = container.dataset.updateUrlBase;
        const assetBase = container.dataset.assetBase;
        const csrfToken = container.dataset.csrfToken;

        
        function openAddModal() {
            menuForm.reset();
            modalTitle.textContent = 'Tambah Menu Baru';
            menuForm.action = storeUrl;
            formMethod.value = "POST";
            menuId.value = "";
            imagePreviewContainer.classList.add('hidden');
            modal.classList.add('active');
        }

        function openEditModal(menu) {
            menuForm.reset();
            modalTitle.textContent = 'Edit Menu: ' + menu.nama;
            menuForm.action = updateUrlBase + '/' + menu.id;
            formMethod.value = "PUT";
            
            menuId.value = menu.id;
            menuName.value = menu.nama;
            menuPrice.value = menu.harga;
            menuCategory.value = menu.kategori;
            menuDeskripsi.value = menu.deskripsi || '';

            imagePreview.src = assetBase + '/' + menu.gambar;
            imagePreviewContainer.classList.remove('hidden');
            
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
            menuForm.reset();
            imagePreviewContainer.classList.add('hidden');
            errorContainer.classList.add('hidden');
        }

        const addMenuBtn = document.getElementById('add-menu-btn');
        if (addMenuBtn) {
            addMenuBtn.addEventListener('click', openAddModal);
        }
        
        const addMenuBtnEmpty = document.getElementById('add-menu-btn-empty');
        if (addMenuBtnEmpty) {
            addMenuBtnEmpty.addEventListener('click', openAddModal);
        }

        document.querySelectorAll('.edit-menu-btn').forEach(button => {
            button.addEventListener('click', function() {
                const menuData = JSON.parse(this.dataset.menu);
                openEditModal(menuData);
            });
        });

        const cancelModalBtn = document.getElementById('cancel-modal-btn');
        if (cancelModalBtn) {
            cancelModalBtn.addEventListener('click', closeModal);
        }
        
        if (menuImage) {
            menuImage.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        imagePreview.src = event.target.result;
                        imagePreviewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            };
        }

        if (menuForm) {
            menuForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorContainer.classList.add('hidden');

                const formData = new FormData(menuForm);
                
                if (formMethod.value === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                try {
                    const response = await fetch(menuForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        if (response.status === 422) {
                            errorList.innerHTML = '';
                            for (const key in result.errors) {
                                const li = document.createElement('li');
                                li.textContent = result.errors[key][0];
                                errorList.appendChild(li);
                            }
                            errorContainer.classList.remove('hidden');
                        } else {
                            throw new Error(result.message || 'Terjadi kesalahan');
                        }
                    } else {
                        closeModal();
                        alert(result.message);
                        window.location.reload();
                    }

                } catch (error) {
                    console.error('Error:', error);
                    errorList.innerHTML = '<li>' + error.message + '</li>';
                    errorContainer.classList.remove('hidden');
                }
            });
        }

        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
    });
</script>