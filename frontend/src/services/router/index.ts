import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes'
import { useAuthStore } from '../stores/authStore'
import { useGlobalStore } from '../stores/globalStore'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

// Navigation Guard (O "Porteiro" das rotas)
router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()
  const globalStore = useGlobalStore()

  globalStore.setLoading(true)

  // 1. Checa a autenticação no primeiro load
  if (!authStore.isAuthChecked) {
    await authStore.fetchUser()
  }

  const isAuthenticated = authStore.isAuthenticated

  // 2. Regra: Rota exige autenticação, mas usuário não está logado
  if (to.meta.requiresAuth && !isAuthenticated) {
    return next({ name: 'login', query: { redirect: to.fullPath } })
  }

  // 3. Regra: Rota é para visitantes, mas usuário está logado
  if (to.meta.requiresGuest && isAuthenticated) {
    return next({ name: 'home' })
  }

  // 4. Se nenhuma regra bateu, permite o acesso
  next()
})

router.afterEach(() => {
  const globalStore = useGlobalStore()
  globalStore.setLoading(false) // DESLIGA o preloader
})

export default router
