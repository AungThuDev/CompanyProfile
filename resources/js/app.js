import "./bootstrap";
import "@tailwindplus/elements";
import { createApp } from 'vue'
import { MotionPlugin } from '@vueuse/motion'
import router from './frontend/router'

import App from './frontend/App.vue'

const el = document.getElementById('mixed-app');
if (el) {
  const initialState = JSON.parse(el.dataset?.initial || '{}');
  const app = createApp(App, { initialState });
  app.use(MotionPlugin);
  app.use(router);
  app.mount('#mixed-app');
}
window.history.scrollRestoration = 'manual';

window.addEventListener('load', () => {
    window.scrollTo(0, 0);
});



