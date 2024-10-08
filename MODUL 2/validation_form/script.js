function validateForm() {
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let alamat = document.getElementById('alamat').value;

    if (name === '' || email === '' || alamat === '') {
        alert('Semua data harus diisi.');
    } else {
        alert('Pendaftaran berhasil!');
    }
}
