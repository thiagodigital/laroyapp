export default [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/HomeView.vue'),
    meta: {
      requiresAuth: true,
      layout: 'AuthLayout',
    },
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/AboutView.vue'),
    meta: {
      requiresAuth: true,
      layout: 'AuthLayout',
    },
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/LoginPage.vue'),
    meta: {
      requiresGuest: true, // Só pode acessar se NÃO estiver logado
      layout: 'GuestLayout', // Usa o layout de visitante
    },
  },
];
