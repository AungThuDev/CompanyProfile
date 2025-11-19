<script setup>
import { ref, computed } from 'vue';
import { ChevronLeft, ChevronRight, Search, X, Calendar, ArrowRight } from 'lucide-vue-next';
import ImageWithFallback from './figma/ImageWithFallback.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const goHome = () => router.push('/');

// Props
const props = defineProps({
  allArticles: {
    type: Array,
    default: () => []
  },
  categories: {
    type: Array,
    default: () => []
  }
});

// State
const searchQuery = ref('');
const selectedCategory = ref('All');
const currentPage = ref(1);
const articlesPerPage = 9;

// Filtered Articles
const filteredArticles = computed(() => {
  return props.allArticles.filter(article => {
    const matchesSearch =
      article.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      article.content.toLowerCase().includes(searchQuery.value.toLowerCase());

    const matchesCategory =
      selectedCategory.value === 'All' ||
      article.category === selectedCategory.value;

    return matchesSearch && matchesCategory;
  });
});

// Pagination
const totalPages = computed(() => Math.ceil(filteredArticles.value.length / articlesPerPage));

const currentArticles = computed(() => {
  const start = (currentPage.value - 1) * articlesPerPage;
  const end = start + articlesPerPage;
  return filteredArticles.value.slice(start, end);
});

// Events
function handleSearch(value) {
  searchQuery.value = value;
  currentPage.value = 1;
}

function handleCategoryChange(category) {
  selectedCategory.value = category;
  currentPage.value = 1;
}
</script>

<template>
  <div class="min-h-screen bg-black">
    <!-- Header -->
    <div class="bg-gradient-to-br from-purple-900/20 via-black to-blue-900/20 border-b border-white/10">
      <div class="max-w-7xl mx-auto px-6 py-24">
        <button
          @click="goHome"
          class="flex items-center gap-2 text-gray-400 hover:text-white transition-colors duration-300 mb-8"
        >
          <ChevronLeft class="w-5 h-5" />
          <span>Back to Home</span>
        </button>

        <div>
          <h1 class="text-white mb-4">All Articles</h1>
          <p class="text-gray-400 max-w-2xl">
            Explore our complete collection of insights, tutorials, and thought leadership on technology and innovation.
          </p>
        </div>
      </div>
    </div>

    <!-- Main -->
    <div class="max-w-7xl mx-auto px-6 py-16">

      <!-- Search Bar -->
      <div class="relative mb-8">
        <Search class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 w-5 h-5" />
        <input
          type="text"
          placeholder="Search articles..."
          v-model="searchQuery"
          @input="handleSearch($event.target.value)"
          class="w-full pl-12 pr-12 py-6 bg-white/5 border-white/10 text-white placeholder:text-gray-500 rounded-xl focus:border-purple-500/50 transition-colors duration-300"
        />
        <button
          v-if="searchQuery"
          @click="handleSearch('')"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors duration-300"
        >
          <X class="w-5 h-5" />
        </button>
      </div>

      <!-- CATEGORY FILTERS -->
      <div class="flex flex-wrap gap-3 mb-12">

        <!-- Fixed ALL -->
        <button
          @click="handleCategoryChange('All')"
          :class="[
            'px-6 py-2 rounded-full transition-all duration-300',
            selectedCategory === 'All'
              ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white'
              : 'bg-white/5 border border-white/10 text-gray-400 hover:border-purple-500/50 hover:text-white'
          ]"
        >
          All
        </button>

        <!-- Loop categories -->
        <button
          v-for="category in categories"
          :key="category.id"
          @click="handleCategoryChange(category.name)"
          :class="[
            'px-6 py-2 rounded-full transition-all duration-300',
            selectedCategory === category.name
              ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white'
              : 'bg-white/5 border border-white/10 text-gray-400 hover:border-purple-500/50 hover:text-white'
          ]"
        >
          {{ category.name }}
        </button>

      </div>

      <!-- Results count -->
      <p class="text-gray-400 mb-8">
        Showing <span class="text-white">{{ currentArticles.length }}</span> of
        <span class="text-white">{{ filteredArticles.length }}</span> articles
      </p>

      <!-- Articles Grid -->
      <div
        v-if="currentArticles.length"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12"
      >
        <article
          v-for="article in currentArticles"
          :key="article.id"
          class="group relative rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-blue-500/50 transition-all duration-300 overflow-hidden"
        >
          <!-- image -->
          <div class="relative aspect-[16/10] overflow-hidden">
            <ImageWithFallback
              :src="`/storage/${article.image}`"
              :alt="article.title"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
            <div class="absolute top-4 left-4">
              <span
                class="bg-blue-500/20 border border-blue-500/30 text-blue-300 backdrop-blur-sm inline-block rounded px-2 py-1"
              >
                {{ article.category }}
              </span>
            </div>
          </div>

          <!-- content -->
          <div class="p-6">
            <h3 class="text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">
              {{ article.title }}
            </h3>
            <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ article.content }}</p>
            <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
              <div class="flex items-center gap-1">
                <Calendar class="w-3.5 h-3.5" />
                <span>{{ article.created_at }}</span>
              </div>
            </div>
            <div
              class="flex items-center justify-between pt-4 border-t border-white/10"
            >
              <a
                href="#"
                class="text-blue-400 hover:text-blue-300 transition-colors duration-300"
              >
                <ArrowRight class="w-5 h-5" />
              </a>
            </div>
          </div>
        </article>
      </div>

      <!-- no article -->
      <div v-else class="text-center py-20">
        <p class="text-gray-400 mb-4">No articles found matching your criteria.</p>
        <button
          @click="
            () => {
              searchQuery = '';
              selectedCategory = 'All';
            }
          "
          class="px-6 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 text-white"
        >
          Clear Filters
        </button>
      </div>

      <!-- PAGINATION -->
      <div v-if="totalPages > 1" class="flex items-center justify-center gap-2">
        <button
          @click="currentPage = Math.max(currentPage - 1, 1)"
          :disabled="currentPage === 1"
          class="p-3 rounded-xl bg-white/5 border border-white/10 text-white hover:border-purple-500/50 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <ChevronLeft class="w-5 h-5" />
        </button>

        <button
          v-for="page in totalPages"
          :key="page"
          @click="currentPage = page"
          :class="[
            'px-4 py-2 rounded-xl transition-all duration-300',
            currentPage === page
              ? 'bg-gradient-to-r from-purple-500 to-blue-500 text-white'
              : 'bg-white/5 border border-white/10 text-gray-400 hover:border-purple-500/50 hover:text-white'
          ]"
        >
          {{ page }}
        </button>

        <button
          @click="currentPage = Math.min(currentPage + 1, totalPages)"
          :disabled="currentPage === totalPages"
          class="p-3 rounded-xl bg-white/5 border border-white/10 text-white hover:border-purple-500/50 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <ChevronRight class="w-5 h-5" />
        </button>
      </div>

    </div>
  </div>
</template>
