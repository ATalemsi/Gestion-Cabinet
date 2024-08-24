<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form
          v-if="oldRapportLoaded"
          @submit.prevent="updateRapport">
        <div class="space-y-12">
          <!-- Input fields for nom, prenom, cin, date_heure, mutuelles, and statut -->
          <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-6 md:col-span-3">
                <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                <div class="mt-2">
                  <select v-model="oldRapport.type" name="type" id="type" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" disabled selected>Choisi type</option>
                    <option value="medical_report">Rapport Médicale</option>
                    <option value="medical_certificate">certificat Médicale</option>
                    <option value="ordonnances">Ordonnances</option>
                  </select>
                  <span v-if="errors.type" class="text-red-500 text-xs">{{ errors.type[0] }}</span>
                </div>
              </div>
              <div class="col-span-full ">
                <label for="content_report" class="block text-sm font-medium leading-6 text-gray-900">Content</label>
                <div class="mt-2">
                  <textarea  id="content" v-model="oldRapport.content_report" name="content_report" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="errors.content_report" class="text-red-500 text-sm">
                  {{ errors.content[0] }}
                </p>
              </div>
            </div>
          </div>

          <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Modifier
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
      oldRapportLoaded: false,
      oldRapport: {
        type: '',
        content: '',
      },
      errors: {},
      clientList: [],
    };
  },
  mounted() {
    this.loadRapport()
    console.log(this.$route.params.id)
  },
  created() {
    this.fetchClientData();
  },
  methods: {
    loadRapport() {
      const rapportId = this.$route.params.id
      axios
          .get(`https://api.majrinadiapsychiatre.com/api/edit/rapport/${rapportId}`)
          .then((response) => {
            this.oldRapport = response.data.rapport
            console.log('Success fetching old Salle attente information:', this.oldRapport)
            this.oldRapportLoaded = true
          })
          .catch((error) => {
            console.error('Error fetching old Salle attente information:', error.response.data)
          })
    },
    fetchClientData() {
      axios.get('https://api.majrinadiapsychiatre.com/api/index/patient')
          .then(response => {
            this.clientList = response.data.clients;
          })
          .catch(error => {
            console.error('Error fetching client data:', error);
          });
    },
    updateRapport() {
      const formData = new FormData();
      formData.append('_method','PUT');
      formData.append('type', this.oldRapport.type);
      formData.append('content_report', this.oldRapport.content_report);
      axios.post(`https://api.majrinadiapsychiatre.com/api/update/rapport/${this.$route.params.id}`, formData)
          .then(response => {
            console.log('Report updated successfully', response.data);
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
