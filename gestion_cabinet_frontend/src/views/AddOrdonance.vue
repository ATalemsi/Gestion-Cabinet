<template>
    <Layout>
      <div class="w-full px-6 py-6 mx-auto">
        <form @submit.prevent="submitForm">
          <div class="space-y-12">
            <!-- Input fields for patient and ordonnance details -->
            <div class="border-b border-gray-900/10 pb-12">
              <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <!-- Select input for patient -->
                <div class="sm:col-span-6 md:col-span-3">
                  <label for="patient_id" class="block text-sm font-medium leading-6 text-gray-900">Patient</label>
                  <div class="mt-2">
                    <select v-model="patient_id" name="patient_id" id="patient_id" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      <option value="" disabled selected>Select Patient</option>
                      <option v-for="patient in patientList" :key="patient.id" :value="patient.id">{{ patient.nom }} / {{ patient.prenom }} / {{ patient.cin }}</option>
                    </select>
                    <span v-if="errors.patient_id" class="text-red-500 text-xs">{{ errors.patient_id[0] }}</span>
                  </div>
                </div>
                
                <!-- Inputs for medication details -->
                <div class="sm:col-span-6">
                  <label for="medications" class="block text-sm font-medium leading-6 text-gray-900">Medications</label>
                  <div class="mt-2">
                    <div v-for="(medication, index) in medications" :key="index" class="mb-4">
                      <div class="flex space-x-4">
                        <!-- Input for medication name -->
                        <input v-model="medication.name" type="text" id="medication_name" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Medication Name">
                        <!-- Input for dosage -->
                        <input v-model="medication.dosage" type="text" id="dosage" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Dosage">
                        <!-- Input for description -->
                        <input v-model="medication.description" type="text" id="description" class="block w-full border-0 bg-transparent py-2 pl-1 text-gray-900 placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 focus:ring-0 sm:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="instructions">
                        <button type="button" @click="removeMedication(index)" class="text-red-500">Remove</button>
                      </div>
                      <span v-if="errors['medications.' + index + '.name']" class="text-red-500 text-xs">{{ errors['medications.' + index + '.name'][0] }}</span>
                      <span v-if="errors['medications.' + index + '.dosage']" class="text-red-500 text-xs">{{ errors['medications.' + index + '.dosage'][0] }}</span>
                      <span v-if="errors['medications.' + index + '.description']" class="text-red-500 text-xs">{{ errors['medications.' + index + '.description'][0] }}</span>
                    </div>
                    <button type="button" @click="addMedication" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
                      Add Medication
                    </button>
                  </div>
                </div>
  
                <!-- Input for instructions -->
                <div class="col-span-full">
                  <label for="instructions" class="block text-sm font-medium leading-6 text-gray-900">Instructions</label>
                  <div class="mt-2">
                    <textarea id="instructions" v-model="instructions" name="instructions" rows="3" class="block w-full rounded-md border-0 py-2 pl-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Instructions"></textarea>
                    <p v-if="errors.instructions" class="text-red-500 text-sm">{{ errors.instructions[0] }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 hover:bg-gradient-to-tl hover:from-pink-500 hover:to-purple-700 text-white font-bold py-2 px-4 rounded">
            Ajouter
          </button>
        </form>
      </div>
    </Layout>
  </template>
  
  <script>
  import Layout from '../components/Layout-aside.vue';
  import axios from 'axios';
  
  export default {
    name: 'AddOrdonnance',
    components: {
      Layout
    },
    data() {
      return {
        patient_id: '',
        medications: [{ name: '', dosage: '' ,description: ''}], // Array to hold medications
        instructions: '',
        errors: {},
        patientList: []
      };
    },
    created() {
      this.fetchPatientData();
    },
    methods: {
      fetchPatientData() {
        axios.get('https://api.majrinadiapsychiatre.com/api/index/patient')
          .then(response => {
            this.patientList = response.data.clients;
          })
          .catch(error => {
            console.error('Error fetching patient data:', error);
          });
      },
      addMedication() {
        this.medications.push({ name: '', dosage: '' });
      },
      removeMedication(index) {
        this.medications.splice(index, 1);
      },
      submitForm() {
        // Map form data to the format expected by the backend
        const formData = {
          client_id: this.patient_id,
          medications: this.medications,
          description: this.instructions
        };
  
        axios.post('https://api.majrinadiapsychiatre.com/api/ordonances', formData)
          .then(response => {
            console.log('Ordonance created successfully', response.data);
            this.$router.push('/ordonance');
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors; // Update to handle validation errors
            } else {
              console.error('Error creating ordonnance:', error);
            }
          });
      }
    }
  };
  </script>
  
  <style scoped>
  input,
  select {
    border: 1px solid #E5E7EB;
    border-radius: 0.375rem;
  }
  </style>
  