import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue'; // Ruta corregida

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/echeq-cartera',
    name: 'EcheqCartera',
    component: () => import('../views/EcheqCartera.vue'), // Carga dinámica
  },
  {
    path: '/echeq-endosados',
    name: 'EcheqEndosados',
    component: () => import('../views/EcheqEndosados.vue'), // Carga dinámica
  },
  {
    path: '/importar',
    name: 'Importar',
    component: () => import('../views/Importar.vue'), // Carga dinámica
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'), // Carga dinámica
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;