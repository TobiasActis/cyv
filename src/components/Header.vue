<template>
  <nav class="elegant-header">
    <!-- Botón para alternar el Sidebar -->
    <div class="header-left">
      <button class="toggle-sidebar" @click="toggleSidebar" title="Abrir/Cerrar Sidebar">
        <i class="fas fa-bars"></i>
        <span v-if="!isCollapsed">Menú</span>
      </button>
    </div>

    <!-- Enlaces -->
    <div class="header-center">
      <a href="#" class="nav-link">
        <i class="fas fa-edit"></i>
        <span>Pruebas</span>
      </a>
      <a href="#" class="nav-link">
        <i class="fas fa-money-bill"></i>
        <span>Nuevo Endoso</span>
      </a>
    </div>

    <!-- Botón de cierre de sesión -->
    <div class="header-right">
      <button class="logout-button" @click="logout" title="Cerrar sesión">
        <i class="fas fa-power-off"></i>
      </button>
    </div>
  </nav>
</template>

<script>
export default {
  name: "ElegantHeader",
  props: {
    isCollapsed: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    toggleSidebar() {
      this.$emit("toggle-sidebar");
    },
    logout() {
      alert("Cerrar sesión");
    },
  },
};
</script>

<style scoped>
.elegant-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #ffffff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1001; /* Asegúrate de que sea mayor que el z-index del Sidebar */
  height: 60px; /* Altura fija para el Header */
}

.header-left,
.header-center,
.header-right {
  display: flex;
  align-items: center;
}

.toggle-sidebar {
  background: none;
  border: none;
  font-size: 1.2rem;
  color: #555;
  cursor: pointer;
  padding: 10px;
  transition: color 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.toggle-sidebar:hover {
  color: #1abc9c;
}

.header-center {
  gap: 20px;
}

.nav-link {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #555;
  font-size: 1rem;
  padding: 10px;
  transition: color 0.3s ease;
}

.nav-link i {
  margin-right: 8px;
}

.nav-link:hover {
  color: #1abc9c;
}

.logout-button {
  background: none;
  border: none;
  font-size: 1.2rem;
  color: #555;
  cursor: pointer;
  padding: 10px;
  transition: color 0.3s ease;
}

.logout-button:hover {
  color: #e74c3c;
}
</style>