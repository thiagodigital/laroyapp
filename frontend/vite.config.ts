import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
// import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    // vueDevTools(),
  ],
  server: {
    // Isto faz o Vite escutar em 0.0.0.0
    // Essencial para ser acessível de fora do container Docker
    host: true,

    // Isto diz ao Vite que 'app.laroyapp.test' é um host permitido
    allowedHosts: [
      'app.laroyapp.test'
    ]
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url)),
      '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
    },
  },
})
