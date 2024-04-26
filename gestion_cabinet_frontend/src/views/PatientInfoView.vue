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
              <div v-if="patientDocuments.length === 0">
                <p>No documents available for this patient.</p>
              </div>
              <div v-else>
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li  v-for="(doc, index) in patientDocuments" :key="index" class="relative flex items-center px-0 py-2 mb-2 bg-white border-0 rounded-t-lg text-inherit">
                  <div class="inline-flex items-center justify-center w-12 h-12 mr-4  transition-all duration-200  ease-soft-in-out rounded-xl ">
                    <i class=" text-4xl  fas fa-file-pdf"></i>
                  </div>

                  <a :href="getImageUrl(doc.document)" target="_blank" class="flex flex-col items-start justify-center flex-1">
                    <h6 class="mb-0 leading-normal text-sm">{{ doc.nom_document }}</h6>
                  </a>

                  <button @click="softDeleteDocuments(doc.id)" class="inline-block px-3 py-1 text-xs leading-6 text-white uppercase transition bg-red-500 rounded shadow hover:bg-red-600 focus:outline-none">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </li>
              </ul>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="max-w-full mx-auto mt-6 px-6 py-4 bg-white rounded-2xl shadow-soft-xl">
        <h2 class="text-xl font-bold mb-4">Upload Document</h2>
        <form enctype="multipart/form-data" @submit.prevent="submitForm" class="flex flex-col space-y-4">
          <div>
            <label for="nom_document" class="block text-sm font-medium text-gray-700">Document Name</label>
            <input type="text" v-model="formData.nom_document" id="nom_document" name="nom_document" class="block w-1/2 border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <span v-if="errors.nom_document" class="text-red-500 text-xs">{{ errors.nom_document[0] }}</span>
          </div>
          <div>
            <label for="document" class="block text-sm font-medium text-gray-700">Document File</label>
            <input @change="handleFileChange" type="file" id="document" name="document" class="p-6 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <span v-if="errors.document" class="text-red-500 text-xs">{{ errors.document[0] }}</span>
          </div>
          <button type="submit" class="inline-block px-6 py-2 text-xs font-semibold leading-6 text-center text-white uppercase transition bg-fuchsia-500 rounded shadow ripple hover:shadow-lg hover:bg-fuchsia-600 focus:outline-none">Upload</button>
        </form>
      </div>
    </div>
  </Layout>
</template>
<script>
import 'vue-toast-notification/dist/theme-sugar.css';
import axios from 'axios';
import Layout from '../components/Layout-aside.vue';

export default {
  name: 'ProfileInfoView',
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
      },
      formData: {
        nom_document: '',
        document: null,
      },
      errors: {},

      patientDocuments: []
    };
  },
  mounted() {
    this.loadClientinfo();
    this.loadPatientDocuments();
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
    submitForm() {
      const formData = new FormData();
      formData.append('nom_document', this.formData.nom_document);
      formData.append('document', this.formData.document);

      axios.post(`http://localhost:8000/api/upload/document/${this.$route.params.id}`, formData)
          .then((response) => {
            if (response && response.data) {
              console.log('Additional data from server:', response.data);
              this.loadPatientDocuments();
              this.formData.nom_document = '';
              this.errors= '';

              document.getElementById('document').value = null;

            }
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.error;
              console.log('Validation Error', this.errors);
            } else {
              console.error('Error creating rendezvous:', error.response.data.error);
            }
          });
    },
    loadPatientDocuments() {

      axios.get(`http://localhost:8000/api/patient/documents/${this.$route.params.id}`)
          .then(response => {
            this.patientDocuments = response.data.documents;
            console.log('les document de patinet :', this.patientDocuments)
          })
          .catch(error => {
            console.error('Error fetching patient documents:', error);
          });
    },
    handleFileChange(event) {
      this.formData.document = event.target.files[0]
    },
    getImageUrl(PdfFileName) {
      return `http://localhost:8000/storage/${PdfFileName}`
    },
    softDeleteDocuments(documentId) {
      axios.delete(`http://localhost:8000/api/delete/document/${documentId}`)
          .then(response => {
            console.log('Report soft deleted successfully', response.data.message);
            this.loadPatientDocuments();
          })
          .catch(error => {
            console.error('Report error deleting', error);
          });
    },
  }
};
</script>
<style scoped>

</style>