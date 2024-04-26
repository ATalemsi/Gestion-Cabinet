import axios from 'axios'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'

axios.defaults.baseURL = 'http://localhost:8000'
axios.interceptors.request.use(
    function (config) {
        const token = localStorage.getItem('token')
        const role = localStorage.getItem('role')

        if (token && isToken()) {
            config.headers.Authorization = `Bearer ${token}`
        }
        if (role) {
            config.headers['Role'] = role
        }
        return config
    },
    function (error) {
        return Promise.reject(error)
    }
)

function isToken() {
    const token = localStorage.getItem('token')
    return !!token
}
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token');
    const userRole = localStorage.getItem('role');

    if (to.meta.requiresAuth) {
        if (!isAuthenticated) {

            next('/');
        } else {

            if (to.meta.roles.includes(userRole)) {
                next();
            } else {

                next('salle-attend');
            }
        }
    } else {
        
        next();
    }
});


const app = createApp(App)

app.mixin({
    methods: {
        isAuth() {
            return isToken();
        }
    }
})
app.use(createPinia())
app.use(router)

app.mount('#app')
