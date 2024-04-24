<template>
  <Layout>
    <nav
        class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main
        navbar-scroll="true"
    >
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="leading-normal text-sm">
              <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
            </li>
            <li
                class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                aria-current="page"
            >
              Modifier Rendez-Vous
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize"> Modification</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
          </div>
          <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <li class="flex items-center pl-4 xl:hidden">
              <a
                  href="javascript:"
                  class="block p-0 transition-all ease-nav-brand text-sm text-slate-500"
                  sidenav-trigger
              >
                <div class="w-4.5 overflow-hidden">
                  <i
                      class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"
                  ></i>
                  <i
                      class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"
                  ></i>
                  <i
                      class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"
                  ></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="w-full px-6 py-6 mx-auto">
      <form @submit.prevent="updateRendezVous">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-6 md:col-span-3">
            <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
            <div class="mt-2">
              <input v-model="oldRendez_vous.nom" type="text" name="nom" id="nom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.nom" class="text-red-500 text-xs">{{ errors.nom[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
            <div class="mt-2">
              <input v-model="oldRendez_vous.prenom" type="text" name="prenom" id="prenom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.prenom" class="text-red-500 text-xs">{{ errors.prenom[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="cin" class="block text-sm font-medium leading-6 text-gray-900">CIN</label>
            <div class="mt-2">
              <input v-model="oldRendez_vous.cin" type="text" name="cin" id="cin" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.cin" class="text-red-500 text-xs">{{ errors.cin[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="date_heure" class="block text-sm font-medium leading-6 text-gray-900">Date et heure</label>
            <div class="mt-2">
              <input v-model="oldRendez_vous.dateHeure" type="datetime-local" name="date_heure" id="date_heure" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.date_heure" class="text-red-500 text-xs">{{ errors.date_heure[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="mutuelles" class="block text-sm font-medium leading-6 text-gray-900">Mutuelles</label>
            <div class="mt-2">
              <input v-model="oldRendez_vous.mutuelles" type="text" name="mutuelles" id="mutuelles" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.mutuelles" class="text-red-500 text-xs">{{ errors.mutuelles[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="statut" class="block text-sm font-medium leading-6 text-gray-900">Statut</label>
            <div class="mt-2">
              <select v-model="oldRendez_vous.statut" name="statut" id="statut" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled>Select Status</option>
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
              <select v-model="oldRendez_vous.type_patient" name="type_patient" id="type_patient" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled>Select Type de Patient</option>
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
          Modifier
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
      oldRendezLoaded: false,
      oldRendez_vous:{
        nom: '',
        prenom: '',
        cin: '',
        dateHeure: '',
        mutuelles: '',
        statut: '',
        type_patient: '',
      },
      errors: {}

    };
  },
  mounted() {
    this.loadRendez_Vous()
    console.log(this.$route.params.id)
  },
  methods: {
    loadRendez_Vous() {
      const RendezVousId = this.$route.params.id
      axios
          .get(`http://localhost:8000/api/edit/rendez-vous/${RendezVousId}`)
          .then((response) => {
            this.oldRendez_vous = response.data.rendez_vous
            this.oldRendezLoaded = true
          })
          .catch((error) => {
            console.error('Error fetching old Rendez-Vous information:', error)
          })
    },
    updateRendezVous() {
      const payload = new FormData();
      payload.append('_method','PUT');
      payload.append('nom', this.oldRendez_vous.nom);
      payload.append('prenom', this.oldRendez_vous.prenom);
      payload.append('cin', this.oldRendez_vous.cin);
      payload.append('date_heure', this.oldRendez_vous.dateHeure);
      payload.append('mutuelles', this.oldRendez_vous.mutuelles);
      payload.append('statut', this.oldRendez_vous.statut);
      payload.append('type_patient', this.oldRendez_vous.type_patient);

      axios
          .post(`http://localhost:8000/api/update/rendez-vous/${this.$route.params.id}`, payload)
          .then((response) => {
            alert('Rendez-Vous update successfully!')
            this.$router.push('/rendez-vous');
            if (response && response.data) {
              console.log('Additional data from server:', response.data);
            }
          })
          .catch((error) => {
            console.log(error)
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors;
              console.log('Validation error:', this.errors);
            }else {
              console.error('Error creating rendezvous:', error.response.data.error);
            }
          });
    },
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
