document.addEventListener("DOMContentLoaded", function() {

    const container = document.getElementById('menu-management-container');
    if (!container) return; 

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
        errorContainer.classList.add('hidden');
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
        errorContainer.classList.add('hidden');
        
        modal.classList.add('active');
    }

    function closeModal() {
        modal.classList.remove('active');
        menuForm.reset();
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
                    window.showToast(result.message, formMethod.value === 'PUT' ? 'info' : 'success');
                    window.location.reload();
                }

            } catch (error) {
                console.error('Error:', error);
                window.showToast(error.message, 'error');
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

});