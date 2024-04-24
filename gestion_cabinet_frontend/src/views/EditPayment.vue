<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form  v-if="oldPaymentLoaded"
             @submit.prevent="updatePayment">

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-6 md:col-span-3">
            <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">amount</label>
            <div class="mt-2">
              <input v-model="oldPayment.amount" type="number" name="amount" id="amount" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <span v-if="errors.amount" class="text-red-500 text-xs">{{ errors.amount[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="payment_status" class="block text-sm font-medium leading-6 text-gray-900">Type Patient</label>
            <div class="mt-2">
              <select v-model="oldPayment.payment_status" name="payment_status" id="payment_status" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Select status</option>
                <option value="pending">pending</option>
                <option value="paid">paid</option>
              </select>
              <span v-if="errors.payment_status" class="text-red-500 text-xs">{{ errors.payment_status[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="rendez_vouses_id" class="block text-sm font-medium leading-6 text-gray-900">Patient</label>
            <div class="mt-2">
              <select v-model="oldPayment.rendez_vouses_id" name="rendez_vouses_id" id="rendez_vouses_id" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Select Patient</option>
                <option v-for="rendez in rendezVousList" :key="rendez.id" :value="rendez.id">{{ rendez.nom }} / {{ rendez.prenom }} / {{ rendez.cin }}</option>
              </select>
              <span v-if="errors.rendez_vouses_id" class="text-red-500 text-xs">{{ errors.rendez_vouses_id[0] }}</span>
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
  name: 'EditPayment',
  components: {
    Layout
  },
  data() {
    return {
      oldPaymentLoaded: false,
      oldPayment:{
        amount: 0,
        payment_staus: '',
        rendez_vouses_id: '',
      },
      errors: {},
      rendezVousList: [],
    };
  },
  mounted() {
    this.loadPayment()
    console.log(this.$route.params.id)
  },
  created() {
    this.fetchRendezVousData();
  },
  methods: {
    loadPayment() {
      const paymentId = this.$route.params.id
      axios
          .get(`http://localhost:8000/api/edit/payment/${paymentId}`)
          .then((response) => {
            this.oldPayment = response.data.payment
            console.log('Success fetching old Salle attente information:', this.oldPayment)
            this.oldPaymentLoaded = true
          })
          .catch((error) => {
            console.error('Error fetching old Salle attente information:', error.response.data)
          })
    },
    fetchRendezVousData() {
      axios.get('http://localhost:8000/api/all/rendez-vous')
          .then(response => {
            this.rendezVousList = response.data.rendez_vous;
          })
          .catch(error => {
            console.error('Error fetching payment data:', error);
          });
    },
    updatePayment() {

      const formData = new FormData();
      formData.append('_method','PUT');
      formData.append('amount', this.oldPayment.amount);
      formData.append('payment_status', this.oldPayment.payment_status);
      formData.append('rendez_vouses_id', this.oldPayment.rendez_vouses_id);

      axios.post(`http://localhost:8000/api/update/payment/${this.$route.params.id}`, formData)
          .then(response => {
            console.log('Salle attente memebre created successfully', response.data);
            alert('update  dans la salle attente ')
            this.$router.push('/payment-invoice');
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
