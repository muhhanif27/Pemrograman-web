<template>
    <div class="container">
      <h1 class="my-4">Tambah Ikan</h1>
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
          <label for="image" class="form-label">Pilih Gambar Ikan</label>
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
  
        
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import Api from '../../api';
  
 
  const ikan = ref({ nama: '', image: null, harga: '' });
  const imagePreview = ref(null);
  const router = useRouter();
  
 
  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      imagePreview.value = URL.createObjectURL(file);
      ikan.value.image = file; 
    }
  };
  
  
  const submitForm = async () => {
    const formData = new FormData();
    formData.append('nama', ikan.value.nama);
    formData.append('harga', ikan.value.harga);
    formData.append('image', ikan.value.image);
  
    try {
     
      await Api.post('/produk-ikan', formData, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });
  
     
      alert('Data berhasil ditambahkan!');
      router.push('/ikan');
    } catch (error) {
      console.error('Gagal menambahkan data:', error);
      alert('Gagal menambahkan data. Periksa kembali input atau koneksi.');
    }
  };
  </script>
  