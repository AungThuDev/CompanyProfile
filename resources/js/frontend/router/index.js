import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Articles from '../pages/Articles.vue'
import ArticleDetail from '../pages/ArticleDetail.vue'
import NotFound from '../pages/NotFound.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/articles', name: 'articles', component: Articles },
    { path: '/articles/:id', name: 'article.show', component: ArticleDetail, props: true },
    { path: '/:pathMatch(.*)*', name: 'not-found', component: NotFound }
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
