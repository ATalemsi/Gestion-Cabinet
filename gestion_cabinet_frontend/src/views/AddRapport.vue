<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form @submit.prevent="submitForm">
        <div class="space-y-12">
        <!-- Input fields for nom, prenom, cin, date_heure, mutuelles, and statut -->
        <div class="border-b border-gray-900/10 pb-12">
         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-6 md:col-span-3">
            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
            <div class="mt-2">
              <select v-model="type" name="type" id="type" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Choisi type</option>
                <option value="medical_report">Rapport Médicale</option>
                <option value="medical_certificate">certificat Médicale</option>
                <option value="ordonnances">Ordonnances</option>
              </select>
              <span v-if="errors.type" class="text-red-500 text-xs">{{ errors.type[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="client_id" class="block text-sm font-medium leading-6 text-gray-900">Patient</label>
            <div class="mt-2">
              <select v-model="client_id" name="client_id" id="client_id" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Select Patient</option>
                <option v-for="client in clientList" :key="client.id" :value="client.id">{{ client.nom }} / {{ client.prenom }} / {{ client.cin }}</option>
              </select>
              <span v-if="errors.client_id" class="text-red-500 text-xs">{{ errors.client_id[0] }}</span>
            </div>
          </div>
          <div class="col-span-full ">
            <label for="content_report" class="block text-sm font-medium leading-6 text-gray-900">Content</label>
            <div class="mt-2">
              <textarea  id="content" v-model="content_report" name="content_report" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            <p v-if="errors.content_report" class="text-red-500 text-sm">
              {{ errors.content[0] }}
            </p>
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
import Layout from '../components/Layout-aside.vue';
import axios from 'axios';

export default {
  name: 'AddRapport',
  components: {
    Layout
  },
  data() {
    return {
      type: '',
      content: '',
      client_id: '',
      errors: {},
      clientList: [],
    };
  },
  created() {
    this.fetchClientData();
  },
  methods: {
    fetchClientData() {
      axios.get('http://localhost:8000/api/index/patient')
          .then(response => {
            this.clientList = response.data.clients;
          })
          .catch(error => {
            console.error('Error fetching client data:', error);
          });
    },
    submitForm() {
      const formData = {
        type: this.type,
        content_report: this.content_report,
        client_id: this.client_id
      };

      axios.post('http://localhost:8000/api/addmanualreport', formData)
          .then(response => {
            console.log('Report created successfully', response.data);
            this.$router.push('/rapport');
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.error;
            } else {
              console.error('Error creating report:', error.response.data.error);
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
