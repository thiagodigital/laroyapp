<script setup lang="ts">
import { computed, defineAsyncComponent, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useGlobalStore } from '@/services/stores/globalStore'
import GlobalPreloader from '@/components/GlobalPreloader.vue'

// Importa os layouts dinamicamente (melhor para performance)
const AuthLayout = defineAsyncComponent(() => import('@/layouts/AuthLayout.vue'))
const GuestLayout = defineAsyncComponent(() => import('@/layouts/GuestLayout.vue'))

const layouts = {
  AuthLayout,
  GuestLayout,
}

const route = useRoute()
const globalStore = useGlobalStore()

// Computa qual layout deve ser usado baseado no router.meta
const layoutComponent = computed(() => {
  const layoutName = route.meta.layout || 'GuestLayout' // Default
  return layouts[layoutName]
})
</script>
<template>
  <div>
    <GlobalPreloader v-if="globalStore.isLoading" />

    <component :is="layoutComponent">
      <router-view />
    </component>
  </div>
</template>

