<template>
    <div class="container">
      <h1 class="my-4">Daftar Aquarium</h1>
      <!-- Tombol Tambah Data -->
      <router-link to="/aquarium/create" class="btn btn-success mb-4">Tambah Aquarium</router-link>
      
      <!-- Tampilkan Loading -->
      <div v-if="loading" class="text-center">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat data...</p>
      </div>
      
      <!-- Daftar Aquarium -->
      <div v-else>
        <div class="row">
          <div v-for="aquarium in aquariumList" :key="aquarium.id" class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <!-- Gambar Aquarium -->
              <img
                :src="aquarium.image || 'https://via.placeholder.com/150'"
                alt="Gambar Aquarium"
                class="card-img-top"
                style="height: 200px; object-fit: cover"
              />
              <!-- Informasi Aquarium -->
              <div class="card-body text-center">
                <h5 class="card-title">{{ aquarium.nama }}</h5>
                <p class="card-text">Harga: <strong>Rp {{ formatHarga(aquarium.harga) }}</strong></p>
              </div>
              <!-- Tombol Aksi -->
              <div class="card-footer d-flex justify-content-between">
                <button @click="deleteAquarium(aquarium.id)" class="btn btn-danger btn-sm">
                  Hapus
                </button>
                <router-link :to="`/aquarium/edit/${aquarium.id}`" class="btn btn-warning btn-sm">
                  Edit
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Jika Tidak Ada Data -->
      <div v-if="!loading && aquariumList.length === 0" class="alert alert-info text-center">
        <p>Tidak ada data aquarium yang tersedia.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import Api from '../../api';
  
  const aquariumList = ref([]); // Menyimpan daftar aquarium
  const loading = ref(true); // Status loading
  
  // Format harga ke format ribuan
  const formatHarga = (harga) => {
    return harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  };
  
  // Fungsi untuk mengambil data aquarium dari backend
  const fetchAquarium = async () => {
    try {
      const response = await Api.get('/produk-aquarium');
      aquariumList.value = response.data;
    } catch (error) {
      console.error('Gagal memuat data aquarium:', error);
      alert('Gagal memuat data aquarium. Silakan coba lagi.');
    } finally {
      loading.value = false;
    }
  };
  
  // Fungsi untuk menghapus aquarium
  const deleteAquarium = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus aquarium ini?')) {
      try {
        await Api.delete(`/produk-aquarium/${id}`);
        alert('Data berhasil dihapus!');
        fetchAquarium(); // Refresh daftar aquarium
      } catch (error) {
        console.error('Gagal menghapus data:', error);
        alert('Gagal menghapus data. Silakan coba lagi.');
      }
    }
  };
  
  // Panggil fetchAquarium saat komponen di-mount
  onMounted(fetchAquarium);
  </script>
  