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
              <a class="opacity-50 text-slate-700" href="#">Pages</a>
            </li>
            <li
              class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
              aria-current="page"
            >
              Activities
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize">Activities</h6>
        </nav>
      </div>
    </nav>

    <!-- end Navbar -->

    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
      <!-- row 1 -->
      <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal text-sm">Totale d'argent</p>
                    <h5 class="mb-0 font-bold">
                      {{ totalAmount }}
                      <span class="leading-normal text-sm font-weight-bolder text-lime-500"
                        >DH</span
                      >
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div
                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500"
                  >
                    <i
                      class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal text-sm">total Patients</p>
                    <h5 class="mb-0 font-bold">
                      {{ totalPatients }}
                      <span class="leading-normal text-sm font-weight-bolder text-lime-500"
                        >+</span
                      >
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div
                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500"
                  >
                    <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal text-sm"> Rendez-vous de Jour </p>
                    <h5 class="mb-0 font-bold">
                      {{patientsInWaitingRoom }}
                      <span class="leading-normal text-green-600 text-sm font-weight-bolder"
                        >+</span
                      >
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div
                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500"
                  >
                    <i
                      class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
          <div
            class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border"
          >
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans font-semibold leading-normal text-sm">Moyen D'argent</p>
                    <h5 class="mb-0 font-bold">
                      {{  averagePaymentAmount }}
                      <span class="leading-normal text-sm font-weight-bolder text-lime-500"
                        >DH</span
                      >
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div
                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500"
                  >
                    <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap my-6 -mx-3">
        <!-- card 1 -->
        <div
          class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none"
        >
          <div
            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"
          >
            <div
              class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0"
            >
              <div class="flex flex-wrap mt-0 -mx-3">
                <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                  <h6>Salle D'attente</h6>
                  <p class="mb-0 leading-normal text-sm">
                    <i class="fa fa-check text-cyan-500"></i>
                    <span class="ml-1 font-semibold">{{ patientsInSalleAttente }} Person</span>
                     Ce moment
                  </p>
                </div>
              </div>
            </div>
            <div class="flex-auto p-6 px-0 pb-2">
              <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th
                        class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70"
                      >
                        Nom
                      </th>
                      <th
                        class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70"
                      >
                        Prenom
                      </th>
                      <th
                        class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70"
                      >
                        Heure Arriver
                      </th>
                      <th
                        class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70"
                      >
                        Heure de Controle
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="salle in salle_attente" :key="salle.id" >
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                        <div class="flex px-2 py-1">
                          <div>
                            <img
                              src="../assets/img/salle_attent.png"
                              class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                              alt="xd"
                            />
                          </div>
                          <div class="flex flex-col justify-center">
                            <h6 class="font-semibold mb-0 leading-normal text-sm">{{ salle.nom }} </h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                          <h6 class="font-semibold leading-tight text-sm">{{ salle.prenom }}</h6>
                      </td>
                      <td
                        class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                      >
                        <span class="font-semibold leading-tight text-lg">  {{ salle.heure_arrivee }}</span>
                      </td>
                      <td
                          class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                      >
                        <span class="font-semibold leading-tight text-lg">{{ salle.heure_controle }}</span>
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
import axios from 'axios';
import Layout from '../components/Layout-aside.vue';

export default {
  components: {
    Layout
  },
  data() {
    return {
      totalAmount: null,
      patientsInWaitingRoom: null,
      averagePaymentAmount: null,
      totalPatients: null,
      patientsInSalleAttente: null,
      salle_attente: [],
    };
  },
  mounted() {
    this.fetchStatistics();
  },
  created() {
    this.fetchSalle_attente();
  },
  methods: {
    async fetchStatistics() {
      try {
        const response = await axios.get('https://api.majrinadiapsychiatre.com/api/statistics');
        this.totalAmount = response.data.totalAmount;
        this.patientsInWaitingRoom = response.data.patientsInWaitingRoom;
        this.averagePaymentAmount = response.data.averagePaymentAmount;
        this.totalPatients = response.data.totalPatients;
        this.patientsInSalleAttente = response.data.patientsInSalleAttente;
      } catch (error) {
        console.error('Error fetching statistics:', error);
      }
    },
    fetchSalle_attente() {
      let url = 'https://api.majrinadiapsychiatre.com/api/all/salle-attente';
      if (this.searchQuery) {
        url += `?cin=${this.searchQuery}`;
      }
      axios.get(url)
          .then(response => {
            this.salle_attente = response.data.salle_attente;
            console.log('Fetching  Salle Attente successfully', this.salle_attente);
          })
          .catch(error => {
            console.error('Error fetching salle attente:', error);
          });
    },
  }
};
</script>
<style scoped></style>
