<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">

      <form @submit.prevent="addPatient">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Ajouter Patient</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Entrer toute les information sur votre nouveaux patient</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

              <div class="sm:col-span-6 md:col-span-3">
                <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                <div class="mt-2">
                  <input type="text" v-model="formData.nom" name="nom" id="nom" class="block w-1/2 border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <p v-if="validationErrors && validationErrors.nom" class="text-red-500 text-sm">
                  {{ validationErrors.nom[0] }}
                </p>
              </div>

              <div class="sm:col-span-6 md:col-span-3">
                <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
                <div class="mt-2">
                  <input type="text" v-model="formData.prenom" name="prenom" id="prenom" class="block w-1/2 border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <p v-if="validationErrors && validationErrors.prenom" class="text-red-500 text-sm">
                  {{ validationErrors.prenom[0] }}
                </p>
              </div>

              <div class="sm:col-span-6 md:col-span-3">
                <label for="cin" class="block text-sm font-medium leading-6 text-gray-900">CIN</label>
                <div class="mt-2">
                  <input type="text" v-model="formData.cin" name="cin" id="cin" class="block w-1/2 border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <p v-if=" validationErrors && validationErrors.cin" class="text-red-500 text-sm">
                  {{ validationErrors.cin[0] }}
                </p>
              </div>

              <div class="sm:col-span-6 md:col-span-3">
                <label for="telephone" class="block text-sm font-medium leading-6 text-gray-900">Téléphone</label>
                <div class="mt-2">
                  <input type="text" v-model="formData.telephone" name="telephone" id="telephone" class="block w-1/2 border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:leading-6">
                </div>
                <p v-if="validationErrors && validationErrors.telephone" class="text-red-500 text-sm">
                  {{ validationErrors.telephone[0] }}
                </p>
              </div>
              <div class="col-span-full ">
                <label for="antecedents" class="block text-sm font-medium leading-6 text-gray-900">Antécédents</label>
                <div class="mt-2">
                  <textarea id="antecedents"  v-model="formData.antecedents" name="antecedents" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
              </div>
              <p v-if="validationErrors && validationErrors.antecedents" class="text-red-500 text-sm">
                {{ validationErrors.antecedents[0] }}
              </p>
              <div class="col-span-full ">
                <label for="donnees_biographiques" class="block text-sm font-medium leading-6 text-gray-900">Données biographiques</label>
                <div class="mt-2">
                  <textarea id="donnees_biographiques"  v-model="formData.donnees_biographiques" name="donnees_biographiques" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.donnees_biographiques" class="text-red-500 text-sm">
                  {{ validationErrors.donnees_biographiques[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="histoire_maladie" class="block text-sm font-medium leading-6 text-gray-900">Histoire de la maladie</label>
                <div class="mt-2">
                  <textarea id="histoire_maladie"  v-model="formData.histoire_maladie" name="histoire_maladie" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.histoire_maladie" class="text-red-500 text-sm">
                  {{ validationErrors.histoire_maladie[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="entretiens" class="block text-sm font-medium leading-6 text-gray-900">Entretiens</label>
                <div class="mt-2">
                  <textarea id="entretiens"  v-model="formData.entretiens" name="entretiens" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.entretiens" class="text-red-500 text-sm">
                  {{ validationErrors.entretiens[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="diagnostic" class="block text-sm font-medium leading-6 text-gray-900">Diagnostic</label>
                <div class="mt-2">
                  <textarea id="diagnostic"  v-model="formData.diagnostic" name="diagnostic" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.diagnostic" class="text-red-500 text-sm">
                  {{ validationErrors.diagnostic[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="traitement" class="block text-sm font-medium leading-6 text-gray-900">Traitement</label>
                <div class="mt-2">
                  <textarea id="traitement"  v-model="formData.traitement" name="traitement" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if=" validationErrors && validationErrors.traitement" class="text-red-500 text-sm">
                  {{ validationErrors.traitement[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="evolution" class="block text-sm font-medium leading-6 text-gray-900">Évolution</label>
                <div class="mt-2">
                  <textarea id="evolution"  v-model="formData.evolution" name="evolution" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.evolution" class="text-red-500 text-sm">
                  {{ validationErrors.evolution[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="imagerie" class="block text-sm font-medium leading-6 text-gray-900">Imagerie</label>
                <div class="mt-2">
                  <textarea id="imagerie"  v-model="formData.imagerie" name="imagerie" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.imagerie" class="text-red-500 text-sm">
                  {{ validationErrors.imagerie[0] }}
                </p>
              </div>

              <div class="col-span-full ">
                <label for="bilan" class="block text-sm font-medium leading-6 text-gray-900">Bilan</label>
                <div class="mt-2">
                  <textarea id="bilan"  v-model="formData.bilan" name="bilan" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <p v-if="validationErrors && validationErrors.bilan" class="text-red-500 text-sm">
                  {{ validationErrors.bilan[0] }}
                </p>
              </div>

            </div>
          </div>
          <button class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Ajouter Patient
          </button>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script>
import 'vue-toast-notification/dist/theme-sugar.css';
import axios from 'axios';
import Layout from '../components/Layout-aside.vue';

export default {
  components: {
    Layout
  },
  data() {
    return {
      validationErrors: {},
      formData: {
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
      isSidebarOpen: false,
    };
  },
  methods: {
    addPatient() {
      this.isSubmitting = true;
      const payload = new FormData();
      payload.append('nom', this.formData.nom);
      payload.append('prenom', this.formData.prenom);
      payload.append('cin', this.formData.cin);
      payload.append('telephone', this.formData.telephone);
      payload.append('antecedents', this.formData.antecedents);
      payload.append('donnees_biographiques', this.formData.donnees_biographiques);
      payload.append('histoire_maladie', this.formData.histoire_maladie);
      payload.append('entretiens', this.formData.entretiens);
      payload.append('diagnostic', this.formData.diagnostic);
      payload.append('traitement', this.formData.traitement);
      payload.append('evolution', this.formData.evolution);
      payload.append('imagerie', this.formData.imagerie);
      payload.append('bilan', this.formData.bilan);

      this.createPatient(payload);
    },
    createPatient(payload) {
      axios
          .post('https://api.majrinadiapsychiatre.com/api/create/patient', payload)
          .then((response) => {

            this.$router.push('/clients');
            if (response && response.data) {
              console.log('Additional data from server:', response.data);
            }
          })
          .catch((error) => {

            console.log(error)
            this.isSubmitting = false;
            if (error.response.data.errors !== undefined) {
              this.validationErrors = error.response.data.errors;
              console.log('Validation error:', this.validationErrors);
            }
            if (error.response.data.error !== undefined) {
              this.validationErrors = error.response.data.error;
              console.log('Validation error 2:', this.validationErrors);
            }
          });
    },
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    }
  }
};
</script>

<style scoped>
/* Add styling for the borders */
input,
textarea {
  border: 1px solid #E5E7EB;
  border-radius: 0.375rem;
}
</style>
