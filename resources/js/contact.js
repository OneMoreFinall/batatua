document.addEventListener("DOMContentLoaded", function() {

    const WHATSAPP_NUMBER = '6289530428832';
    let reservationData = {};

    const today = new Date().toISOString().split('T')[0];
    const tanggalInput = document.getElementById('tanggal');
    if (tanggalInput) {
        tanggalInput.setAttribute('min', today);
    }

    const waktuMulai = document.getElementById('waktuMulai');
    const waktuSelesai = document.getElementById('waktuSelesai');

    const allTimes = [
        "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", 
        "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"
    ];

    if (waktuSelesai) {
        waktuSelesai.disabled = true;
    }

    if (waktuMulai) {
        waktuMulai.addEventListener('change', function() {
            const selectedStartTime = this.value;
            const startIndex = allTimes.indexOf(selectedStartTime);

            waktuSelesai.innerHTML = '<option value="">Pilih waktu selesai</option>';
            
            if (startIndex === -1 || startIndex === allTimes.length - 1) {
                waktuSelesai.disabled = true;
                if (startIndex === allTimes.length - 1) {
                    waktuSelesai.innerHTML = '<option value="">Reservasi minimal 1 jam</option>';
                } else {
                    waktuSelesai.innerHTML = '<option value="">Pilih waktu mulai dulu</option>';
                }
            } else {
                waktuSelesai.disabled = false;
                for (let i = startIndex + 1; i < allTimes.length; i++) {
                    const option = document.createElement('option');
                    option.value = allTimes[i];
                    option.textContent = allTimes[i] + ' WIB';
                    waktuSelesai.appendChild(option);
                }
            }
        });
    }

    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('nama').value.trim();
            const whatsapp = document.getElementById('whatsapp').value.trim();
            const tanggal = document.getElementById('tanggal').value;
            const waktuMulaiValue = document.getElementById('waktuMulai').value;
            const waktuSelesaiValue = document.getElementById('waktuSelesai').value;
            const jumlahTamu = document.getElementById('jumlahTamu').value;
            const catatan = document.getElementById('catatan').value.trim() || '-';

            const dateObj = new Date(tanggal);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = dateObj.toLocaleDateString('id-ID', options);

            const kode = 'RV' + Date.now().toString().slice(-8);
            const waktuString = `${waktuMulaiValue} - ${waktuSelesaiValue} WIB`;

            reservationData = {
                kode,
                nama,
                whatsapp,
                tanggal: formattedDate,
                waktu: waktuString,
                jumlahTamu,
                catatan
            };

            document.getElementById('kodeReservasi').textContent = kode;
            document.getElementById('confirmNama').textContent = nama;
            document.getElementById('confirmWA').textContent = whatsapp;
            document.getElementById('confirmTanggal').textContent = formattedDate;
            document.getElementById('confirmWaktu').textContent = waktuString;
            document.getElementById('confirmTamu').textContent = jumlahTamu + ' Orang';
            document.getElementById('confirmCatatan').textContent = catatan;

            document.getElementById('confirmationSection').classList.remove('hidden');
            document.getElementById('confirmationSection').scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }

    window.sendToWhatsApp = function() {
        const data = reservationData;
        
        let message = `*RESERVASI BATATUA1928*%0A%0A`;
        message += `Kode Reservasi: *${data.kode}*%0A`;
        message += `%0ANama: ${data.nama}%0A`;
        message += `No. WhatsApp: ${data.whatsapp}%0A`;
        message += `Tanggal: ${data.tanggal}%0A`;
        message += `Waktu: ${data.waktu}%0A`;
        message += `Jumlah Tamu: ${data.jumlahTamu} Orang%0A`;
        message += `Catatan: ${data.catatan}%0A`;
        message += `%0ATerima kasih telah melakukan reservasi. Kami tunggu kedatangan Anda di Batatua1928.%0A%0A`;

        const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
        window.open(url, '_blank');
    }
    
});