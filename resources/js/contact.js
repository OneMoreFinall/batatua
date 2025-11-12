document.addEventListener("DOMContentLoaded", function() {

    const WHATSAPP_NUMBER = '6289530428832';
    let reservationData = {};

    const today = new Date().toISOString().split('T')[0];
    const tanggalInput = document.getElementById('tanggal');
    if (tanggalInput) {
        tanggalInput.setAttribute('min', today);
    }

    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('nama').value.trim();
            const whatsapp = document.getElementById('whatsapp').value.trim();
            const tanggal = document.getElementById('tanggal').value;
            const waktu = document.getElementById('waktu').value;
            const jumlahTamu = document.getElementById('jumlahTamu').value;
            const catatan = document.getElementById('catatan').value.trim() || '-';

            const dateObj = new Date(tanggal);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = dateObj.toLocaleDateString('id-ID', options);

            const kode = 'RV' + Date.now().toString().slice(-8);

            reservationData = {
                kode,
                nama,
                whatsapp,
                tanggal: formattedDate,
                waktu,
                jumlahTamu,
                catatan
            };

            document.getElementById('kodeReservasi').textContent = kode;
            document.getElementById('confirmNama').textContent = nama;
            document.getElementById('confirmWA').textContent = whatsapp;
            document.getElementById('confirmTanggal').textContent = formattedDate;
            document.getElementById('confirmWaktu').textContent = waktu + ' WIB';
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
        message += `Waktu: ${data.waktu} WIB%0A`;
        message += `Jumlah Tamu: ${data.jumlahTamu} Orang%0A`;
        message += `Catatan: ${data.catatan}%0A`;
        message += `%0ATerima kasih telah melakukan reservasi. Kami tunggu kedatangan Anda di Batatua1928.%0A%0A`;

        const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
        window.open(url, '_blank');
    }
    
});