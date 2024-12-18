<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <div class="container">
        <router-link to="/" class="navbar-brand">
          <img src="../src/assets/tsupang.png" alt="Tsupang Logo" class="logo" />
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/ikan" class="nav-link">Ikan</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/aquarium" class="nav-link">Aquarium</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
body {
  background-color: #f8f9fa;
  font-family: 'Arial', sans-serif;
}

.navbar {
  margin-bottom: 20px;
}

.custom-navbar {
  background-color: #1dafdf;
}

.custom-navbar .logo {
  height: 40px;
  width: auto;
}
</style>
