<template>
  <div class="echeq-cartera">
    <h1>Echeq en Cartera</h1>
    <div class="content">
      <table class="table">
        <thead>
          <tr>
            <th>Numero</th>
            <th>Cliente</th>
            <th>Banco</th>
            <th>Importe</th>
            <th>Fecha de Ingreso</th>
            <th>Vencimiento</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cheque in cheques" :key="cheque.id">
            <td>{{ cheque.numero }}</td>
            <td>{{ cheque.cliente }}</td>
            <td>{{ cheque.banco }}</td>
            <td>{{ formatCurrency(cheque.importe) }}</td>
            <td>{{ cheque.fecha_ingreso }}</td>
            <td>{{ cheque.vencimiento }}</td>
            <td>{{ cheque.estado }}</td>
            <td>
              <!-- Aquí puedes agregar botones para acciones -->
              <button @click="editarCheque(cheque.id)">Editar</button>
              <button @click="eliminarCheque(cheque.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "EcheqCartera",
  data() {
    return {
      cheques: [],
    };
  },
  mounted() {
    this.fetchCheques();
  },
  methods: {
    async fetchCheques() {
      try {
        const response = await fetch("http://localhost/cyv-proyecto/backend/get_cheques.php");
        const data = await response.json();
        this.cheques = data;
      } catch (error) {
        console.error("Error al obtener los cheques:", error);
      }
    },
    editarCheque(id) {
      // Lógica para editar cheque
      console.log("Editar cheque con ID:", id);
    },
    eliminarCheque(id) {
      // Lógica para eliminar cheque
      console.log("Eliminar cheque con ID:", id);
    },
    formatCurrency(value) {
      return `$${value.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }
  },
};
</script>

<style scoped>
.echeq-cartera {
  padding: 20px;
}

.content {
  margin-top: 20px;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.table th {
  background-color: #f4f4f4;
  color: #333;
}

button {
  margin-right: 5px;
  padding: 5px 10px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}
</style>