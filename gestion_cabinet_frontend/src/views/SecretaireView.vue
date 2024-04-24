<script setup></script>

<template>
  <Layout>
    <!-- Navbar -->
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
              <a class="opacity-50 text-slate-700" href="javascript:">Pages</a>
            </li>
            <li
                class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                aria-current="page"
            >
              Secretaires
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize">Secretaires Info</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div
                class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft"
            >
              <span
                  class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all"
              >
                <i class="fas fa-search"></i>
              </span>
              <input
                  type="text"
                  class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                  placeholder="Type here..."
              />
            </div>
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
      <!-- table 1 -->

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div
              class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div
                class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center"
            >
              <h6>Secretary table</h6>
              <div class="flex items-center">
                <input type="text" v-model="searchQuery" placeholder="Search by CIN..." class="border-gray-200 border p-2 rounded-xl mr-2 focus:outline-none" />
                <button @click="searchsecretaire" class="bg-gray-200 text-gray-600 font-semibold py-2 px-3 rounded-xl mr-2">
                  Search
                </button>
                <router-link
                    class="bg-gradient-to-tl from-purple-700 to-pink-500 text-white font-semibold py-2 px-4 rounded-xl cursor-pointer"
                    to="/create-secretary">Ajouter</router-link
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
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Prenom
                    </th>
                    <th
                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Email
                    </th>
                    <th
                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"
                    >
                      Action
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="secretary in secretaries" :key="secretary.id">
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                          <h6 class="mb-0 text-xs font-semibold leading-tight">{{secretary.nom}}</h6>
                        </div>
                      </div>
                    </td>
                    <td
                        class="px-6 py-3 pl-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{secretary.prenom}}</p>
                    </td>
                    <td
                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"
                    >
                      <p class="mb-0 text-xs font-semibold leading-tight">{{secretary.email}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <button @click="editSecretary(secretary.id)" class="mr-8 text-xs font-semibold leading-tight text-blue-400 pr-2 mr-2 bg-blue-100 rounded-lg px-2 py-1">
                        <i class="fas fa-edit"></i> Modifier
                      </button>
                      <button @click="softDeleteSecterary(secretary.id)" class="mr-8 text-xs font-semibold leading-tight text-red-800 pr-2 bg-red-100 rounded-lg px-2 py-1">
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
  name: 'PaymentView',
  components: {
    Layout
  },
  data() {
    return {
      secretaries: [],
      searchQuery: ''
    };
  },
  created() {
    this.fetchSecretaries();
  },
  watch: {
    searchQuery(newSearchQuery) {
      if (!newSearchQuery.trim()) {
        this.fetchSecretaries();
      }
    }
  },
  methods: {
    fetchSecretaries() {
      let url = 'http://localhost:8000/api/index/secretaries';
      if (this.searchQuery) {
        url += `?email=${this.searchQuery}`;
      }
      axios.get(url)
          .then(response => {
            this.secretaries = response.data.secretaries;
            console.log('Fetching  Secreataire successfully', this.secretaries);
          })
          .catch(error => {
            console.error('Error fetching Secreataire:', error);
          });
    },
    editSecretary(secretaryId) {
      this.$router.push('/edit/secretary/' + secretaryId);
    },
    softDeleteSecterary(secretaryId) {
      axios.delete(`http://localhost:8000/api/deletesecretary/${secretaryId}`)
          .then(response => {
            console.log('Secretaire soft deleted successfully ', response.data.message);
            this.loadSecretaries();
          })
          .catch(error => {
            console.error('payment error deleting', error);
          });
    },
    loadSecretaries() {
      this.fetchSecretaries();
    },
    searchsecretaire() {
      this.fetchSecretaries();
    },
  }
}
</script>
<style scoped></style>
