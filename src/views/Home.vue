<template>
  <div class="home">
    <h1>Echeq en Cartera</h1>

    <!-- Tarjetas informativas -->
    <div class="info-cards">
      <div class="card">
        <span class="card-title">Echeq en Cartera</span>
        <span class="card-value">11.9</span>
        <span class="card-subtext">$ 155.148.157,45</span>
      </div>
      <div class="card">
        <span class="card-title">Echeq para Endosar</span>
        <span class="card-value">4</span>
        <span class="card-subtext">$ 14.923.843,53</span>
      </div>
      <div class="card">
        <span class="card-title">Echeq Endosados Hoy</span>
        <span class="card-value">0</span>
        <span class="card-subtext">$ 0,00</span>
      </div>
      <div class="card">
        <span class="card-title">Echeq Rechazados</span>
        <span class="card-value">🔍</span>
        <span class="card-subtext">Más información</span>
      </div>
    </div>

    <!-- Listado de Echeq -->
    <div class="table-container">
      <table class="elegant-table">
        <thead>
          <tr>
            <th>Número</th>
            <th>Monto</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cheque in cheques" :key="cheque.numero">
            <td>{{ cheque.numero }}</td>
            <td>{{ cheque.monto }}</td>
            <td>{{ cheque.fecha }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      cheques: [
        { numero: 1, monto: 1000, fecha: '2023-10-01' },
        { numero: 2, monto: 2000, fecha: '2023-10-02' },
        { numero: 3, monto: 3000, fecha: '2023-10-03' },
      ],
    };
  },
};
</script>

<style scoped>
.home {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.info-cards {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
}

.card {
  flex: 1;
  background-color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.card-title {
  font-size: 1rem;
  color: #555;
}

.card-value {
  font-size: 2rem;
  font-weight: bold;
  color: #2c3e50;
}

.card-subtext {
  font-size: 0.9rem;
  color: #888;
}

.elegant-table {
  width: 100%;
  border-collapse: collapse;
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.elegant-table th,
.elegant-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.elegant-table th {
  background-color: #f8f9fa;
  color: #333;
}

.elegant-table tbody tr:hover {
  background-color: #f1f1f1;
}
</style>