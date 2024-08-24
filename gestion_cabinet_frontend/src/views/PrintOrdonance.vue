<template>
  <router-link
    to="/dashboard"
    class="mx-6 inline-block mt-4 py-2 px-4 rounded-lg text-white bg-gradient-to-r from-red-500 via-pink-600 to-pink-700 hover:from-red-600 hover:via-pink-700 hover:to-pink-800 focus:outline-none mx-auto block text-center"
  >
    Retour au tableau de bord
  </router-link>
  <div
    class=" text-xs relative bg-white p-8 border border-gray-300 rounded-lg shadow-lg mx-auto max-w-3xl overflow-hidden"
  >
    <!-- Semi-transparent background image -->
    <img
      src="../assets/img/LogoCabinet.png"
      alt="Background Logo"
      class="absolute inset-0 w-full h-full object-cover object-center opacity-20 z-0"
    />
    <div class="relative z-10">
      <div class="header flex justify-between items-center mb-8">
        <div class="left-header w-1/3 text-center">
          <span class="block mb-2">الطبيبة نادية ماجري</span>
          <span class="block mb-2">طبيبة اختصاصية في الأمراض</span>
          <span class="block mb-2">النفسية والعقلية</span>
          <span class="block mb-2">حاملة شهادة الماجستير في العلوم العصبية</span>
          <span class="block mb-2">خريجة كلية الطب بالدار البيضاء</span>
          <span class="block mb-2">طبيبة سابقة بالمستشفى الجامعي ابن رشد</span>
          <span class="block">طبيبة سابقة بمستشفى محمد الخامس - آسفي</span>
        </div>
        <div class="center-header w-1/3 text-center">
          <img src="../assets/img/LogoCabinet.png" alt="Logo" class="mx-auto mb-4 w-24" />
          <h1 class="text-2xl font-semibold text-purple-700">{{ ordonnanceContent.type }}</h1>
        </div>
        <div class="right-header w-1/3 text-center">
          <span class="block mb-2">Docteur Nadia Majri</span>
          <span class="block mb-2">PSYCHIATRE</span>
          <span class="block mb-2">Diplôme de Master en Neurosciences</span>
          <span class="block mb-2">Lauréate de la Faculté de Médecine de Casablanca</span>
          <span class="block mb-2">Ex. Psychiatre au CHU Ibn Rochd</span>
          <span class="block">Ex. Psychiatre Hôpital Med-V - SAFI</span>
        </div>
      </div>
      <div class="patient-info mb-8 text-center">
        <span class="block text-lg font-medium"
          >{{ ordonnanceContent.nom }} {{ ordonnanceContent.prenom }}</span
        >
        <span class="block text-sm text-gray-600">{{ ordonnanceContent.client_cin }}</span>
      </div>

      <div class="content mb-8 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Médicaments :</h3>
        <ul class="list-disc list-inside mx-auto text-left max-w-2xl">
          <li
            v-for="(medication, index) in ordonnanceContent.medications"
            :key="index"
            class="mb-2"
          >
            <strong class="text-gray-700">{{ medication.name }}</strong
            >: {{ medication.dosage }}
            <p class="text-gray-600">Instructions: {{ medication.description }}</p>
          </li>
        </ul>
      </div>

      <p class="signature text-right mb-6">SAFI, le __________________</p>
      <div class="footer text-center border-t border-gray-300 pt-4 mt-4">
        <p class="text-sm text-gray-600 mb-1">
          Bd Kennedy, Rés Nassim- N°17, Appt N° 05, 3ème étage-SAFI
        </p>
        <p class="text-sm text-gray-600">Email: nadia.majri@yahoo.fr | Téléphone: 06-77-23-56-43</p>
      </div>

      <button
        class="print-button mt-8 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none block mx-auto"
        @click="printReport"
      >
        Imprimer ce rapport
      </button>
    </div>
  </div>
</template>

<script>
import Layout from '@/components/Layout-aside.vue'
import axios from 'axios'
export default {
  name: 'PrintOrdonance',
  components: {
    Layout
  },
  data() {
    return {
      ordonnanceContent: {
        client_name: '',
        client_cin: '',
        medications: '[]',
        description: ''
      }
    }
  },
  mounted() {
    this.fetchOrdonanceData()
  },
  methods: {
    fetchOrdonanceData() {
      axios
        .get(`https://api.majrinadiapsychiatre.com/api/ordonance/${this.$route.params.id}`)
        .then((response) => {
          this.ordonnanceContent = response.data.ordonance
          // Parse medications field
          this.ordonnanceContent.medications = JSON.parse(this.ordonnanceContent.medications)
        })
        .catch((error) => {
          console.error('Error fetching ordonnance content:', error)
        })
    },
    printReport() {
      window.print()
    }
  }
}
</script>

<style scoped>
/* Tailwind CSS is used for styling, so no additional scoped CSS needed */
@media print {
  .print-button {
    display: none; /* Hide the button in print view */
  }
  .burger-menu {
    display: none;
  }
}
</style>
