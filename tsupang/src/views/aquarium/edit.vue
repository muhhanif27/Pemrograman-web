<template>
    <div class="container">
      <h1 class="my-4">Edit Aquarium</h1>
      <form @submit.prevent="submitForm">
       
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
  
        
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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

  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.value = URL.createObjectURL(file);
      aquarium.value.image = file; 
    }
  };
  
  
  const fetchAquarium = async () => {
    try {
      const response = await Api.get(`/produk-aquarium/${aquariumId}`);
      aquarium.value.nama = response.data.nama;
      aquarium.value.harga = response.data.harga;
      imagePreview.value = response.data.image;
    } catch (error) {
      console.error('Gagal mengambil data aquarium:', error);
      alert('Gagal mengambil data aquarium.');
    }
  };
  

  const submitForm = async () => {
    const formData = new FormData();
    formData.append('nama', aquarium.value.nama);
    if (aquarium.value.image instanceof File) {
      formData.append('image', aquarium.value.image);
    }
    formData.append('harga', aquarium.value.harga);
  

    for (let pair of formData.entries()) {
    console.log(pair[0], pair[1]);
  }


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
  