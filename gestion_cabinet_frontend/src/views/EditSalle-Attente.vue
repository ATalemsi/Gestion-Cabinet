<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form v-if="oldSalleLoaded"
          @submit.prevent="updateSalle">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Modifiere A Salle Attente</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Modifier toutes les informations sur votre nouveau Attender</p>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-6 md:col-span-3">
                <label for="heure_arrivee" class="block text-sm font-medium leading-6 text-gray-900">Heure d'arrivée</label>
                <div class="mt-2">
                  <input v-model="oldSalleAttente.heure_arrivee" type="time" name="heure_arrivee" id="heure_arrivee" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.heure_arrivee" class="text-red-500 text-xs">{{ errors.heure_arrivee[0] }}</span>
                </div>
              </div>
              <div class="sm:col-span-6 md:col-span-3">
                <label for="heure_controle" class="block text-sm font-medium leading-6 text-gray-900">Heure de contrôle</label>
                <div class="mt-2">
                  <input v-model="oldSalleAttente.heure_controle" type="time" name="heure_controle" id="heure_controle" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.heure_controle" class="text-red-500 text-xs">{{ errors.heure_controle[0] }}</span>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="my-4 bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Modifier
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
      oldSalleLoaded: false,
      oldSalleAttente: {
        heure_arrivee: '',
        heure_controle: '',
        rendez_vouses_id: '',
      },
      rendezVousList: [],
      errors: {}
    };
  },
  mounted() {
    this.loadSalle_attente()
    console.log(this.$route.params.id)
  },
  created() {
    this.fetchRendezVousData();
  },
  methods: {
    loadSalle_attente() {
      const SalleAttenteId = this.$route.params.id
      axios
          .get(`https://api.majrinadiapsychiatre.com/api/edit/salle-attente/${SalleAttenteId}`)
          .then((response) => {
            this.oldSalleAttente = response.data.salle_attente
            console.log('success fetching old Salle attente information:', this.oldSalleAttente)
            this.oldSalleLoaded = true
          })
          .catch((error) => {
            console.error('Error fetching old Salle attente information:', error)
          })
    },
    fetchRendezVousData() {
      axios.get('https://api.majrinadiapsychiatre.com/api/all/rendez-vous')
          .then(response => {
            this.rendezVousList = response.data.rendez_vous;
          })
          .catch(error => {
            console.error('Error fetching rendez-vous data:', error);
          });
    },
    updateSalle() {

      const formData = new FormData();
      formData.append('_method','PUT');
      formData.append('heure_arrivee', this.oldSalleAttente.heure_arrivee);
      formData.append('heure_controle', this.oldSalleAttente.heure_controle);
      formData.append('rendez_vouses_id', this.oldSalleAttente.rendez_vouses_id);

      axios.post(`https://api.majrinadiapsychiatre.com/api/update/salle-attente/${this.$route.params.id}`, formData)
          .then(response => {
            console.log('Salle attente memebre created successfully', response.data.waiting_room_entry);
            alert('update  dans la salle attente ')
            this.$router.push('/salle-attend');
            if (response && response.data) {
              console.log('Additional data from server:', response.data);
            }
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
