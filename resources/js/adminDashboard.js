document.addEventListener("DOMContentLoaded", function() {

    const noteContainer = document.getElementById('notes-container');
    if (noteContainer) {
        const modal = document.getElementById('noteModal');
        const noteForm = document.getElementById('noteForm');
        const modalTitle = document.getElementById('noteModalTitle');
        const noteId = document.getElementById('noteId');
        const noteContent = document.getElementById('noteContent');
        const formMethod = document.getElementById('noteFormMethod');
        const errorContainer = document.getElementById('note-error-container');
        const errorMessage = document.getElementById('note-error-message');
        const notesGrid = document.getElementById('notes-grid');
        
        const storeUrl = noteContainer.dataset.storeUrl;
        const updateUrlBase = noteContainer.dataset.updateUrlBase;
        const csrfToken = noteContainer.dataset.csrfToken;

        function openAddModal() {
            noteForm.reset();
            modalTitle.textContent = 'Tambah Catatan Baru';
            noteForm.action = storeUrl;
            formMethod.value = "POST";
            noteId.value = "";
            errorContainer.classList.add('hidden');
            modal.classList.add('active');
        }

        function openEditModal(note) {
            noteForm.reset();
            modalTitle.textContent = 'Edit Catatan';
            noteForm.action = `${updateUrlBase}/${note.id}`;
            formMethod.value = "PUT";
            noteId.value = note.id;
            noteContent.value = note.content;
            errorContainer.classList.add('hidden');
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
            noteForm.reset();
        }

        document.getElementById('add-note-btn').addEventListener('click', openAddModal);
        document.getElementById('cancel-note-btn').addEventListener('click', closeModal);

        notesGrid.addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-note-btn')) {
                const noteData = JSON.parse(e.target.dataset.note);
                openEditModal(noteData);
            }
            
            if (e.target.classList.contains('delete-note-btn')) {
                const id = e.target.dataset.id;
                const cardElement = e.target.closest('.note-card');
                
                window.showConfirmModal('Apakah Anda yakin ingin menghapus catatan ini?', () => {
                    deleteNote(id, cardElement);
                });
            }
        });

        noteForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            errorContainer.classList.add('hidden');

            const formData = new FormData(noteForm);
            if (formMethod.value === 'PUT') {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(noteForm.action, {
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
                        errorMessage.textContent = result.errors.content[0];
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

        async function deleteNote(id, cardElement) {
            const formData = new FormData();
            formData.append('_method', 'DELETE');

            try {
                const response = await fetch(`${updateUrlBase}/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menghapus');
                }
                
                cardElement.remove();
                window.showToast(result.message, 'error');

            } catch (error) {
                console.error('Error:', error);
                window.showToast(error.message, 'error');
            }
        }
    }

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