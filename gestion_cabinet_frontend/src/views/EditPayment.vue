<template>
  <Layout>
    <div class="w-full px-6 py-6 mx-auto">
      <form v-if="oldPaymentLoaded" @submit.prevent="updatePayment">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-6 md:col-span-3">
            <label for="amount" class="block text-sm font-medium leading-6 text-gray-900"
              >Le montant</label
            >
            <div class="mt-2">
              <input
                v-model="oldPayment.amount"
                type="number"
                name="amount"
                id="amount"
                class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
              <span v-if="errors.amount" class="text-red-500 text-xs">{{ errors.amount[0] }}</span>
            </div>
          </div>
          <div class="sm:col-span-6 md:col-span-3">
            <label for="payment_status" class="block text-sm font-medium leading-6 text-gray-900"
              >Status de Payment</label
            >
            <div class="mt-2">
              <select
                v-model="oldPayment.payment_status"
                name="payment_status"
                id="payment_status"
                class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              >
                <option value="" disabled selected>Select le status</option>
                <option value="pending">Attend</option>
                <option value="paid">Fini</option>
              </select>
              <span v-if="errors.payment_status" class="text-red-500 text-xs">{{
                errors.payment_status[0]
              }}</span>
            </div>
          </div>
        </div>
        <button
          type="submit"
          class="my-4 bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded"
        >
          Modifier
        </button>
      </form>
    </div>
  </Layout>
</template>

<script>
import Layout from '../components/Layout-aside.vue'
import axios from 'axios'

export default {
  name: 'EditPayment',
  components: {
    Layout
  },
  data() {
    return {
      oldPaymentLoaded: false,
      oldPayment: {
        amount: 0,
        payment_status: '',
        rendez_vouses_id: ''
      },
      errors: {},
      rendezVousList: []
    }
  },
  computed: {
    selectedPatient() {
      return (
        this.rendezVousList.find((rendez) => rendez.id === this.oldPayment.rendez_vouses_id) || null
      )
    }
  },
  mounted() {
    this.loadPayment()
    console.log(this.$route.params.id)
  },
  created() {
    this.fetchRendezVousData()
  },
  methods: {
    loadPayment() {
      const paymentId = this.$route.params.id
      axios
        .get(`https://api.majrinadiapsychiatre.com/api/edit/payment/${paymentId}`)
        .then((response) => {
          this.oldPayment = response.data.payment
          console.log('Success fetching old Payment information:', this.oldPayment)
          this.oldPaymentLoaded = true
        })
        .catch((error) => {
          console.error('Error fetching old Payment information:', error.response.data)
        })
    },
    fetchRendezVousData() {
      axios
        .get('https://api.majrinadiapsychiatre.com/api/all/rendez-vous')
        .then((response) => {
          this.rendezVousList = response.data.rendez_vous
        })
        .catch((error) => {
          console.error('Error fetching rendez-vous data:', error)
        })
    },
    updateSalle() {
      const formData = new FormData()
      formData.append('_method', 'PUT')
      formData.append('heure_arrivee', this.oldSalleAttente.heure_arrivee)
      formData.append('heure_controle', this.oldSalleAttente.heure_controle)

      axios
        .post(`https://api.majrinadiapsychiatre.com/api/update/salle-attente/${this.$route.params.id}`, formData)
        .then((response) => {
          console.log('Salle attente updated successfully', response.data.waiting_room_entry)
          alert('Salle attente updated successfully')
          this.$router.push('/salle-attend')
          if (response && response.data) {
            console.log('Additional data from server:', response.data)
          }
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.error
            console.log('Validation Error', error.response.data.error)
          } else {
            console.error('Error updating salle attente:', error.response.data.errors)
          }
        })
    }
  }
}
</script>

<style scoped>
/* Add styling for the borders */
input,
select {
  border: 1px solid #e5e7eb;
  border-radius: 0.375rem;
}
</style>
