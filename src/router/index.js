import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue'; // Ruta corregida

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: { requiresAuth: true }, // Ruta protegida
  },
  {
    path: '/echeq-cartera',
    name: 'EcheqCartera',
    component: () => import('../views/EcheqCartera.vue'), // Carga dinámica
    meta: { requiresAuth: true }, // Ruta protegida
  },
  {
    path: '/echeq-endosados',
    name: 'EcheqEndosados',
    component: () => import('../views/EcheqEndosados.vue'), // Carga dinámica
    meta: { requiresAuth: true }, // Ruta protegida
  },
  {
    path: '/importar',
    name: 'Importar',
    component: () => import('../views/Importar.vue'), // Carga dinámica
    meta: { requiresAuth: true }, // Ruta protegida
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

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('user'); // Verificar si el usuario está autenticado
  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'Login' }); // Redirigir al login si no está autenticado
  } else {
    next(); // Permitir el acceso
  }
});

export default router;