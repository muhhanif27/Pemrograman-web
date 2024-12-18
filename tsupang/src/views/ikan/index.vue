<template>
    <div class="container">
      <h1 class="my-4">Daftar Ikan</h1>
      <!-- Tombol Tambah Data -->
      <router-link to="/ikan/create" class="btn btn-success mb-4">Tambah Ikan</router-link>
      
      <!-- Tampilkan Loading -->
      <div v-if="loading" class="text-center">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat data...</p>
      </div>
      
      <!-- Daftar Ikan -->
      <div v-else>
        <div class="row">
          <div v-for="ikan in ikanList" :key="ikan.id" class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <!-- Gambar Ikan -->
              <img
                :src="ikan.image || 'https://via.placeholder.com/150'"
                alt="Gambar Ikan"
                class="card-img-top"
                style="height: 200px; object-fit: cover"
              />
              <!-- Informasi Ikan -->
              <div class="card-body text-center">
                <h5 class="card-title">{{ ikan.nama }}</h5>
                <p class="card-text">Harga: <strong>Rp {{ formatHarga(ikan.harga) }}</strong></p>
              </div>
              <!-- Tombol Aksi -->
              <div class="card-footer d-flex justify-content-between">
                <button @click="deleteIkan(ikan.id)" class="btn btn-danger btn-sm">
                  Hapus
                </button>
                <router-link :to="`/ikan/edit/${ikan.id}`" class="btn btn-warning btn-sm">
                  Edit
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Jika Tidak Ada Data -->
      <div v-if="!loading && ikanList.length === 0" class="alert alert-info text-center">
        <p>Tidak ada data ikan yang tersedia.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import Api from '../../api';
  
  const ikanList = ref([]); // Menyimpan daftar ikan
  const loading = ref(true); // Status loading
  
  // Format harga ke format ribuan
  const formatHarga = (harga) => {
    return harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  };
  
  // Fungsi untuk mengambil data ikan dari backend
  const fetchIkan = async () => {
    try {
      const response = await Api.get('/produk-ikan');
      ikanList.value = response.data;
    } catch (error) {
      console.error('Gagal memuat data ikan:', error);
      alert('Gagal memuat data ikan. Silakan coba lagi.');
    } finally {
      loading.value = false;
    }
  };
  
  // Fungsi untuk menghapus ikan
  const deleteIkan = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus ikan ini?')) {
      try {
        await Api.delete(`/produk-ikan/${id}`);
        alert('Data berhasil dihapus!');
        fetchIkan(); // Refresh daftar ikan
      } catch (error) {
        console.error('Gagal menghapus data:', error);
        alert('Gagal menghapus data. Silakan coba lagi.');
      }
    }
  };
  
  // Panggil fetchIkan saat komponen di-mount
  onMounted(fetchIkan);
  </script>
  
  <style scoped>
  .card {
    border: 1px solid #ddd;
    border-radius: 8px;
  }
  .card img {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }
  .card-footer {
    background-color: #f8f9fa;
  }
  </style>
  