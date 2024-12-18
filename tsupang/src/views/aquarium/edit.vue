<template>
    <div class="container">
      <h1 class="my-4">Edit Aquarium</h1>
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
          <label for="image" class="form-label">Gambar Aquarium</label>
          <input
            type="file"
            id="image"
            @change="handleImageUpload"
            class="form-control"
            accept="image/*"
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
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  import Api from '../../api';
  
  const aquarium = ref({ nama: '', harga: '' });
  const imagePreview = ref(null);
  const router = useRouter();
  const route = useRoute();
  const aquariumId = route.params.id;
  
  // Menangani input gambar
  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.value = URL.createObjectURL(file);
      aquarium.value.image = file; // Simpan file untuk dikirim ke backend
    }
  };
  
  // Ambil data aquarium berdasarkan ID
  const fetchAquarium = async () => {
    try {
      const response = await Api.get(`/produk-aquarium/${aquariumId}`);
      aquarium.value.nama = response.data.nama;
      aquarium.value.harga = response.data.harga;
      imagePreview.value = response.data.image; // Tampilkan gambar awal
    } catch (error) {
      console.error('Gagal mengambil data aquarium:', error);
      alert('Gagal mengambil data aquarium.');
    }
  };
  
  // Menangani form submit
  const submitForm = async () => {
    const formData = new FormData();
    formData.append('nama', aquarium.value.nama);
    if (aquarium.value.image instanceof File) {
      formData.append('image', aquarium.value.image);
    }
    formData.append('harga', aquarium.value.harga);
  
    try {
      await Api.post(`/produk-aquarium/${aquariumId}?_method=PUT`, formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });
      alert('Data berhasil diperbarui!');
      router.push('/aquarium');
    } catch (error) {
      console.error('Gagal memperbarui data:', error);
      alert('Gagal memperbarui data.');
    }
  };
  
  onMounted(fetchAquarium);
  </script>
  