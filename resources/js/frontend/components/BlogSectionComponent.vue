<template>
    <section id="blog" class="py-32 bg-black relative overflow-hidden">
        <!-- Background decoration -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-32 bg-gradient-to-b from-transparent via-purple-500/50 to-transparent" />

        <div class="max-w-7xl mx-auto px-6">
            <!-- Section Header -->
            <div ref="headerRef" class="text-center mb-16">
                <h2 class="text-white mb-4">Latest Insights</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Stay updated with the latest trends, tips, and insights from the world of technology
                </p>
            </div>

            <!-- Featured Post -->
            <div v-if="featuredPost" ref="featuredRef" class="mb-16">
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-purple-500/50 transition-all duration-300 group">
                    <!-- Image -->
                    <div class="relative aspect-[16/10] rounded-xl overflow-hidden">
                        <ImageWithFallback :src="`/storage/${featuredPost.image}`" :alt="featuredPost.title"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-4 py-2 rounded-full bg-purple-500/90 backdrop-blur-sm text-white text-sm">Featured</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-center">
                        <div class="mb-4">
                            <span
                                class="px-3 py-1 rounded-full bg-purple-500/20 border border-purple-500/30 text-purple-300 text-sm">
                                {{ featuredPost.category }}
                            </span>
                        </div>

                        <h3 class="text-white mb-4 group-hover:text-purple-400 transition-colors duration-300">
                            {{ featuredPost.title }}
                        </h3>

                        <p class="text-gray-400 mb-6 line-clamp-5">{{ featuredPost.content }}</p>

                        <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">

                            <div class="flex items-center gap-2">
                                <Calendar size="16" />
                                <span>{{ featuredPost.created_at }}</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-for="(tag, index) in featuredPost.tags.slice(0, 3)"
                                    :key="index"
                                    class="flex items-center gap-1 px-2 py-1 text-xs rounded bg-blue-500/20 text-blue-300"
                                >
                                    <Tags size="14" class="text-blue-300" />

                                    {{ tag.name }}
                                </span>
                            </div>
                        </div>

                        <router-link :to="{ name: 'article.show', params: { id: featuredPost.id } }">
                            <button class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 transition-colors duration-300 group">
                                <span>Read Article</span>
                                <ArrowRight size="20"
                                    class="group-hover:translate-x-1 transition-transform duration-300" />
                            </button>
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- Regular Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article v-for="(post, index) in regularPosts" :key="post.title" ref="el => regularRefs[index] = el"
                    class="group relative rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-blue-500/50 transition-all duration-300 overflow-hidden">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <ImageWithFallback :src="`/storage/${post.image}`" :alt="post.title"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-300 text-sm backdrop-blur-sm">
                                {{ post.category }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">{{post.title }}</h3>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ post.content }}</p>

                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
                            <div class="flex items-center gap-1">
                                <Calendar size="14" />
                                <span>{{ post.created_at }}</span>
                            </div>

                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">

                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-for="(tag, index) in post.tags.slice(0, 3)"
                                    :key="index"
                                    class="flex items-center gap-1 px-2 py-1 text-xs rounded bg-blue-500/20 text-blue-300"
                                >
                                    <Tags size="14" class="text-blue-300" />

                                    {{ tag.name }}
                                </span>
                            </div>

                            <router-link :to="{ name: 'article.show', params: { id: post.id } }">
                                <button class="text-blue-400 hover:text-blue-300 transition-colors duration-300 group">
                                    <ArrowRight size="20"
                                        class="group-hover:translate-x-1 transition-transform duration-300" />
                                </button>
                            </router-link>

                        </div>

                    </div>
                </article>
            </div>

            <!-- View All Button -->

            <div ref="viewAllRef" class="text-center mt-12">
                <router-link to="/articles">
                    <button
                        class="inline-flex items-center gap-2 px-8 py-4 border border-white/20 rounded-full text-white hover:bg-white/5 transition-all duration-300 group">
                        <span>View All Articles</span>
                        <ArrowRight size="20" class="group-hover:translate-x-1 transition-transform duration-300" />
                    </button>
                </router-link>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useMotion } from '@vueuse/motion'
import { Calendar, ArrowRight , Tags } from 'lucide-vue-next'
import ImageWithFallback from './figma/ImageWithFallback.vue'



const props = defineProps({
    blogPosts: {
        type: Array,
        default: () => []
    },
    featuredPosts: {
        type: Object,
        default: null
    }
})
const featuredPost = computed(() => props.featuredPosts)
const regularPosts = computed(() => props.blogPosts)


const headerRef = ref(null)
const featuredRef = ref(null)
const regularRefs = ref([])
const viewAllRef = ref(null)

onMounted(() => {
    if (headerRef.value) useMotion(headerRef.value, { initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6 } })
    if (featuredRef.value) useMotion(featuredRef.value, { initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6 } })
    regularRefs.value.forEach((el, i) => {
        if (el) useMotion(el, { initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: i * 0.1 } })
    })
    if (viewAllRef.value) useMotion(viewAllRef.value, { initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: 0.4 } })
})
</script>
