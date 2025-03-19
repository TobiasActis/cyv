<template>
  <div class="login-container">
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
        const response = await axios.post('http://localhost/cyv-proyecto/backend/login.php', {
          username: this.username,
          password: this.password,
        });
        if (response.data.success) {
          localStorage.setItem('user', JSON.stringify(response.data.user)); // Guardar usuario en localStorage
          this.$store.commit('setUser', response.data.user); // Guardar usuario en Vuex
          this.$router.push('/'); // Redirigir al home
        } else {
          alert(response.data.message || 'Credenciales incorrectas');
        }
      } catch (error) {
        console.error('Error al iniciar sesión:', error);
        alert('Hubo un error al iniciar sesión');
      }
    },
  },
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: url('/src/assets/background.jpg') no-repeat center center fixed; /* Ruta a tu imagen de fondo */
  background-size: cover;
}

.login {
  padding: 20px;
  max-width: 400px;
  background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente para el cuadro de login */
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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