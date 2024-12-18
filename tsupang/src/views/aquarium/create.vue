<template>
    <div class="container">
      <h1 class="my-4">Tambah Aquarium</h1>
      <form @submit.prevent="submitForm">
        <!-- Nama Aquarium -->
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Aquarium</label>
          <input
            type="text"
            id="nama"
            v-model="aquarium.nama"
            class="form-control"
            placeholder="Masukkan nama aquarium"
            required
          />
        </div>
  
        <!-- Gambar Aquarium -->
        <div class="mb-3">
          <label for="image" class="form-label">Pilih Gambar Aquarium</label>
          <input
            type="file"
            id="image"
            @change="handleImageUpload"
            class="form-control"
            accept="image/*"
            required
          />
        </div>
        <div v-if="imagePreview" class="mb-3">
          <img :src="imagePreview" alt="Preview" class="img-fluid" style="max-width: 200px" />
        </div>
  
        <!-- Harga Aquarium -->
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input
            type="number"
            id="harga"
            v-model="aquarium.harga"
            class="form-control"
            placeholder="Masukkan harga aquarium"
            required
          />
        </div>
  
        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import Api from '../../api';
  
  // State untuk data aquarium
  const aquarium = ref({ nama: '', image: null, harga: '' });
  const imagePreview = ref(null);
  const router = useRouter();
  
  // Fungsi untuk menangani input gambar
  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.value = URL.createObjectURL(file);
      aquarium.value.image = file; // Simpan file untuk dikirim ke backend
    }
  };
  
  // Fungsi untuk submit form
  const submitForm = async () => {
    const formData = new FormData();
    formData.append('nama', aquarium.value.nama);
    formData.append('harga', aquarium.value.harga);
    formData.append('image', aquarium.value.image);
  
    try {
      // Kirim request ke API
      await Api.post('/produk-aquarium', formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });
  
      // Notifikasi dan redirect
      alert('Data berhasil ditambahkan!');
      router.push('/aquarium');
    } catch (error) {
      console.error('Gagal menambahkan data:', error);
      alert('Gagal menambahkan data. Periksa kembali input atau koneksi.');
    }
  };
  </script>
  