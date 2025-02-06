<template>
  <div id="app">
    <Header @toggle-sidebar="toggleSidebar" :isCollapsed="isSidebarCollapsed" />
    <Sidebar v-if="showSidebar" :isCollapsed="isSidebarCollapsed" />
    <router-view :class="{ 'content': showSidebar, 'content-no-sidebar': !showSidebar }" />
    <Footer v-if="showFooter" />
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';

export default {
  name: 'App',
  components: {
    Header,
    Sidebar,
    Footer,
  },
  data() {
    return {
      isSidebarCollapsed: false,
    };
  },
  computed: {
    showSidebar() {
      return this.$route.path !== '/login';
    },
    showFooter() {
      return this.$route.path !== '/login';
    },
  },
  methods: {
    toggleSidebar() {
      this.isSidebarCollapsed = !this.isSidebarCollapsed;
    },
  },
};
</script>

<style scoped>
#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f9f9f9;
}

.content {
  margin-left: 250px;
  padding: 20px;
  margin-top: 60px; /* Asegúrate de que el contenido no se superponga con el Header */
  transition: margin-left 0.3s ease;
}

.content.collapsed {
  margin-left: 80px;
}

.content-no-sidebar {
  margin-left: 0;
  padding: 20px;
  margin-top: 60px; /* Asegúrate de que el contenido no se superponga con el Header */
}
</style>