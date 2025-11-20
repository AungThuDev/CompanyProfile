import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Articles from '../pages/Articles.vue'
import ArticleDetail from '../pages/ArticleDetail.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/articles', name: 'articles', component: Articles },
    { path: '/articles/:id', name: 'article.show', component: ArticleDetail, props: true }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        
        if (savedPosition) {
            return savedPosition
        }

        return { top: 0 }
    }
})

export default router
