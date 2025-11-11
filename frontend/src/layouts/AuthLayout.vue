<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/services/stores/authStore'

const router = useRouter()
const authStore = useAuthStore()

const handleLogout = async () => {
  await authStore.logout()
  router.push({ name: 'login' })
}
</script>
<template>
  <div class="auth-layout">
    <header class="navbar">
      <span>LaroyApp - Intranet</span>
      <nav>
        <router-link :to="{ name: 'home' }">Feed</router-link>
        <router-link :to="{ name: 'about' }">Perfil</router-link>
        <button @click="handleLogout">Sair</button>
      </nav>
    </header>

    <main class="content">
      <slot></slot>
    </main>

    <footer class="footer">
      </footer>
  </div>
</template>
