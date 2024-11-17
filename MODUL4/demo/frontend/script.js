// Fetch data dari API dan render ke UI
fetch('http://localhost/MODUL4/demo/backend/dbconfig.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const productContainer = document.querySelector('.product-container');

        // Bersihkan kontainer sebelum menambahkan data baru
        productContainer.innerHTML = '';

        // Iterasi data dan tambahkan ke UI
        data.forEach(item => {
            // Pastikan ID produk belum ada di dalam kontainer untuk mencegah duplikasi
            if (!document.getElementById(`product-${item.id}`)) {
                const card = document.createElement('div');
                card.classList.add('product-card');
                card.id = `product-${item.id}`; // Set ID untuk setiap produk
                card.innerHTML = `
                    <img src="${item.fish_image}" alt="${item.fish_name}">
                    <div class="product-info">
                        <h3>Rp ${parseInt(item.price).toLocaleString('id-ID')}</h3>
                        <p>${item.fish_name}</p>
                        <a href="#" class="product-link">Learn More</a>
                    </div>
                `;
                productContainer.appendChild(card);
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
