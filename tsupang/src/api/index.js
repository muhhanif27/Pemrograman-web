import axios from 'axios';

const Api = axios.create({
    baseURL: 'http://localhost:8000/api', // Ganti dengan URL server PHP Anda
});

export default Api;
