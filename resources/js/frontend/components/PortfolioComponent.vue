<template>
    <section id="portfolio" class="py-32 bg-gradient-to-b from-black to-gray-900 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">

            <div ref="headerRef" class="text-center mb-16">
                <h2 class="text-white mb-4">Featured Work</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    A showcase of our recent projects and creative solutions
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="(project, index) in props.projects" :key="project.id" ref="el => projectRefs[index] = el"
                    class="group relative aspect-[4/3] rounded-2xl overflow-hidden cursor-pointer">
                    <!-- Image -->
                    <ImageWithFallback :src="`/storage/${project.image}`" :alt="project.title"
                        className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300" />

                    <div class="absolute inset-0 p-6 flex flex-col justify-end z-10">
                        <div class="translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <span
                                class="inline-block px-3 py-1 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-300 text-sm mb-3">
                                {{ project.category }}
                            </span>
                            <h3 class="text-white mb-2">{{ project.title }}</h3>
                        </div>
                    </div>

                    <a :href="project.url" target="_blank"
                        class="absolute  inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 pointer-events-auto bg-black/30 transition-opacity duration-300 z-20">
                        <span class="mr-2 text-blue-400 font-medium">View Project</span>
                        <ExternalLink size="16" class="text-blue-400" />
                    </a>

                    <div
                        class="absolute inset-0 rounded-2xl border border-transparent group-hover:border-blue-500/50 transition-colors duration-300 z-10 pointer-events-none" />
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useInViewMotion } from '../composables/useInViewMotion'
import { ExternalLink } from 'lucide-vue-next'
import ImageWithFallback from './figma/ImageWithFallback.vue'

const props = defineProps({
    projects: {
        type: Array,
        default: () => []
    }
})

const headerRef = ref(null)
const projectRefs = ref([])

onMounted(() => {
    if (headerRef.value) {
        useInViewMotion(headerRef, {
            initial: { opacity: 0, y: 30 },
            enter: { opacity: 1, y: 0 },
            transition: { duration: 0.6 }
        })
    }

    projectRefs.value.forEach((el, i) => {
        if (el) {
            useInViewMotion({ value: el }, {
                initial: { opacity: 0, y: 30 },
                enter: { opacity: 1, y: 0 },
                whileHover: { scale: 1.02 },
                whileTap: { scale: 0.98 },
                transition: { duration: 0.6, delay: i * 0.1 }
            })
        }
    })
})
</script>
