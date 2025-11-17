import "./bootstrap";
import "@tailwindplus/elements";
import { createApp } from 'vue'
import { MotionPlugin } from '@vueuse/motion'

import router from './frontend/router'
import App from './frontend/App.vue'

const app = createApp(App)
app.use(router)
app.use(MotionPlugin)
app.mount('#vue-app')


