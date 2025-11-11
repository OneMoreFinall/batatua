document.addEventListener("DOMContentLoaded", function() {
    
    const productGrid = document.getElementById('productGrid');
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    async function fetchMenus(category = 'all') {
        productGrid.innerHTML = '<p class="col-span-4 text-center text-gray-500">Memuat menu...</p>';

        try {
            const response = await fetch(`/menu?kategori=${category}`, {
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
                productGrid.innerHTML = '<p class="col-span-4 text-center text-gray-500">Tidak ada menu untuk kategori ini.</p>';
            }

        } catch (error) {
            console.error('Fetch error:', error);
            productGrid.innerHTML = '<p class="col-span-4 text-center text-red-500">Gagal memuat menu. Coba refresh.</p>';
        }
    }

    function createMenuCard(menu) {
        const card = document.createElement('div');
        card.className = 'group relative product-card bg-[#E2AE54] rounded-2xl shadow-lg overflow-hidden cursor-pointer';
        card.dataset.category = menu.kategori;
        card.setAttribute('onclick', 'toggleCard(this)'); 

        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(menu.harga).replace('Rp', 'Rp ');

        card.innerHTML = `
            <img src="/Assets/${menu.gambar}" alt="${menu.nama}" 
                 class="w-full h-48 object-cover transition-all duration-500 group-[.active]:scale-105">
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">${menu.nama}</h3>
                <p class="text-black font-bold mt-2">${formattedPrice}</p>
            </div>
            <div class="absolute inset-0 bg-white/95 p-4 opacity-0 translate-x-5 scale-95 rounded-2xl transition-all duration-500 group-[.active]:opacity-100 group-[.active]:translate-x-0 group-[.active]:scale-100">
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
            const category = this.dataset.category;
            fetchMenus(category);
        });
    });

    fetchMenus('all');

});