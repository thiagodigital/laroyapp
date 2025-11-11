import './assets/base.scss'
import App from './App.vue'
import router from './services/router'
import service from './services/http'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'

async function startApp() {
    try {
        const token = await service.get('/sanctum/csrf-cookie');
    } catch (error) {
        console.error('Falha ao obter o cookie CSRF', error);
    } finally {
        UIkit.use(Icons)
        const app = createApp(App)
        app.use(createPinia())
        app.use(router)
        app.mount('#app')

    }
}

startApp();

