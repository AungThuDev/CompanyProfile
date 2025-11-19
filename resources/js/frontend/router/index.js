import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Articles from '../pages/Articles.vue'


const routes = [
    { path: '/', component: Home },
    { path: '/articles', name: 'articles', component: Articles }

]

export default createRouter({
    history: createWebHistory(),
    routes
})
