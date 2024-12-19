<template>
    <div class="container">
      <h1 class="my-4">Edit Ikan</h1>
      <form @submit.prevent="submitForm">
       
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Ikan</label>
          <input
            type="text"
            id="nama"
            v-model="ikan.nama"
            class="form-control"
            placeholder="Masukkan nama ikan"
            required
          />
        </div>
  
        
        <div class="mb-3">
          <label for="image" class="form-label">Gambar Ikan</label>
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
            v-model="ikan.harga"
            class="form-control"
            placeholder="Masukkan harga ikan"
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
  
  const ikan = ref({ nama: '', harga: '' });
  const imagePreview = ref(null);
  const router = useRouter();
  const route = useRoute();
  const ikanId = route.params.id;
  
  
  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.value = URL.createObjectURL(file);
      ikan.value.image = file; 
    }
  };
  
  
  const fetchIkan = async () => {
    try {
      const response = await Api.get(`/produk-ikan/${ikanId}`);
      ikan.value.nama = response.data.nama;
      ikan.value.harga = response.data.harga;
      imagePreview.value = response.data.image; 
    } catch (error) {
      console.error('Gagal mengambil data ikan:', error);
      alert('Gagal mengambil data ikan.');
    }
  };
  

  const submitForm = async () => {
  const formData = new FormData();
  formData.append('nama', ikan.value.nama);
  if (ikan.value.image instanceof File) {
    formData.append('image', ikan.value.image);
  }
  formData.append('harga', ikan.value.harga);

  
  for (let pair of formData.entries()) {
    console.log(pair[0], pair[1]);
  }

  try {
    await Api.post(`/produk-ikan/${ikanId}?_method=PUT`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
    alert('Data berhasil diperbarui!');
    router.push('/ikan');
  } catch (error) {
    console.error('Gagal memperbarui data:', error);
    alert('Gagal memperbarui data.');
  }
};

  onMounted(fetchIkan);
  </script>
  