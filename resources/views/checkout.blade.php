<x-app-layout>

    <section class="bg-gray-200 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center">Checkout Pesanan</h1>
        </div>
    </section>

    <div class="container mx-auto p-8">

        <div id="checkoutSection" class="bg-white rounded-2xl shadow-lg mt-10 p-6 max-w-3xl mx-auto border border-gray-300">
            <h2 class="text-2xl font-bold text-center mb-3">Nota Pesanan</h2>

            <p class="text-center mb-4 text-gray-600">
                Kode Nota: <span id="notaCode" class="font-bold text-black">NT{{ time() }}</span>
            </p>

            <div id="notaItems" class="space-y-2 mb-4">
                @php $total = 0; @endphp

                @foreach ($cartItems as $id => $item)
                    @php 
                        $subtotal = $item['harga'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <div class="flex justify-between items-center">
                        <span>{{ $item['nama'] }} x{{ $item['quantity'] }}</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-lg font-semibold mb-6"> 
                <span>Total:</span>
                <span id="notaTotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>


            <form action="{{ route ('checkout.process')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Nama Pemesan</label>
                    <input type="text" id="nama" name="nama" class="w-full border rounded-lg p-2" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Nomor WhatsApp</label>
                    <input type="text" id="whatsapp" name="whatsapp" class="w-full border rounded-lg p-2" placeholder="628xxxx" required>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 shadow-md">
                        <i class="fab fa-whatsapp mr-2"></i>Kirim ke WhatsApp
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('cart.show') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali ke Keranjang</a>
            </div>
        </div>
    </div>

</x-app-layout>