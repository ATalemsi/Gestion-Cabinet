<template>
  <Layout>
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="leading-normal text-sm">
              <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">
              Dossier
            </li>
          </ol>
          <h6 class="mb-0 font-bold capitalize">Dossier Patient</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <li class="flex items-center pl-4 xl:hidden">
                <a href="javascript:" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500" sidenav-trigger>
                  <div class="w-4.5 overflow-hidden">
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="w-full px-6 py-6 mx-auto">
      <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%">
        <span class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
      </div>
      <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-auto max-w-full px-3">
            <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
              <img src="../assets/img/patients.jpg" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
            </div>
          </div>
          <div class="flex-none w-auto max-w-full px-3 my-auto">
            <div class="h-full">
              <h5 class="mb-1">{{ clientInfo.nom }} / {{ clientInfo.prenom }}</h5>
              <p class="mb-0 font-semibold leading-normal text-sm">CIN : {{ clientInfo.cin }} </p>
              <p class="mb-0 font-semibold leading-normal text-sm">Telephone : {{ clientInfo.telephone }} </p>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full p-6 mx-auto">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
          <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
              <div class="flex flex-wrap -mx-3">
                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                  <h6 class="mb-0 font-bold text-slate-700 text-lg">Infomrations médicale </h6>
                </div>
              </div>
            </div>
            <div class="flex-auto p-4">
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Antecedents :</strong> &nbsp;  {{ clientInfo.antecedents }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Donnée Biographique :</strong> &nbsp;  {{ clientInfo.donnees_biographiques }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Histoire Maladie:</strong> &nbsp;  {{ clientInfo.histoire_maladie }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Entretiens :</strong> &nbsp; {{ clientInfo.entretiens }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Diagnostique :</strong> &nbsp;  {{ clientInfo.diagnostic }}</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
          <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
              <div class="flex flex-wrap -mx-3">
                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                  <h6 class="mb-0 font-bold text-slate-700 text-lg">Infomrations médicale </h6>
                </div>
              </div>
            </div>
            <div class="flex-auto p-4">
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Traitement :</strong>  &nbsp;  {{ clientInfo.traitement }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Evolution : </strong>  &nbsp; {{ clientInfo.evolution }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">imagerie :</strong> &nbsp; {{ clientInfo.imagerie }}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Bilan :</strong> &nbsp;  {{ clientInfo.bilan }}</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
          <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
              <h6 class="mb-0">Document de Maladie</h6>
            </div>
            <div class="flex-auto p-4">
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 rounded-t-lg text-inherit">
                  <div class="inline-flex items-center justify-center w-12 h-12 mr-4 text-white transition-all duration-200 text-base ease-soft-in-out rounded-xl">
                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="w-full shadow-soft-2xl rounded-xl" />
                  </div>
                  <div class="flex flex-col items-start justify-center">
                    <h6 class="mb-0 leading-normal text-sm">Sophie B.</h6>
                    <p class="mb-0 leading-tight text-xs">Hi! I need more information..</p>
                  </div>
                  <a class="inline-block py-3 pl-0 pr-4 mb-0 ml-auto font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in hover:scale-102 hover:active:scale-102 active:opacity-85 text-fuchsia-500 hover:text-fuchsia-800 hover:shadow-none active:scale-100" href="javascript:;">Reply</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>
import 'vue-toast-notification/dist/theme-sugar.css';
import axios from 'axios';
import Layout from '../components/Layout-aside.vue';

export default {
  name: 'EditPatient',
  components: {
    Layout
  },
  data() {
    return {
      clientInfo: {
        nom: '',
        prenom: '',
        cin: '',
        telephone: '',
        antecedents: '',
        donnees_biographiques: '',
        histoire_maladie: '',
        entretiens: '',
        diagnostic: '',
        traitement: '',
        evolution: '',
        imagerie: '',
        bilan: ''
      }
    };
  },
  mounted() {
    this.loadClientinfo()
    console.log(this.$route.params.id)
  },
  methods: {
    loadClientinfo() {
      const ClientId = this.$route.params.id
      axios
          .get(`http://localhost:8000/api/client/info/${ClientId}`)
          .then((response) => {
            this.clientInfo = response.data.client
            console.log()

          })
          .catch((error) => {
            console.error('Error fetching old Patient information:', error)
          })
    },
  }
};
</script>
<style scoped>

</style>