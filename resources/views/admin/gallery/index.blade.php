<x-layouts.admin>
    <x-slot name="title">Kelola Galeri</x-slot>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        .gallery-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .gallery-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
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
        .lightbox {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }
        .lightbox.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(255, 255, 255, 0.3);
        }
    </style>

    <div class="flex-1"
         id="gallery-management-container"
         data-store-url="{{ route('admin.gallery.store') }}"
         data-update-url-base="{{ route('admin.gallery.index') }}"
         data-asset-base="{{ asset('Assets') }}"
         data-csrf-token="{{ csrf_token() }}"
    >
        
        <div id="error-container" class="bg-red-500 text-white p-4 rounded-lg mb-6 hidden">
            <strong class="font-bold">Oops! Ada yang salah:</strong>
            <ul id="error-list" class="list-disc pl-5 mt-2"></ul>
        </div>

        <div class="bg-gradient-to-r from-amber-100 to-yellow-100 p-6 rounded-2xl mb-8 flex items-center justify-between shadow-xl animate-fade-in">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">BATATUA 1928 - KELOLA GALERI</h1>
                <p class="text-gray-700">Kelola foto-foto galeri kedai</p>
            </div>
            <button id="add-gallery-btn" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>Tambah Gambar
            </button>
        </div>

        @if ($images->isEmpty())
        <div id="emptyState" class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg">
            <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum ada gambar di galeri</h3>
            <p class="text-gray-500 mb-6">Klik tombol "Tambah Gambar" untuk menambahkan galeri baru</p>
            <button id="add-gallery-btn-empty" class="bg-gradient-to-r from-amber-600 to-yellow-600 text-white px-8 py-3 rounded-xl font-bold hover:from-amber-700 hover:to-yellow-700 transition-all">
                <i class="fas fa-plus mr-2"></i>Tambah Gambar Pertama
            </button>
        </div>
        @endif

        <div id="galleryGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($images as $image)
                <div class="gallery-card bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" data-id="{{ $image->id }}">
                    <div class="relative group">
                        <img src="{{ asset('Assets/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-64 object-cover cursor-pointer" onclick="openLightbox('{{ asset('Assets/' . $image->image_path) }}')">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <button onclick="openLightbox('{{ asset('Assets/' . $image->image_path) }}')" class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all">
                                <i class="fas fa-expand mr-2"></i>Lihat Detail
                            </button>
                        </div>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">{{ $image->title }}</h3>
                        <div class="flex space-x-2">
                            <button data-image='@json($image)' class="edit-gallery-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="galleryModal" class="modal" onclick="if(event.target === this) closeModal()">
        <div class="bg-white rounded-3xl p-8 max-w-2xl w-full mx-4 modal-content shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modalTitle" class="text-3xl font-bold text-gray-900">Tambah Gambar Baru</h2>
                <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="galleryForm">
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="galleryId" name="gallery_id">

                <div class="mb-6">
                    <label for="galleryTitle" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-heading mr-2 text-amber-600"></i>Judul Gambar
                    </label>
                    <input type="text" id="galleryTitle" name="title" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all" required>
                </div>
                <div class="mb-6">
                    <label for="galleryImage" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-image mr-2 text-amber-600"></i>Pilih Gambar
                    </label>
                    <input type="file" id="galleryImage" name="gambar" accept="image/*" class="w-full px-4 py-3 rounded-xl border-2 border-amber-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-300 transition-all">
                    <div id="imagePreviewContainer" class="mt-3 hidden">
                        <img id="imagePreview" class="image-preview" src="" alt="Preview">
                    </div>
                </div>
                <div class="flex space-x-4">
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

    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="Gallery Image">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-amber-400 transition-colors bg-black/50 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
    </div>

</x-layouts.admin>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    const container = document.getElementById('gallery-management-container');
    if (!container) return; 

    const storeUrl = container.dataset.storeUrl;
    const updateUrlBase = container.dataset.updateUrlBase;
    const assetBase = container.dataset.assetBase;
    const csrfToken = container.dataset.csrfToken;

    const modal = document.getElementById('galleryModal');
    const galleryForm = document.getElementById('galleryForm');
    const modalTitle = document.getElementById('modalTitle');
    const galleryId = document.getElementById('galleryId');
    const galleryTitle = document.getElementById('galleryTitle');
    const galleryImage = document.getElementById('galleryImage');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const formMethod = document.getElementById('formMethod');
    const errorContainer = document.getElementById('error-container');
    
    function openAddModal() {
        galleryForm.reset();
        modalTitle.textContent = 'Tambah Gambar Baru';
        galleryForm.action = storeUrl;
        formMethod.value = "POST";
        galleryId.value = "";
        galleryImage.required = true;
        imagePreviewContainer.classList.add('hidden');
        modal.classList.add('active');
    }

    function openEditModal(image) {
        galleryForm.reset();
        modalTitle.textContent = 'Edit Gambar';
        galleryForm.action = `${updateUrlBase}/${image.id}`;
        formMethod.value = "PUT";
        
        galleryId.value = image.id;
        galleryTitle.value = image.title;
        
        imagePreview.src = `${assetBase}/${image.image_path}`;
        imagePreviewContainer.classList.remove('hidden');
        galleryImage.required = false;
        
        modal.classList.add('active');
    }

    window.closeModal = function() {
        modal.classList.remove('active');
        galleryForm.reset();
    }

    document.getElementById('add-gallery-btn').addEventListener('click', openAddModal);
    const addBtnEmpty = document.getElementById('add-gallery-btn-empty');
    if (addBtnEmpty) {
        addBtnEmpty.addEventListener('click', openAddModal);
    }
    document.getElementById('cancel-modal-btn').addEventListener('click', closeModal);
    document.getElementById('close-modal-btn').addEventListener('click', closeModal);

    document.querySelectorAll('.edit-gallery-btn').forEach(button => {
        button.addEventListener('click', function() {
            const imageData = JSON.parse(this.dataset.image);
            openEditModal(imageData);
        });
    });

    galleryImage.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                imagePreview.src = evt.target.result;
                imagePreviewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    };

    galleryForm.onsubmit = async function(e) {
        e.preventDefault();
        
        if (!galleryForm.checkValidity()) {
            galleryForm.reportValidity();
            return;
        }
        
        const formData = new FormData(galleryForm);
        if (formMethod.value === 'PUT') {
            formData.append('_method', 'PUT');
        }

        try {
            const response = await fetch(galleryForm.action, {
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
                    const errors = Object.values(result.errors).join('\n');
                    window.showToast(errors, 'error');
                } else {
                    throw new Error(result.message || 'Terjadi kesalahan');
                }
            } else {
                closeModal();
                window.showToast(result.message, formMethod.value === 'PUT' ? 'info' : 'success');
                window.location.reload(); 
            }

        } catch (error) {
            console.error('Error:', error);
            window.showToast(error.message, 'error');
        }
    };
    
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            window.showConfirmModal('Apakah Anda yakin ingin menghapus gambar ini?', () => {
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: new FormData(form) 
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        window.showToast(result.message, 'error');
                        form.closest('.gallery-card').remove();
                    } else {
                        window.showToast(result.message || 'Gagal menghapus', 'error');
                    }
                })
                .catch(error => {
                    console.error('Delete Error:', error);
                    window.showToast('Gagal menghapus gambar.', 'error');
                });
            });
        });
    });

    window.openLightbox = function(src) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        if (lightbox && lightboxImg) {
            lightboxImg.src = src;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    window.closeLightbox = function() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeLightbox();
        }
    });

});
</script>