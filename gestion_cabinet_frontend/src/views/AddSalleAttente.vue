<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form @submit.prevent="submitForm">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Ajouter A Salle Attente</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Entrer toutes les informations sur votre nouveau Attender</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-6 md:col-span-3">
                <label for="heure_arrivee" class="block text-sm font-medium leading-6 text-gray-900">Heure d'arrivée</label>
                <div class="mt-2">
                  <input v-model="heureArrivee" type="time" name="heure_arrivee" id="heure_arrivee" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.heure_arrivee" class="text-red-500 text-xs">{{ errors.heure_arrivee[0] }}</span>
                </div>
              </div>
              <div class="sm:col-span-6 md:col-span-3">
                <label for="heure_controle" class="block text-sm font-medium leading-6 text-gray-900">Heure de contrôle</label>
                <div class="mt-2">
                  <input v-model="heureControle" type="time" name="heure_controle" id="heure_controle" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.heure_controle" class="text-red-500 text-xs">{{ errors.heure_controle[0] }}</span>
                </div>
              </div>
              <div class="sm:col-span-6 md:col-span-3">
                <label for="rendez_vouses_id" class="block text-sm font-medium leading-6 text-gray-900">Patient</label>
                <div class="mt-2">
                  <select v-model="selectedRendezVous" name="rendez_vouses_id" id="rendez_vouses_id" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" disabled selected>Select Patient</option>
                    <option v-for="rendezVous in rendezVousList" :key="rendezVous.id" :value="rendezVous.id">{{ rendezVous.nom }} , {{ rendezVous.prenom }},{{ rendezVous.cin }}</option>
                  </select>
                  <span v-if="errors.rendez_vouses_id" class="text-red-500 text-xs">{{ errors.rendez_vouses_id[0] }}</span>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Ajouter
          </button>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script>
import Layout from '../components/Layout-aside.vue'
import axios from 'axios';

export default {
  components: {
    Layout
  },
  data() {
    return {
      heureArrivee: '',
      heureControle: '',
      selectedRendezVous: '',
      rendezVousList: [],
      errors: {}
    };
  },
  created() {
    this.fetchRendezVousData();
  },
  methods: {
    fetchRendezVousData() {
      axios.get('https://api.majrinadiapsychiatre.com/api/all/rendez-vous')
          .then(response => {
            this.rendezVousList = response.data.rendez_vous;
          })
          .catch(error => {
            console.error('Error fetching rendez-vous data:', error);
          });
    },
    submitForm() {
      const formData = new FormData();
      formData.append('heure_arrivee', this.heureArrivee);
      formData.append('heure_controle', this.heureControle);
      formData.append('rendez_vouses_id', this.selectedRendezVous);

      axios.post('https://api.majrinadiapsychiatre.com/api/add/salle-attente', formData)
          .then(response => {
            console.log('Salle attente member created successfully', response.data);
            alert('enter dans la salle attente ')
            this.$router.push('/salle-attend');
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.error;
              console.log('Validation Error',error.response.data.error)
            } else {
              console.error('Error creating rendezvous:', error.response.data.errors);
            }
          });
    }
  }
}
</script>

<style scoped>
/* Add styling for the borders */
input,
select {
  border: 1px solid #E5E7EB;
  border-radius: 0.375rem;
}
</style>
