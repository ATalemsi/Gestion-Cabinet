<template>
  <Layout>
    <nav
        class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main
        navbar-scroll="true"
    >
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="leading-normal text-sm">
              <a class="opacity-50 text-slate-700">Pages</a>
            </li>
            <li
                class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                aria-current="page"
            >
              Ordonnances
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize">Ordonnances</h6>
        </nav>
      </div>
    </nav>
    <div class="w-full px-6 py-6 mx-auto">
      <!-- table 1 -->
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div
              class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div
                class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center"
            >
              <h6>Ordonnances table</h6>
              <div class="flex items-center">
                <input @input="searchOrdonnance" type="text" v-model="searchQuery" placeholder="Search by CIN..." class="border-gray-200 border p-2 rounded-xl mr-2 focus:outline-none" />
                <button @click="searchOrdonnance" class="bg-gray-200 text-gray-600 font-semibold py-2 px-3 rounded-xl mr-2">
                  Chercher
                </button>
                <router-link
                    class="bg-gradient-to-tl from-purple-700 to-pink-500 text-white font-semibold py-2 px-4 rounded-xl cursor-pointer"
                    to="/add/ordonnance">Ajouter</router-link
                >
              </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                  <tr>
                    <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Nom
                    </th>
                    <th
                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Prenom
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      CIN
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Date
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Médicaments
                    </th>
                    <th
                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Action
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="ordonnance in ordonnances" :key="ordonnance.id">
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                          <h6 class="mb-0 text-sm leading-normal">{{ ordonnance.nom }}  </h6>
                        </div>
                      </div>
                    </td>
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ ordonnance.prenom }}</p>
                    </td>
                    <td
                        class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ ordonnance.cin }}</p>
                    </td>
                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">
                        {{ new Date(ordonnance.date).toLocaleDateString() }}
                      </span>
                    </td>
                    <td
                        class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                        <span class="text-xs font-semibold leading-tight text-slate-400"
                        > {{ ordonnance.medications.name ? ordonnance.medication.name.join(', ') : '' }}...</span
                        >
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <button @click="imprimerOrdonnance(ordonnance.id)" class="mr-8 text-xs font-semibold leading-tight text-green-400 pr-2 mr-2 bg-green-100 rounded-lg px-2 py-1">
                        <i class="fas fa-plus"></i> Imprimer
                      </button>
                      <button @click="softDeleteOrdonnance(ordonnance.id)" class="mr-8 text-xs font-semibold leading-tight text-red-800 pr-2 bg-red-100 rounded-lg px-2 py-1">
                        <i class="fas fa-trash-alt"></i> supprimer
                      </button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from '../components/Layout-aside.vue';
import axios from 'axios';

export default {
  name: 'OrdonancesView',
  components: {
    Layout
  },
  data() {
    return {
      ordonnances: [],
      searchQuery: ''
    };
  },
  created() {
    this.fetchOrdonnances();
  },
  watch: {
    searchQuery(newSearchQuery) {
      if (!newSearchQuery.trim()) {
        this.fetchOrdonnances();
      }
    }
  },
  methods: {
        fetchOrdonnances() {
        let url = 'https://api.majrinadiapsychiatre.com/api/all/ordonnances';
        if (this.searchQuery) {
        url += `?cin=${this.searchQuery}`;
        }
        axios.get(url)
        .then(response => {
            this.ordonnances = response.data.ordonnances;
            console.log('Fetching Ordonnances successfully', this.ordonnances);
        })
        .catch(error => {
            console.error('Error fetching Ordonnances:', error);
        });
    },
    softDeleteOrdonnance(ordonnanceId) {
      axios.delete(`https://api.majrinadiapsychiatre.com/api/delete/ordonnance/${ordonnanceId}`)
          .then(response => {
            console.log('Ordonnance soft deleted successfully', response.data.message);
            this.loadOrdonnances();
          })
          .catch(error => {
            console.error('Error deleting Ordonnance', error);
          });
    },
    loadOrdonnances() {
      this.fetchOrdonnances();
    },
    searchOrdonnance() {
      this.fetchOrdonnances();
    },
    imprimerOrdonnance(ordonnanceId){
      this.$router.push('/print/ordonnance/' + ordonnanceId);
    }
  }
}
</script>

<style scoped></style>
