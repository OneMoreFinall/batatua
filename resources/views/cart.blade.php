<x-app-layout>

    <section class="bg-gray-200 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center">Keranjang Belanja Anda</h1>
        </div>
    </section>

    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Isi Keranjang:</h2>

        <div class="container mx-auto p-8">
            @if (session('cart') && count(session('cart')) > 0) 
                
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4">Produk</th>
                            <th class="py-2 px-4">Harga</th>
                            <th class="py-2 px-4">Jumlah</th>
                            <th class="py-2 px-4">Subtotal</th>
                            <th class="py-2 px-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>   
                        @php $total = 0; @endphp
                        
                        @foreach ($cartItems as $id => $item)
                            @php 
                                $subtotal = $item['harga'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp

                            <tr class="border-b">
                                <td class="py-4 px-4 flex items-center">
                                    <img src="{{ asset('Assets/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="w-16 h-16 object-cover rounded mr-4">
                                    <span>{{ $item['nama'] }}</span>
                                </td>

                                <td class="py-4 px-4">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="py-4 px-4">
                                    {{ $item['quantity'] }}
                                </td>

                                <td class="py-4 px-4">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>

                                <td class="py-4 px-4">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-8">
                    <h3 class="text-2xl font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>

                    <a href="{{ route ('checkout.show')}}" class="bg-gray-800 text-white px-10 py-3 rounded-lg text-lg font-semibold hover:bg-gray-700 transition duration-300 shadow-md mt-4 inline-block">
                        Lanjut ke Checkout
                    </a>
                </div>

            @else 

                <h2 class="text-2xl font-bold mb-4">Keranjang Anda masih kosong.</h2>
                <a href="{{ route('menu') }}" class="bg-gray-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                    Kembali ke Menu
                </a>
            @endif

        </div>

    </div>

</x-app-layout>