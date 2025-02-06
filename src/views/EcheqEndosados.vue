<template>
  <div class="echeq-endosados">
    <h1>Echeq Endosados</h1>
    <div class="content">
      <p>Aquí va el contenido de Echeq Endosados.</p>
      <table class="table">
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
  name: 'EcheqEndosados',
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
.echeq-endosados {
  padding: 20px;
}

.content {
  margin-top: 20px;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  border: 1px solid #ddd;
  padding: 8px;
}

.table th {
  background-color: #f4f4f4;
  color: #333;
}
</style>