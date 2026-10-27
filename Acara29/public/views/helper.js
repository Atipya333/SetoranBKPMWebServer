// Langkah 2: escaping output agar data dari Controller tampil sebagai teks, bukan HTML.
// Tanda kutip ikut di-escape supaya aman dipakai di dalam atribut (src="...", alt="...").
function escapeHTML(teks) {
    const div = document.createElement('div');
    div.textContent = String(teks ?? '');
    return div.innerHTML.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}

// Tugas mandiri 2: retry otomatis satu kali.
// fetch() hanya melempar error saat jaringan bermasalah (bukan saat server membalas 4xx/5xx),
// jadi retry hanya terjadi pada masalah jaringan sementara.
// Dipakai untuk request GET saja, agar request POST/PUT/DELETE tidak terkirim dobel.
async function fetchDenganRetry(url, options = {}, sisaPercobaan = 1) {
    try {
        return await fetch(url, options);
    } catch (error) {
        if (sisaPercobaan > 0) {
            await new Promise((r) => setTimeout(r, 1000));
            return fetchDenganRetry(url, options, sisaPercobaan - 1);
        }
        throw error;
    }
}