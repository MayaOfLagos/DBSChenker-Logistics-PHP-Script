import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router/portal.js'
import PortalApp from './PortalApp.vue'
import axios from 'axios'
import '@steveyuowo/vue-hot-toast/vue-hot-toast.css'

const token = document.head.querySelector('meta[name="csrf-token"]')
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
}
axios.defaults.withCredentials = true

const app = createApp(PortalApp)
app.use(createPinia())
app.use(router)
app.mount('#portal-app')
