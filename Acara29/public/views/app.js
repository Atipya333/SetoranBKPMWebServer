// Butuh helper.js (escapeHTML, fetchDenganRetry) dimuat lebih dulu di HTML:
// <script src="helper.js"></script>
// <script src="app.js"></script>

// Sesuaikan dengan alamat project-mu di localhost
const BASE_URL = 'http://localhost/Code/Acara29/public';

function tampilkanPesan(tbody, teks) {
    tbody.innerHTML = `<tr><td colspan="3" class="pesan">${escapeHTML(teks)}</td></tr>`;
}

function renderTabel(data) {
    const tbody = document.querySelector('#tabel-mahasiswa tbody');
    tbody.innerHTML = data.map((mhs) =>
        `<tr><td>${escapeHTML(mhs.nim)}</td><td>${escapeHTML(mhs.nama)}</td><td>${escapeHTML(mhs.prodi)}</td></tr>`
    ).join('');
}

async function muatDataMahasiswa() {
    const tbody = document.querySelector('#tabel-mahasiswa tbody');

    // Langkah 1: indikator loading
    tampilkanPesan(tbody, 'Memuat data...');

    try {
        const response = await fetchDenganRetry(`${BASE_URL}/mahasiswa`);
        if (!response.ok) throw new Error('Server merespons dengan status ' + response.status);
        const hasil = await response.json();

        if (!hasil.data || hasil.data.length === 0) {
            tampilkanPesan(tbody, 'Belum ada data');
            return;
        }

        renderTabel(hasil.data);
    } catch (error) {
        console.error('Gagal memuat data:', error);
        tampilkanPesan(tbody, 'Gagal memuat data: ' + error.message);
    }
}

document.addEventListener('DOMContentLoaded', muatDataMahasiswa);