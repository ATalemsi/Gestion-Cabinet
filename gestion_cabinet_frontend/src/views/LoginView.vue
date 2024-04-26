<script setup></script>

<template>
  <main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section>
      <div
        class="relative flex items-center p-0 overflow-hidden bg-center bg-cover min-h-75-screen"
      >
        <div class="container z-10">
          <div class="flex flex-wrap mt-0 -mx-3">
            <div
              class="flex flex-col w-full max-w-full px-3 mx-auto md:flex-0 shrink-0 md:w-6/12 lg:w-5/12 xl:w-4/12"
            >
              <div
                class="relative flex flex-col min-w-0 mt-32 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
              >
                <div class="p-6 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
                  <h3
                    class="relative z-10 font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text"
                  >
                    Bienvenue dans votre Cabinet
                  </h3>
                  <p class="mb-0">Enter ton email est Mot de pass to Loging</p>
                </div>
                <div class="flex-auto p-6">
                  <form  @submit.prevent="loginAction"
                         role="form">
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                    <div class="mb-4">
                      <input
                        v-model="email"
                        type="email"
                        id="email"
                        name="email"
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                        placeholder="Email"

                        aria-label="Email"
                        aria-describedby="email-addon"
                      />
                      <p v-if="validationErrors.email" class="text-red-500 text-sm">
                        {{ validationErrors.email[0] }}
                      </p>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Mot de pass</label>
                    <div class="mb-4">
                      <input
                        v-model="password"
                        type="password"
                        id="password"
                        name="password"
                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                        placeholder="Password"
                        aria-label="Password"
                        aria-describedby="password-addon"
                      />
                      <p v-if="validationErrors.password" class="text-red-500 text-sm">
                        {{ validationErrors.password[0] }}
                      </p>
                    </div>
                    <div class="text-center">
                      <button
                          :disabled="isSubmitting"
                          type="submit"
                        class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85"
                      >
                        Connexion
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="w-full max-w-full px-3 lg:flex-0 shrink-0 md:w-6/12">
              <div
                class="absolute top-0 hidden w-3/5 h-full -mr-32 overflow-hidden -skew-x-10 -right-40 rounded-bl-xl md:block"
              >
                <div
                  class="absolute inset-x-0 top-0 z-0 h-full -ml-16 bg-cover skew-x-10"
                  style="background-image: url('./src/assets/img/curved-images/curved6.jpg')"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="py-12">
    <div class="container">
      <div class="flex flex-wrap -mx-3">
        <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
          <a href="#" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
            Service
          </a>
          <a href="#" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
            About Us
          </a>
          <a href="#" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Team </a>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
import axios from 'axios';

export default {
  name: 'LoginPage',
  data() {
    return {
      email: '',
      password: '',
      validationErrors: {},
      isSubmitting: false
    };
  },
  created() {
    if (localStorage.getItem('token') !== '' && localStorage.getItem('token') !== null) {
      if (localStorage.getItem('role') === 'admin') {
        this.$router.push('/dashboard');
      } else if (localStorage.getItem('role') === 'secretary') {
        this.$router.push('/salle-attend');
      }
    }
  },
  methods: {
    loginAction() {
      this.isSubmitting = true;
      const payload = {
        email: this.email,
        password: this.password
      };
      axios
          .post('http://localhost:8000/api/login', payload)
          .then((response) => {
            localStorage.setItem('token', response.data.token);
            localStorage.setItem('role', response.data.role);

            // Check user role and redirect accordingly
            if (response.data.role === 'admin') {
              this.$router.push('/dashboard');
            } else if (response.data.role === 'secretary') {
              this.$router.push('/salle-attend');
            }
          })
          .catch((error) => {
            this.isSubmitting = false;
            if (error.response.data.errors !== undefined) {
              this.validationErrors = error.response.data.errors;
            }
            if (error.response.data.error !== undefined) {
              this.validationErrors = error.response.data.error;
            }
          });
    }
  }
};

</script>
<style scoped></style>
