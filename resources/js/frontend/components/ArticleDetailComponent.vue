<script setup>
import { ref, onMounted , computed } from "vue";
import ImageWithFallback from "./figma/ImageWithFallback.vue";
import { Calendar, Clock, Tags, ChevronLeft, ArrowRight } from "lucide-vue-next";
import { useRouter, useRoute } from 'vue-router';
const router = useRouter();
const route = useRoute();
const goBack = () => {
    if (window.history.length > 1) {
        router.back();
    } else {
        router.push('/articles');
    }
}
const articleId = route.params.id;

onMounted(() => {
    const found = props.allArticles.find(a => String(a.id) === String(articleId));
    articleData.value = found || props.allArticles[0] || articleData.value;
});
// Props
const props = defineProps({
    allArticles: {
        type: Array,
        default: () => []
    },
});

const articleData = ref({
    id: null,
    image: '',
    title: '',
    category: '',
    content: '',
    tags: [],
    created_at: '',
});
const relatedArticles = computed(() => {
    const currentTagNames = articleData.value.tags?.map(t => t.name) || [];
    const currentCategory = articleData.value.category;

    return props.allArticles
        .filter(a => a.id !== articleData.value.id)
        .filter(a => {
            if (currentTagNames.length && a.tags?.length) {
                // check if any tag in a.tags matches current tags
                return a.tags.some(tag => currentTagNames.includes(tag.name));
            }
            // fallback: same category
            return a.category === currentCategory;
        });
});


</script>

<template>
    <div class="min-h-screen bg-black">
        <!-- Hero Section -->
        <div class="relative h-[60vh] min-h-[500px] overflow-hidden">
            <ImageWithFallback :src="`/storage/${articleData.image}`" :alt="articleData.title" class="w-full h-full object-cover" />
            <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black via-black/60 to-transparent" />

                <!-- Navigation -->
                <div class="absolute top-0 left-0 right-20 z-50">
                    <div class="max-w-4xl mx-auto px-6 py-8">
                        <button v-motion="{ initial: { opacity: 0, x: -20 }, enter: { opacity: 1, x: 0 } }" @click="goBack"
                            class="flex items-center gap-2 text-white/80 hover:text-white transition px-4 py-2 rounded-full backdrop-blur-sm bg-black/20">
                            <ChevronLeft size="20" />
                            <span>Back to Home</span>
                        </button>
                    </div>
                </div>

                <!-- Hero Content -->
                <div class="absolute bottom-0 left-0 right-0">
                    <div class="max-w-4xl mx-auto px-6 pb-12">
                        <div
                            v-motion="{ initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: 0.2 } }">
                            <span
                                class="mb-4 inline-block rounded px-3 py-1 bg-purple-500/90 border border-purple-400/50 text-white">
                                {{ articleData.category }}
                            </span>

                            <h1 class="text-white mb-6">
                                {{ articleData.title }}
                            </h1>

                            <div class="flex items-center gap-6 text-white/80">

                                <!-- Date -->
                                <div class="flex items-center gap-2">
                                    <Calendar size="16" />
                                    <span>{{ articleData.created_at }}</span>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        v-for="(tag, index) in articleData.tags"
                                        :key="index"
                                        class="flex items-center gap-1 px-2 py-1 text-xs rounded bg-blue-500/20 text-blue-300"
                                    >
                                        <Tags size="14" class="text-blue-300" />

                                        {{ tag.name }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Article Content -->
        <div class="max-w-4xl mx-auto px-6 py-16">
            <article
                v-motion="{ initial: { opacity: 0, y: 30 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: 0.3 } }"
                class="prose prose-invert prose-lg max-w-none">
                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                    {{ articleData.content }}
                </p>

                <!-- Sections -->
                <!-- <div v-for="(section, index) in articleData.content.sections" :key="index" class="mb-12">
                    <h2 class="text-white mb-4">{{ section.heading }}</h2>
                    <p class="text-gray-300 leading-relaxed">{{ section.content }}</p>
                </div> -->

                <!-- Conclusion -->
                <!-- <div
                    class="mt-12 p-6 rounded-xl bg-gradient-to-br from-purple-500/10 to-blue-500/10 border border-purple-500/20">
                    <h2 class="text-white mb-4">Conclusion</h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ articleData.content.conclusion }}
                    </p>
                </div> -->
            </article>


            <!-- Related Articles -->
            <div v-motion="{ initial: { opacity: 0, y: 20 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: 0.5 } }"
                class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-white">Related Articles</h2>

                    <router-link to="/articles">
                        <button v-motion="{ whileHover: { x: 5 } }"
                            class="text-purple-400 hover:text-purple-300 transition flex items-center gap-2 group">
                            <span>View All</span>
                            <ArrowRight size="20" class="group-hover:translate-x-1 transition-transform duration-300" />
                        </button>
                    </router-link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article v-for="(article, index) in relatedArticles" :key="article.id"
                        v-motion="{ initial: { opacity: 0, y: 20 }, enter: { opacity: 1, y: 0 }, transition: { duration: 0.6, delay: 0.6 + index * 0.1 } }"
                        class="group relative rounded-xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-blue-500/50 transition-all duration-300 overflow-hidden cursor-pointer">
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <ImageWithFallback :src="`/storage/${article.image}`" :alt="article.title"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />

                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-blue-500/20 border border-blue-500/30 text-blue-300 text-xs inline-block rounded px-2 py-1">
                                    {{ article.category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h4
                                class="text-white mb-3 line-clamp-2 group-hover:text-blue-400 transition-colors duration-300">
                                {{ article.title }}
                            </h4>

                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="flex items-center gap-1">
                                    <Calendar size="12" />
                                    <span>{{ article.created_at }}</span>
                                </div>

                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>
