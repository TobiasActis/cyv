// src/main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Importa el router
import store from './store'; // Importa la store
import '@fortawesome/fontawesome-free/css/all.css';

const app = createApp(App);
app.use(router); // Usa el router
app.use(store); // Usa Vuex
app.mount('#app');
