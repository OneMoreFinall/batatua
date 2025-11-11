<x-app-layout>

    <section id="home" class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-4xl text-black md:text-6xl font-bold mb-4 text-center">Batatua1928</h1>
            <h1 class="text-4xl text-black md:text-4xl font font-bold mb-4 text-center">Our Menu</h1>
        </div>
    </section>

    <div class="bg-[#fff8f0] min-h-screen py-10 px-5">
        <h2 class="text-3xl font-bold text-center mb-8">Product Kami</h2>

        <div class="flex justify-center gap-4 mb-8 flex-wrap">
            <button data-category="all" 
                    class="filter-btn text-black transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-300 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full px-4 py-2">
                All
            </button>
            <button data-category="makanan-ringan" 
                    class="filter-btn text-black transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-300 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full px-4 py-2">
                Makanan Ringan
            </button>
            <button data-category="makanan-berat" 
                    class="filter-btn text-black transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-300 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full px-4 py-2">
                Makanan Berat
            </button>
            <button data-category="non-coffe" 
                    class="filter-btn text-black transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-300 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full px-4 py-2">
                non coffe
            </button>
            <button data-category="coffee" 
                    class="filter-btn text-black transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-yellow-300 after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full px-4 py-2">
                Coffee
            </button>
        </div>

        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <p class="col-span-4 text-center text-gray-500">Memuat menu...</p>
        </div>

        <div class="flex justify-center mt-12 mb-8">
            <a href="{{ route('home') }}" class="bg-gray-800 text-white px-10 py-3 rounded-lg text-lg font-semibold hover:bg-gray-700 transition duration-300 shadow-md">
                BACK
            </a>
        </div>
    </div>

</x-app-layout>

<script>
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
            
            card.setAttribute('onclick', 'window.toggleCard(this)'); 

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
                    {{-- Di sini kita perlu menambahkan tombol Add to Cart lagi --}}
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
</script>