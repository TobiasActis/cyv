<template>
  <aside class="elegant-sidebar" :class="{ 'collapsed': isCollapsed }">
    <!-- Logo con enlace al Home -->
    <router-link to="/" class="sidebar-logo">
      <img src="../assets/Logo.png" alt="Logo" class="logo-image" />
      <span class="logo-text" v-if="!isCollapsed">Carossio & Cia</span>
    </router-link>

    <!-- Panel de usuario -->
    <div class="user-panel">
      <img src="../assets/user.png" alt="User Image" class="user-image" />
      <div class="user-info" v-if="!isCollapsed">
        <span class="user-name">{{ userName }}</span>
        <span class="user-role">Administrador</span>
      </div>
    </div>

    <!-- Menú -->
    <nav class="sidebar-menu">
      <ul>
        <li>
          <a href="#" @click="toggleEcheqMenu" :class="{ active: $route.path === '/' }">
            <i class="fas fa-book"></i>
            <span v-if="!isCollapsed">Echeq</span>
            <i class="fas fa-angle-down" v-if="!isCollapsed && isEcheqMenuOpen"></i>
            <i class="fas fa-angle-left" v-if="!isCollapsed && !isEcheqMenuOpen"></i>
          </a>
          <ul v-if="isEcheqMenuOpen && !isCollapsed">
            <li>
              <router-link to="/echeq-cartera" :class="{ active: $route.path === '/echeq-cartera' }">
                <i class="far fa-circle"></i>
                <span>Echeq en Cartera</span>
              </router-link>
            </li>
            <li>
              <router-link to="/echeq-endosados" :class="{ active: $route.path === '/echeq-endosados' }">
                <i class="far fa-circle"></i>
                <span>Echeq Endosados</span>
              </router-link>
            </li>
            <li>
              <router-link to="/importar" :class="{ active: $route.path === '/importar' }">
                <i class="far fa-circle"></i>
                <span>Importar</span>
              </router-link>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script>
export default {
  name: "ElegantSidebar",
  props: {
    isCollapsed: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      userName: "Nombre del Usuario",
      isEcheqMenuOpen: false,
    };
  },
  methods: {
    toggleEcheqMenu() {
      this.isEcheqMenuOpen = !this.isEcheqMenuOpen;
    },
  },
};
</script>

<style scoped>
.elegant-sidebar {
  position: fixed;
  top: 60px; /* Comienza justo debajo del Header */
  left: 0;
  height: calc(100vh - 60px); /* Altura ajustada para no superponerse con el Header */
  width: 250px;
  background-color: #ffffff;
  color: #555;
  transition: width 0.3s ease;
  z-index: 1000; /* Asegúrate de que sea menor que el z-index del Header */
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
}

.elegant-sidebar.collapsed {
  width: 80px;
}

.sidebar-logo {
  display: flex;
  align-items: center;
  padding: 20px;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
  text-decoration: none; /* Quitar subrayado del enlace */
  color: inherit; /* Heredar el color del texto */
}

.logo-image {
  width: 40px;
  height: 40px;
}

.logo-text {
  font-size: 1.2rem;
  font-weight: bold;
  margin-left: 10px;
  color: #333;
}

.user-panel {
  padding: 20px;
  display: flex;
  align-items: center;
  border-bottom: 1px solid #e0e0e0;
}

.user-image {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.user-info {
  margin-left: 10px;
}

.user-name {
  font-size: 1rem;
  font-weight: bold;
  color: #333;
}

.user-role {
  font-size: 0.8rem;
  color: #888;
}

.sidebar-menu ul {
  list-style: none;
  padding: 0;
}

.sidebar-menu li a {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  color: #555;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.sidebar-menu li a:hover {
  background-color: #f5f5f5;
}

.sidebar-menu li a.active {
  background-color: #1abc9c;
  color: white;
}

.sidebar-menu li a i {
  margin-right: 10px;
}

.sidebar-menu li ul {
  padding-left: 20px;
}

.sidebar-menu li ul li a {
  padding: 8px 20px;
}

.elegant-sidebar.collapsed .logo-text,
.elegant-sidebar.collapsed .user-info,
.elegant-sidebar.collapsed .sidebar-menu span {
  display: none;
}

.elegant-sidebar.collapsed .sidebar-menu li a {
  justify-content: center;
}
</style>