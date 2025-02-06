<template>
  <div class="importar">
    <h1>Importar</h1>
    <div class="content">
      <p>Aquí va el formulario para importar datos.</p>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="file">Seleccionar archivo Excel:</label>
          <input type="file" id="file" @change="handleFileUpload" accept=".xls,.xlsx" />
        </div>
        <button type="submit" class="btn">Importar</button>
      </form>
      <table v-if="excelData.length">
        <thead>
          <tr>
            <th v-for="(header, index) in headers" :key="index">{{ header }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, rowIndex) in excelData" :key="rowIndex">
            <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{ cell }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import * as XLSX from 'xlsx';
import { mapActions } from 'vuex';

export default {
  name: 'Importar',
  data() {
    return {
      excelData: [],
      headers: []
    };
  },
  methods: {
    ...mapActions(['updateExcelData']),
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];
        const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        console.log('jsonData:', jsonData);

        this.headers = jsonData[0];
        this.excelData = jsonData.slice(1);
        this.updateExcelData(jsonData.slice(1)); // Guardar en la store

        // Llamar a la función para enviar los datos a PHP
        const mappedData = this.mapData(jsonData.slice(1));
        console.log('mappedData:', mappedData);
        this.guardarDatos(mappedData);
      };

      reader.readAsArrayBuffer(file);
    },
    mapData(data) {
      return data.map(row => ({
        numero: row[3] || '',
        cliente: row[11] || '',
        banco: row[6] || '',
        importe: row[18] || 0,
        vencimiento: row[10] || '',
        estado: row[24] || ''
      }));
    },
    guardarDatos(cheques) {
      console.log('cheques:', cheques);
      // Hacer una petición POST para enviar los datos al PHP
      fetch('http://localhost/cyv-proyecto/backend/save_cheques.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(cheques), // Convertir los datos a JSON
        credentials: 'same-origin', // Asegúrate de incluir las credenciales si estás usando cookies
      })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert('Error: ' + data.error);
        } else {
          alert('Datos guardados con éxito');
          console.log(data);
        }
      })
      .catch(error => {
        alert('Hubo un error al guardar los datos');
        console.error(error);
      });
    }
  },
};
</script>

<style scoped>
.importar {
  padding: 20px;
}

.content {
  margin-top: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="file"] {
  display: block;
  margin-top: 5px;
}

.btn {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}
</style>