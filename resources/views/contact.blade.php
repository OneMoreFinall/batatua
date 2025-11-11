<x-app-layout>

    <section id="home" class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-black">HUBUNGI KAMI</h1>
            <p class="text-lg md:text-2xl  text-black">Kita Menerima Reservasi Tempat untuk acara</p>
            {{-- link ig --}}
            <a href="https://www.instagram.com/kedaibatatua.id/"> 
                <button class="mt-6 px-6 py-3 bg-yellow-700 text-black font-semibold rounded-2xl hover:bg-yellow-600 transition-colors duration-300">Instagram</button>
            </a>
            {{-- link wa --}}
            <a href="">
                <button class="mt-6 px-6 py-3 bg-yellow-700 text-black font-semibold rounded-2xl hover:bg-yellow-600 transition-colors duration-300">Whatsapp</button>
            </a>
        </div>
    </section>

    <div class="bg-[#fff8f0] min-h-screen py-10 px-5">
        <div class="max-w-3xl mx-auto">
            <div class="bg-yellow-100 rounded-2xl shadow-lg p-8 border border-black">
                <h2 class="text-3xl font-bold text-center mb-2">Form Reservasi</h2>
                <p class="text-center text-gray-600 mb-8">Silakan isi formulir di bawah ini untuk melakukan reservasi</p>

                <form id="reservationForm" class="space-y-6">
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-amber-700"></i>Nama Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fab fa-whatsapp mr-2 text-amber-700"></i>Nomor WhatsApp
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="whatsapp" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="628xxxx">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fas fa-calendar-alt mr-2 text-amber-700"></i>Tanggal Reservasi
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fas fa-clock mr-2 text-amber-700"></i>Waktu Reservasi
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="waktu" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            <option value="">Pilih waktu</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="12:00">12:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                            <option value="17:00">17:00 WIB</option>
                            <option value="18:00">18:00 WIB</option>
                            <option value="19:00">19:00 WIB</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fas fa-users mr-2 text-amber-700"></i>Jumlah Tamu
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="jumlahTamu" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            <option value="">Pilih jumlah tamu</option>
                            <option value="5">5 Orang</option>
                            <option value="6">6 Orang</option>
                            <option value="7">7 Orang</option>
                            <option value="8">8 Orang</option>
                            <option value="9">9 Orang</option>
                            <option value="10+">10+ Orang</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">
                            <i class="fas fa-comment-alt mr-2 text-amber-700"></i>Catatan Khusus (Opsional)
                        </label>
                        <textarea id="catatan" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="Contoh: Alergi makanan, posisi meja khusus, dll."></textarea>
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit" class="bg-amber-700 hover:bg-amber-800 text-white px-8 py-4 rounded-lg font-semibold transition duration-300 shadow-lg text-lg w-full md:w-auto">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Reservasi
                        </button>
                    </div>
                </form>
            </div>

            <div id="confirmationSection" class="hidden bg-white rounded-2xl shadow-lg mt-8 p-8 border-2 border-green-500">
                <div class="text-center mb-6">
                    <i class="fas fa-check-circle text-green-500 text-6xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Reservasi Berhasil!</h2>
                    <p class="text-gray-600 mt-2">Kode Reservasi: <span id="kodeReservasi" class="font-bold text-amber-700"></span></p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Detail Reservasi:</h3>
                    <div class="space-y-3 text-gray-700">
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold">Nama:</span>
                            <span id="confirmNama"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold">WhatsApp:</span>
                            <span id="confirmWA"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold">Tanggal:</span>
                            <span id="confirmTanggal"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold">Waktu:</span>
                            <span id="confirmWaktu"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="font-semibold">Jumlah Tamu:</span>
                            <span id="confirmTamu"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Catatan:</span>
                            <span id="confirmCatatan" class="text-right max-w-xs"></span>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button onclick="sendToWhatsApp()" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold transition duration-300 shadow-lg text-lg w-full md:w-auto">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i>Konfirmasi via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    @vite('resources/js/contact.js')
@endpush

</x-app-layout>