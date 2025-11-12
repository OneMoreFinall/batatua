<x-layouts.admin>
    <x-slot name="title">Kelola Menu</x-slot>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        .menu-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .menu-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            z-index: 1000;
        }
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }
        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
            margin: auto;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .image-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
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

        <div class="bg-gradient-to-r from-amber-100 to-yellow-100 p-6 rounded-2xl mb-8 flex items-center justify-between shadow-xl animate-fade-in">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">BATATUA 1928 - KELOLA MENU</h1>
                <p class="text-gray-700">Kelola menu makanan dan minuman kedai</p>
            </div>
            <button id="add-menu-btn" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>Tambah Menu
            </button>
        </div>

        <div class="mb-8 bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg animate-fade-in">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari menu..."
                        class="w-full px-6 py-3 pl-12 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all"
                    >
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-amber-500"></i>
                </div>
                <select id="categoryFilter" class="px-6 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
                    <option value="all">Semua Kategori</option>
                    <option value="makanan-berat">Makanan Berat</option>
                    <option value="makanan-ringan">Makanan Ringan</option>
                    <option value="coffee">Coffee</option>
                    <option value="non-coffe">Non Coffee</option>
                </select>
            </div>
        </div>

        <div id="emptyState" class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hidden">
            <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum ada menu</h3>
            <p class="text-gray-500 mb-6">Klik tombol "Tambah Menu" untuk menambahkan menu baru</p>
            <button id="add-menu-btn-empty" class="bg-gradient-to-r from-amber-600 to-yellow-600 text-white px-8 py-3 rounded-xl font-bold hover:from-amber-700 hover:to-yellow-700 transition-all">
                <i class="fas fa-plus mr-2"></i>Tambah Menu Pertama
            </button>
        </div>

        <div id="menuGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($menus as $menu)
                <div class="menu-card bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" 
                     data-id="{{ $menu->id }}" 
                     data-name="{{ strtolower($menu->nama) }}" 
                     data-category="{{ $menu->kategori }}">
                    
                    <img src="{{ asset('Assets/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-800">{{ $menu->nama }}</h3>
                            <span class="category-badge bg-orange-500 text-white">{{ $menu->kategori }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-amber-700">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                            <div class="flex space-x-2">
                                <button data-menu='@json($menu)' class="edit-menu-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="menuModal" class="modal" onclick="if(event.target === this) closeModal()">
        <div class="bg-white rounded-3xl p-8 max-w-2xl w-full mx-4 modal-content shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="text-3xl font-bold text-gray-900">Tambah Menu Baru</h2>
                <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="menuForm">
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="menuId" name="menu_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="menuName" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-utensils mr-2 text-amber-600"></i>Nama Menu
                        </label>
                        <input type="text" id="menuName" name="nama" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all" required>
                    </div>
                    <div>
                        <label for="menuPrice" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-tag mr-2 text-amber-600"></i>Harga (Rp)
                        </label>
                        <input type="number" id="menuPrice" name="harga" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all" required min="0">
                    </div>
                    <div>
                        <label for="menuCategory" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-list mr-2 text-amber-600"></i>Kategori
                        </label>
                        <select id="menuCategory" name="kategori" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all" required>
                            <option value="">Pilih Kategori</option>
                            <option value="makanan-berat">Makanan Berat</option>
                            <option value="makanan-ringan">Makanan Ringan</option>
                            <option value="coffee">Coffee</option>
                            <option value="non-coffe">Non Coffee</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="menuDeskripsi" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-align-left mr-2 text-amber-600"></i>Deskripsi
                        </label>
                        <textarea id="menuDeskripsi" name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all" placeholder="Deskripsi singkat..."></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="menuImage" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-image mr-2 text-amber-600"></i>Foto Menu
                        </label>
                        <input type="file" id="menuImage" name="gambar" accept="image/*" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
                        <div id="imagePreviewContainer" class="mt-3 hidden">
                            <img id="imagePreview" class="image-preview" src="" alt="Preview">
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 mt-6">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <button type="button" id="cancel-modal-btn" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-3 rounded-xl font-bold transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const container = document.getElementById('menu-management-container');
    if (!container) return; 

    const storeUrl = container.dataset.storeUrl;
    const updateUrlBase = container.dataset.updateUrlBase;
    const assetBase = container.dataset.assetBase;
    const csrfToken = container.dataset.csrfToken;

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
    const menuGrid = document.getElementById('menuGrid');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    
    let allMenus = @json($menus);
    let debounceTimer;

    function getCategoryColor(category) {
        const colors = {
            'makanan-berat': 'bg-orange-500',
            'makanan-ringan': 'bg-yellow-500',
            'coffee': 'bg-amber-700',
            'non-coffe': 'bg-blue-500'
        };
        return colors[category] || 'bg-gray-500';
    }

    function getCategoryName(category) {
        const names = {
            'makanan-berat': 'Makanan Berat',
            'makanan-ringan': 'Makanan Ringan',
            'coffee': 'Coffee',
            'non-coffe': 'Non Coffee'
        };
        return names[category] || category;
    }
    
    function formatPrice(price) {
        return Number(price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    function createMenuCard(menu) {
        const card = document.createElement('div');
        card.className = 'menu-card bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in';
        card.dataset.id = menu.id;
        card.dataset.name = menu.nama.toLowerCase();
        card.dataset.category = menu.kategori;

        const colorClass = getCategoryColor(menu.kategori);
        const imageHtml = menu.gambar ? 
            `<img src="${assetBase}/${menu.gambar}" alt="${menu.nama}" class="w-full h-48 object-cover">` : 
            `<div class="w-full h-48 bg-gradient-to-br from-amber-200 to-yellow-200 flex items-center justify-center"><i class="fas fa-image text-6xl text-amber-400"></i></div>`;

        card.innerHTML = imageHtml + `
            <div class="p-6">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-xl font-bold text-gray-800">${menu.nama}</h3>
                    <span class="category-badge ${colorClass} text-white">${getCategoryName(menu.kategori)}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-amber-700">Rp ${formatPrice(menu.harga)}</span>
                    <div class="flex space-x-2">
                        <button data-menu='${JSON.stringify(menu)}' class="edit-menu-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <form action="${updateUrlBase}/${menu.id}" method="POST" class="delete-form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        card.querySelector('.edit-menu-btn').addEventListener('click', function() {
            openEditModal(menu);
        });
        
        card.querySelector('.delete-form').addEventListener('submit', function(e) {
            e.preventDefault();
            window.showConfirmModal('Apakah Anda yakin ingin menghapus menu ini?', () => {
                this.submit();
            });
        });

        return card;
    }

    function renderMenus() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        
        const filteredMenus = allMenus.filter(menu => {
            const matchesSearch = menu.nama.toLowerCase().includes(searchTerm);
            const matchesCategory = category === 'all' || menu.category === category;
            return matchesSearch && matchesCategory;
        });

        menuGrid.innerHTML = '';
        if (filteredMenus.length === 0) {
            menuGrid.style.display = 'none';
            emptyState.classList.remove('hidden');
        } else {
            menuGrid.style.display = 'grid';
            emptyState.classList.add('hidden');
            filteredMenus.forEach(menu => {
                menuGrid.appendChild(createMenuCard(menu));
            });
        }
    }

    function openAddModal() {
        menuForm.reset();
        modalTitle.textContent = 'Tambah Menu Baru';
        menuForm.action = storeUrl;
        formMethod.value = "POST";
        menuId.value = "";
        imagePreviewContainer.classList.add('hidden');
        errorContainer.classList.add('hidden');
        menuImage.required = true;
        modal.classList.add('active');
    }

    function openEditModal(menu) {
        menuForm.reset();
        modalTitle.textContent = 'Edit Menu';
        menuForm.action = `${updateUrlBase}/${menu.id}`;
        formMethod.value = "PUT";
        
        menuId.value = menu.id;
        menuName.value = menu.nama;
        menuPrice.value = menu.harga;
        menuCategory.value = menu.kategori;
        menuDeskripsi.value = menu.deskripsi || '';
        
        if (menu.gambar) {
            imagePreview.src = `${assetBase}/${menu.gambar}`;
            imagePreviewContainer.classList.remove('hidden');
        } else {
            imagePreviewContainer.classList.add('hidden');
        }
        
        errorContainer.classList.add('hidden');
        menuImage.required = false;
        modal.classList.add('active');
    }

    function closeModal() {
        modal.classList.remove('active');
        menuForm.reset();
    }

    document.getElementById('add-menu-btn').addEventListener('click', openAddModal);
    const addBtnEmpty = document.getElementById('add-menu-btn-empty');
    if (addBtnEmpty) {
        addBtnEmpty.addEventListener('click', openAddModal);
    }
    document.getElementById('cancel-modal-btn').addEventListener('click', closeModal);
    
    const closeModalButton = document.getElementById('close-modal-btn');
    if(closeModalButton) {
        closeModalButton.addEventListener('click', closeModal);
    }

    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(renderMenus, 300);
    });
    categoryFilter.addEventListener('change', renderMenus);

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

            if (!menuForm.checkValidity()) {
                menuForm.reportValidity();
                return;
            }
            
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
                    
                    if (formMethod.value === 'PUT') {
                        const updatedMenu = result.menu;
                        const menuIndex = allMenus.findIndex(m => m.id === updatedMenu.id);
                        if (menuIndex > -1) {
                            allMenus[menuIndex] = updatedMenu;
                        }
                        window.showToast(result.message, 'info');
                    } else {
                        const newMenu = result.menu;
                        allMenus.push(newMenu);
                        window.showToast(result.message, 'success');
                    }
                    
                    renderMenus();
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
    
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            window.showConfirmModal('Apakah Anda yakin ingin menghapus menu ini?', () => {
                form.submit();
            });
        });
    });

    renderMenus();
});
</script>