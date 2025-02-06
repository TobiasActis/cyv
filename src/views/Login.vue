<template>
  <div class="login">
    <h1>Iniciar Sesión</h1>
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="username">Usuario:</label>
        <input type="text" id="username" v-model="username" required />
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">Iniciar Sesión</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://tu-backend.com/login.php', {
          username: this.username,
          password: this.password,
        });
        if (response.data.success) {
          this.$store.commit('setUser', response.data.user); // Guardar usuario en Vuex
          this.$router.push('/'); // Redirigir al home
        } else {
          alert('Credenciales incorrectas');
        }
      } catch (error) {
        console.error('Error al iniciar sesión:', error);
      }
    },
  },
};
</script>

<style scoped>
.login {
  padding: 20px;
  max-width: 400px;
  margin: 0 auto; /* Centrar el formulario */
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>