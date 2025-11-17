import "./bootstrap";
import "@tailwindplus/elements";
import { createApp } from 'vue'
import { MotionPlugin } from '@vueuse/motion'

import App from './frontend/App.vue'

const el = document.getElementById('mixed-app');
const initialState = JSON.parse(el.dataset.initial);
const app = createApp(App, {
    initialState: initialState
})
app.use(MotionPlugin)
app.mount('#mixed-app')


