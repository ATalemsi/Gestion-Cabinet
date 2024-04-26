<template>
  <Layout>
 <div class="w-full px-6 py-6 mx-auto">
  <div class="container">
    <div class="header">
      <h1>Information génerale</h1>
    </div>
    <div class="doctor-info">
      <div class="info-column">
        <span>Dr. Nadia Majri</span><br>
        <span>PSYCIATRE</span><br>
        <span>Diplome de Master en Neurosciences</span><br>
        <span>Bd Kennedy, Rés Nassim- N°17 </span><br>
        <span>Appt N° 05, 3éme étage-safi</span><br>
        <span>nadiamajri@yahoo.fr</span><br>
        <span>06-77-23-56-43</span>
      </div>
    </div>
    <div class="patient-info">
      <h2>Patient Information: </h2><br>
      <span><strong>Nom De Patient:</strong> {{reportContent.nom}} {{reportContent.prenom}}</span><br>
      <span><strong>CIN:</strong> {{reportContent.cin}} </span><br>
      <span><strong>Telephone : </strong> {{reportContent.telephone}}</span><br>
    </div>
    <div class="report">
      <div class="header">
        <h1>Rapport Médicale</h1>
      </div>
      <div class="objective">
        <h2>Type de rapport : </h2>
        <p>{{ reportContent.type}}</p>
      </div>
      <div class="content">
        <h2>Contenue de Rapport:</h2>
        <p>{{reportContent.content_report}}</p>
      </div>
    </div>

    <button class="print-button" @click="printReport">Print this report</button>
  </div>
 </div>
</Layout>
</template>
<script>
import Layout from "@/components/Layout-aside.vue";
import axios from 'axios';
export default {
  name: 'RapportView',
  components: {
    Layout
  },
  data(){
    return {
      reportContent: {
        nom: '',
        prenom: '',
        cin: '',
        telephone: '',
        type: '',
        content_report: '',
      }
    }
  },
  mounted() {
    this.rapportData();
    console.log(this.$route.params.id)
  },
  methods:{
    rapportData() {
      axios.get(`http://localhost:8000/api/print/rapport/${this.$route.params.id}`)
          .then(response => {
            this.reportContent = response.data.rapport;
            console.log('add',response.data.rapport)
          })
          .catch(error => {
            console.error('Error fetching report content:', error);
          });
    },
  }
}
</script>
<script setup>
const printReport = () => {
  window.print();
}
</script>
<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  color: #141727;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header {
  text-align: center;
  margin-bottom: 20px;
}

.header h1 {
  margin: 0;
  color: #333;
}

.doctor-info {
  display: block;
  flex-direction: column;
  margin-bottom: 20px;
}
.patient-info h2{
  color: #3a416f;
  font-weight: bold;
  font-size: 17px;
  margin-top: 1.5rem;
}
.info-column {
  margin-right: 20px;
}

.patient-info {
  margin-bottom: 20px;
}

.report {
  border-top: 1px solid #ccc;
  padding-top: 20px;
}

.objective h2 {
  color: #333;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}
.content{
  margin-top: 1rem;
}
.content h2{
  color: #333;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}
.content p {
  line-height: 1.6;

}
.print-button:hover {
  background-color: #0056b3;
}
.print-button {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* CSS for print view */
@media print {
  .print-button {
    display: none; /* Hide the button in print view */
  }
}
</style>
