<script setup></script>

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
              rapport
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize">Rapport de Patient</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
          </div>
          <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <li class="flex items-center pl-4 xl:hidden">
              <a
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
      <!-- table 1 -->
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div
              class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div
                class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center"
            >
              <h6>Rapport  table</h6>
              <div class="flex items-center">
                <input @input="searchRapport" type="text" v-model="searchQuery" placeholder="Search by CIN..." class="border-gray-200 border p-2 rounded-xl mr-2 focus:outline-none" />
                <button  class="bg-gray-200 text-gray-600 font-semibold py-2 px-3 rounded-xl mr-2">
                  Search
                </button>
                <router-link
                    class="bg-gradient-to-tl from-purple-700 to-pink-500 text-white font-semibold py-2 px-4 rounded-xl cursor-pointer"
                    to="/add/rapport">Ajouter</router-link
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
                     Type
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Contenu
                    </th>
                    <th
                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Action
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="rapport in rapports" :key="rapport.id">
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                          <h6 class="mb-0 text-sm leading-normal">{{ rapport.nom }}  </h6>

                        </div>
                      </div>
                    </td>
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ rapport.prenom }}</p>
                    </td>
                    <td
                        class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ rapport.cin }}</p>

                    </td>
                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">
                        {{ rapport.type }}
                      </span>
                    </td>
                    <td
                        class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                        <span class="text-xs font-semibold leading-tight text-slate-400"
                        > {{ rapport.content_report }}...</span
                        >
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <button @click="editRapport(rapport.id)" class="mr-8 text-xs font-semibold leading-tight text-blue-400 pr-2 mr-2 bg-blue-100 rounded-lg px-2 py-1">
                        <i class="fas fa-edit"></i> Modifier
                      </button>
                      <button @click="imprimerRapport(rapport.id)" class="mr-8 text-xs font-semibold leading-tight text-green-400 pr-2 mr-2 bg-green-100 rounded-lg px-2 py-1">
                        <i class="fas fa-plus"></i> Imprimer
                      </button>
                      <button @click="softDeleteRapport(rapport.id)" class="mr-8 text-xs font-semibold leading-tight text-red-800 pr-2 bg-red-100 rounded-lg px-2 py-1">
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
import Layout from '../components/Layout-aside.vue'
import axios from 'axios';

export default {
  name: 'RapportView',
  components: {
    Layout
  },
  data() {
    return {
      rapports: [],
      searchQuery: ''
    };
  },
  created() {
    this.fetchRapport();
  },
  watch: {
    searchQuery(newSearchQuery) {
      if (!newSearchQuery.trim()) {
        this.fetchRapport();
      }
    }
  },
  methods: {
    fetchRapport() {
      let url = 'http://localhost:8000/api/all/rapports';
      if (this.searchQuery) {
        url += `?cin=${this.searchQuery}`;
      }
      axios.get(url)
          .then(response => {
            this.rapports = response.data.rapports;
            console.log('Fetching  Rapports successfully', this.rapports);
          })
          .catch(error => {
            console.error('Error fetching Rapports:', error);
          });
    },
    editRapport(rapportId) {
      this.$router.push('/edit/rapport/' + rapportId);
    },
    softDeleteRapport(rapportId) {
      axios.delete(`http://localhost:8000/api/delete/rapport/${rapportId}`)
          .then(response => {
            console.log('Report soft deleted successfully', response.data.message);
            this.loadRapport();
          })
          .catch(error => {
            console.error('Report error deleting', error);
          });
    },
    loadRapport() {
      this.fetchRapport();
    },
    searchRapport() {
      this.fetchRapport();
    },
    imprimerRapport(rapportId){
      this.$router.push('/print/rapport/' + rapportId);
    }
  }
}
</script>
<style scoped></style>
