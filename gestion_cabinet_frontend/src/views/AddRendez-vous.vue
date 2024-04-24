<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form @submit.prevent="submitForm">
        <!-- Input fields for nom, prenom, cin, date_heure, mutuelles, and statut -->
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-6 md:col-span-3">
            <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
            <div class="mt-2">
              <input v-model="nom" type="text" name="nom" id="nom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.nom" class="text-red-500 text-xs">{{ errors.nom[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
            <div class="mt-2">
              <input v-model="prenom" type="text" name="prenom" id="prenom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.prenom" class="text-red-500 text-xs">{{ errors.prenom[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="cin" class="block text-sm font-medium leading-6 text-gray-900">CIN</label>
            <div class="mt-2">
              <input v-model="cin" type="text" name="cin" id="cin" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.cin" class="text-red-500 text-xs">{{ errors.cin[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="date_heure" class="block text-sm font-medium leading-6 text-gray-900">Date et heure</label>
            <div class="mt-2">
              <input v-model="dateHeure" type="datetime-local" name="date_heure" id="date_heure" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.date_heure" class="text-red-500 text-xs">{{ errors.date_heure[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="mutuelles" class="block text-sm font-medium leading-6 text-gray-900">Mutuelles</label>
            <div class="mt-2">
              <input v-model="mutuelles" type="text" name="mutuelles" id="mutuelles" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.mutuelles" class="text-red-500 text-xs">{{ errors.mutuelles[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="statut" class="block text-sm font-medium leading-6 text-gray-900">Statut</label>
            <div class="mt-2">
              <select v-model="statut" name="statut" id="statut" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="nouveau">Nouveau</option>
                <option value="pris en charge">Pris en charge</option>
                <option value="terminé">Terminé</option>
                <option value="reporté">Reporté</option>
              </select>
              <span v-if="errors.statut" class="text-red-500 text-xs">{{ errors.statut[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="type_patient" class="block text-sm font-medium leading-6 text-gray-900">Type Patient</label>
            <div class="mt-2">
              <select v-model="type_patient" name="type_patient" id="type_patient" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="nouveau">Nouveau</option>
                <option value="ancien">Ancien</option>
                <option value="contrôle">Contrôle</option>
              </select>
              <span v-if="errors.type_patient" class="text-red-500 text-xs">{{ errors.type_patient[0] }}</span>
            </div>
          </div>
        </div>

        <!-- Validation button -->
        <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
          Ajouter
        </button>
      </form>
    </div>
  </Layout>
</template>

<script>
import Layout from '../components/Layout-aside.vue';
import axios from 'axios';

export default {
  components: {
    Layout
  },
  data() {
    return {
      nom: '',
      prenom: '',
      cin: '',
      dateHeure: '',
      mutuelles: '',
      statut: 'nouveau',
      type_patient: 'nouveau',
      errors: {}
    };
  },
  methods: {
    submitForm() {
      const formData = {
        nom: this.nom,
        prenom: this.prenom,
        cin: this.cin,
        date_heure: this.dateHeure,
        mutuelles: this.mutuelles,
        statut: this.statut,
        type_patient: this.type_patient
      };

      axios.post('http://localhost:8000/api/addrendez-vous', formData)
          .then(response => {
            console.log('Rendezvous created successfully', response.data);
            this.$router.push('/rendez-vous');

          })
          .catch(error => {

            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.error;
              console.log('Validation Error',error.response.data.error)
            } else {
              console.error('Error creating rendezvous:', error.response.data.error);
            }
          });
    }
  }
};
</script>

<style scoped>
/* Add styling for the borders */
input,
select {
  border: 1px solid #E5E7EB;
  border-radius: 0.375rem;
}
</style>
