<x-app-layout>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
        }
        .social-btn {
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            transform: translateY(-5px) scale(1.1);
        }
    </style>

    <section id="home" class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('Assets/Hero Image (2).png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/40"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                <span class="bg-gradient-to-r from-amber-300 via-yellow-300 to-amber-400 bg-clip-text text-transparent">HUBUNGI KAMI</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-6">Kita Menerima Reservasi Tempat untuk acara</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://www.instagram.com/kedaibatatua.id/" target="_blank">
                    <button class="px-6 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-2xl hover:from-amber-700 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fab fa-instagram mr-2"></i>Instagram
                    </button>
                </a>
                <a href="https://wa.me/62881027512495" target="_blank">
                    <button class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-2xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                    </button>
                </a>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-gradient-to-b from-[#fff9e6] to-amber-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl p-8 border-2 border-amber-200 animate-fade-in-up">
                    <h2 class="text-3xl font-bold mb-2 bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">
                        <i class="fas fa-calendar-check mr-3 text-amber-600"></i>Form Reservasi
                    </h2>
                    <p class="text-gray-600 mb-8">Silakan isi formulir di bawah ini untuk melakukan reservasi</p>
                    <form id="reservationForm" class="space-y-6">
                        <div>
                            <label for="nama" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-user mr-2 text-amber-600"></i>Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-gray-700 font-semibold mb-2">
                                <i class="fab fa-whatsapp mr-2 text-amber-600"></i>Nomor WhatsApp
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="tel"
                                id="whatsapp"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                                placeholder="628xxxx"
                            >
                        </div>
                        <div>
                            <label for="tanggal" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-calendar-alt mr-2 text-amber-600"></i>Tanggal Reservasi
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="date"
                                id="tanggal"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                            >
                        </div>
                        
                        <div>
                            <label for="waktuMulai" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-clock mr-2 text-amber-600"></i>Waktu Mulai
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="waktuMulai"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                            >
                                <option value="">Pilih waktu mulai</option>
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
                                <option value="20:00">20:00 WIB</option>
                                <option value="21:00">21:00 WIB</option>
                                <option value="22:00">22:00 WIB</option>
                            </select>
                        </div>

                        <div>
                            <label for="waktuSelesai" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-clock mr-2 text-amber-600"></i>Waktu Selesai
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="waktuSelesai"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                            >
                                <option value="">Pilih waktu mulai dulu</option>
                            </select>
                        </div>

                        <div>
                            <label for="jumlahTamu" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-users mr-2 text-amber-600"></i>Jumlah Tamu
                                <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="jumlahTamu"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300"
                            >
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
                            <label for="catatan" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-comment-alt mr-2 text-amber-600"></i>Catatan Khusus (Opsional)
                            </label>
                            <textarea
                                id="catatan"
                                rows="4"
                                class="form-input w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-500 transition-all duration-300 resize-none"
                                placeholder="Contoh: Alergi makanan, posisi meja khusus, dll."
                            ></textarea>
                        </div>
                        <div class="text-center pt-4">
                            <button
                                type="submit"
                                class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg w-full"
                            >
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Reservasi
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="bg-white rounded-3xl shadow-2xl p-8">
                        <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">
                            <i class="fas fa-info-circle mr-3"></i>Tentang Kami
                        </h2>
                        <div class="flex items-start space-x-4">
                            <img src="{{ asset('Assets/Tempat 2.jpg') }}" alt="Kedai Batatua" class="w-32 h-32 object-cover rounded-xl shadow-lg">
                            <p class="text-gray-700 leading-relaxed flex-1">
                                Kedai Batatua 1928, tempat yang nyaman dengan menu lengkap dan harga terjangkau. Nikmati suasana hangat untuk makan, santai, dan berkumpul bersama teman atau keluarga.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-2xl p-8">
                        <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">
                            <i class="fas fa-address-card mr-3"></i>Informasi Kontak
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                                <div class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Alamat</p>
                                    <p class="text-gray-600">Jl. Ketintang Madya No. 82, Surabaya</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                                <div class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Jam Operasional</p>
                                    <p class="text-gray-600">Setiap Hari: 09.00 - 00.00 WIB</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                                <div class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Email</p>
                                    <p class="text-gray-600">batatua1928@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-600 to-yellow-600 rounded-3xl shadow-2xl p-8 text-white">
                        <h2 class="text-3xl font-bold mb-6">
                            <i class="fas fa-share-alt mr-3"></i>Ikuti Kami
                        </h2>
                        <p class="mb-6 text-amber-100">Ikuti kami di media sosial untuk update terbaru dan promo spesial!</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://www.instagram.com/kedaibatatua.id/" target="_blank" class="social-btn flex-1 min-w-[140px] bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 text-center">
                                <i class="fab fa-instagram text-2xl mb-2 block"></i>
                                <span class="font-semibold">Instagram</span>
                            </a>
                            <a href="https://wa.me/62881027512495" target="_blank" class="social-btn flex-1 min-w-[140px] bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 text-center">
                                <i class="fab fa-whatsapp text-2xl mb-2 block"></i>
                                <span class="font-semibold">WhatsApp</span>
                            </a>
                            <a href="mailto:batatua1928@gmail.com" class="social-btn flex-1 min-w-[140px] bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 text-center">
                                <i class="fas fa-envelope text-2xl mb-2 block"></i>
                                <span class="font-semibold">Email</span>
                            </a>
                            <a href="#" class="social-btn flex-1 min-w-[140px] bg-white/20 backdrop-blur-sm px-6 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 text-center">
                                <i class="fab fa-tiktok text-2xl mb-2 block"></i>
                                <span class="font-semibold">TikTok</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="confirmationSection" class="hidden max-w-3xl mx-auto mt-8 animate-fade-in-up">
                <div class="bg-white rounded-3xl shadow-2xl p-8 border-2 border-green-500">
                    <div class="text-center mb-6">
                        <i class="fas fa-check-circle text-green-500 text-6xl mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Reservasi Berhasil!</h2>
                        <p class="text-gray-600 mt-2">Kode Reservasi: <span id="kodeReservasi" class="font-bold text-amber-700 text-xl"></span></p>
                    </div>
                    <div class="bg-amber-50 rounded-lg p-6 mb-6">
                        <h3 class="font-bold text-lg mb-4 text-gray-800">
                            <i class="fas fa-info-circle mr-2 text-amber-600"></i>Detail Reservasi:
                        </h3>
                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between border-b border-amber-200 pb-2">
                                <span class="font-semibold">Nama:</span>
                                <span id="confirmNama" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between border-b border-amber-200 pb-2">
                                <span class="font-semibold">WhatsApp:</span>
                                <span id="confirmWA" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between border-b border-amber-200 pb-2">
                                <span class="font-semibold">Tanggal:</span>
                                <span id="confirmTanggal" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between border-b border-amber-200 pb-2">
                                <span class="font-semibold">Waktu:</span>
                                <span id="confirmWaktu" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between border-b border-amber-200 pb-2">
                                <span class="font-semibold">Jumlah Tamu:</span>
                                <span id="confirmTamu" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold">Catatan:</span>
                                <span id="confirmCatatan" class="text-right max-w-xs text-gray-800"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button
                            onclick="sendToWhatsApp()"
                            class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg w-full md:w-auto"
                        >
                            <i class="fab fa-whatsapp mr-2 text-xl"></i>Konfirmasi via WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

