<template>
  <Layout>

    <div class="w-full px-6 py-6 mx-auto">
      <form @submit.prevent="addSecretary">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Ajouter Patient</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Entrer toutes les informations sur votre nouveau patient</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <!-- Input fields for nom, prenom, email, and password -->
              <div class="sm:col-span-6 md:col-span-3">
                <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                <div class="mt-2">
                  <input v-model="formData.nom" type="text" name="nom" id="nom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.nom" class="text-red-500 text-xs">{{ errors.nom[0] }}</span>
                </div>
              </div>
              <div class="sm:col-span-6 md:col-span-3">
                <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
                <div class="mt-2">
                  <input v-model="formData.prenom" type="text" name="prenom" id="prenom" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.prenom" class="text-red-500 text-xs">{{ errors.prenom[0] }}</span>
                </div>
              </div>
              <div class="sm:col-span-6 md:col-span-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                  <input v-model="formData.email" placeholder="exemple@gmail.com" type="email" name="email" id="email" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ">
                  <span v-if="errors.email" class="text-red-500 text-xs">{{ errors.email[0] }}</span>
                </div>
               </div>
                <div class="sm:col-span-6 md:col-span-3">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                  <input v-model="formData.password" type="password" name="password" id="password" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <span v-if="errors.password" class="text-red-500 text-xs">{{ errors.password[0] }}</span>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Ajouter Secretaire
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
  components: {
    Layout
  },
  data() {
    return {
      formData: {
        nom: '',
        prenom: '',
        email: '',
        password: ''
      },
      errors: {}
    };
  },
  methods: {
    addSecretary() {
      axios
          .post('https://api.majrinadiapsychiatre.com/api/add/secretary', this.formData)
          .then((response) => {
            this.$router.push('/secretary');
            if (response && response.data) {
              console.log('Additional data from server:', response.data);
            }
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.error;
              console.log('Validation Error',error.response.data.error)
            } else {
              console.error('Error creating rendezvous:', error.response.data.error);
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
