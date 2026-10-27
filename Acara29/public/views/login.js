// Sesuaikan dengan alamat project-mu di localhost
const BASE_URL = 'http://localhost/Code/Acara29/public';

const form = document.querySelector('#form-login');
const username = document.querySelector('#username');
const password = document.querySelector('#password');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Langkah 3: nonaktifkan tombol selama proses
    const tombol = form.querySelector('button[type="submit"], button:not([type])');
    const teksAsli = tombol ? tombol.textContent : '';
    if (tombol) { tombol.disabled = true; tombol.textContent = 'Memproses...'; }

    try {
        const res = await fetch(`${BASE_URL}/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username: username.value, password: password.value }),
        });
        const hasil = await res.json();

        if (hasil.success) {
            localStorage.setItem('token', hasil.data.token);
            localStorage.setItem('role', hasil.data.role);
            window.location.href = 'dashboard.html';
        } else {
            alert(hasil.message || 'Login gagal');
        }
    } catch (err) {
        alert('Tidak dapat terhubung ke server');
    } finally {
        if (tombol) { tombol.disabled = false; tombol.textContent = teksAsli; }
    }
});