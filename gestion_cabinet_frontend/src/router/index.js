import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [

    {
      path: '/',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/DashboardView.vue')
    },
    {
      path: '/clients',
      name: 'clients',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/ClientTable.vue')
    },
    {
      path: '/salle-attend',
      name: 'salle-attends',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/Salle_Attend.vue')
    },
    {
      path: '/rendez-vous',
      name: 'rendez-vous',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/Rendez-vousView.vue')
    },
    {
      path: '/secretary',
      name: 'secretary',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/SecretaireView.vue')
    },
    {
      path: '/create-secretary',
      name: 'create-secretary',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/AddSercretaire.vue')
    },
    {
      path: '/create-patient',
      name: 'create-patient',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/AddPatient.vue')
    },
    {
      path: '/create-rendezvous',
      name: 'create-rendezvous',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/AddRendez-vous.vue')
    },
    {
      path: '/create-salle',
      name: 'create-salle',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/AddSalleAttente.vue')
    },
    {
      path: '/payment-invoice',
      name: 'payment-invoice',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/PaymentView.vue')
    },
    {
      path: '/addpayment',
      name: 'AddPayment',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/AddPayment.vue')
    },
    {
      path: '/rapport',
      name: 'rapport',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/RapportView.vue')
    },
    {
      path: '/ordonance',
      name: 'ordonance',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/OrdonanceView.vue')
    },
    {
      path: '/add/rapport',
      name: 'Addrapport',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/AddRapport.vue')
    },
    {
      path: '/add/ordonnance',
      name: 'AddOrdonance',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/AddOrdonance.vue')
    },
    {
      path: '/patient-info/:id',
      name: 'patient-info',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/PatientInfoView.vue')
    },
    {
      path: '/edit/:id',
      name: 'EditClient',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/EditPatient.vue')
    },
    {
      path: '/edit/rendez-vous/:id',
      name: 'EditRendez-vous',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/EditRendez-vous.vue')
    },
    {
      path: '/edit/salle/:id',
      name: 'EditSalle-attente',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/EditSalle-Attente.vue')
    },
    {
      path: '/edit/payment/:id',
      name: 'EditPayment',
      meta: { requiresAuth: true, roles: ['admin','secretary'] },
      component: () => import('../views/EditPayment.vue')
    },
    {
      path: '/edit/secretary/:id',
      name: 'EditSecretary',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/EditSecretary.vue')
    },
    {
      path: '/edit/rapport/:id',
      name: 'EditRapport',
      meta: { requiresAuth: true, roles: ['admin'] },
      component: () => import('../views/EditRapport.vue')
    },
    {
      path: '/print/rapport/:id',
      name: 'PrintRapport',
       component: () => import('../views/PrintRapport.vue')
    },
    {
      path: '/print/ordonnance/:id',
      name: 'PrintOrdonance',
       component: () => import('../views/PrintOrdonance.vue')
    }
  ]
})

export default router
