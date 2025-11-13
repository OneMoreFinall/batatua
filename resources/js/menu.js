document.addEventListener("DOMContentLoaded", function() {
    
    const productGrid = document.getElementById('productGrid');
    const filterButtons = document.querySelectorAll('.category-btn');
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const noResults = document.getElementById('noResults');

    let currentCategory = 'all';
    let currentSearch = '';
    let debounceTimer;

    async function fetchMenus(category, search) {
        productGrid.innerHTML = '<p class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-500">Memuat menu...</p>';
        noResults.classList.remove('show');

        try {
            const url = new URL(window.location.origin + '/menu');
            url.searchParams.append('kategori', category);
            url.searchParams.append('search', search);

            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' 
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const menus = await response.json();
            productGrid.innerHTML = '';

            if (menus.length > 0) {
                menus.forEach(menu => {
                    productGrid.appendChild(createMenuCard(menu));
                });
            } else {
                noResults.classList.add('show');
            }

        } catch (error) {
            console.error('Fetch error:', error);
            productGrid.innerHTML = '<p class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-red-500">Gagal memuat menu. Coba refresh.</p>';
        }
    }

    function createMenuCard(menu) {
        const card = document.createElement('div');
        
        card.className = 'group relative product-card bg-gradient-to-br from-[#E2AE54] to-[#d4a050] rounded-2xl shadow-xl overflow-hidden group transition-all duration-500 cursor-pointer';
        card.dataset.category = menu.kategori;
        card.dataset.name = menu.nama.toLowerCase();
        
        card.addEventListener('click', function(event) {
            window.toggleCard(this, event);
        });

        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(menu.harga).replace('Rp', 'Rp ');
        
        let labelHtml = '';
        if (menu.label === 'hot') {
            labelHtml = `<div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg"><i class="fas fa-fire mr-1"></i>Hot</div>`;
        } else if (menu.label === 'best_seller') {
            labelHtml = `<div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg"><i class="fas fa-star mr-1"></i>Best Seller</div>`;
        }
        
        card.innerHTML = `
            <div class="relative overflow-hidden">
                <img src="/Assets/${menu.gambar}" alt="${menu.nama}" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                ${labelHtml}
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-white transition-colors">${menu.nama}</h3>
                <p class="text-2xl font-bold text-amber-900 group-hover:text-white transition-colors">${formattedPrice}</p>
            </div>

            <div class="absolute inset-0 bg-white/95 p-4 opacity-0 translate-x-5 scale-95 rounded-2xl transition-all duration-500 group-[.active]:opacity-100 group-[.active]:translate-x-0 group-[.active]:scale-100 pointer-events-none">
                <h4 class="font-semibold mb-2">Deskripsi</h4>
                <p class="text-sm">
                    ${menu.deskripsi || 'Deskripsi untuk menu ini belum tersedia.'}
                </p>
            </div>
        `;
        return card;
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(b => b.classList.remove('active', 'text-white', 'bg-gradient-to-r', 'from-amber-500', 'to-yellow-500'));
            filterButtons.forEach(b => {
                if (!b.classList.contains('active')) {
                    b.classList.add('text-gray-700', 'hover:text-amber-600', 'bg-white');
                }
            });
            
            this.classList.add('active', 'text-white', 'bg-gradient-to-r', 'from-amber-500', 'to-yellow-500');
            this.classList.remove('text-gray-700', 'hover:text-amber-600', 'bg-white');
            
            currentCategory = this.dataset.category;
            fetchMenus(currentCategory, currentSearch);
        });
    });

    searchInput.addEventListener('input', function() {
        currentSearch = this.value.toLowerCase().trim();
        if (currentSearch) {
            clearSearchBtn.classList.remove('hidden');
        } else {
            clearSearchBtn.classList.add('hidden');
        }
        
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchMenus(currentCategory, currentSearch);
        }, 300);
    });

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        currentSearch = '';
        this.classList.add('hidden');
        fetchMenus(currentCategory, currentSearch);
    });

    fetchMenus(currentCategory, currentSearch);
});