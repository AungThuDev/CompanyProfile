<template>
  <section id="blog" class="py-32 bg-black relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-32 bg-gradient-to-b from-transparent via-purple-500/50 to-transparent" />

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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-purple-500/50 transition-all duration-300 group">
          <!-- Image -->
          <div class="relative aspect-[16/10] rounded-xl overflow-hidden">
            <ImageWithFallback
              :src="featuredPost.image"
              :alt="featuredPost.title"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute top-4 left-4">
              <span class="px-4 py-2 rounded-full bg-purple-500/90 backdrop-blur-sm text-white text-sm">Featured</span>
            </div>
          </div>

          <!-- Content -->
          <div class="flex flex-col justify-center">
            <div class="mb-4">
              <span class="px-3 py-1 rounded-full bg-purple-500/20 border border-purple-500/30 text-purple-300 text-sm">
                {{ featuredPost.category }}
              </span>
            </div>

            <h3 class="text-white mb-4 group-hover:text-purple-400 transition-colors duration-300">
              {{ featuredPost.title }}
            </h3>

            <p class="text-gray-400 mb-6">{{ featuredPost.excerpt }}</p>

            <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
              <div class="flex items-center gap-2">
                <User size="16" />
                <span>{{ featuredPost.author }}</span>
              </div>
              <div class="flex items-center gap-2">
                <Calendar size="16" />
                <span>{{ featuredPost.date }}</span>
              </div>
              <div class="flex items-center gap-2">
                <Clock size="16" />
                <span>{{ featuredPost.readTime }}</span>
              </div>
            </div>

            <a href="#" class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 transition-colors duration-300 group">
              <span>Read Article</span>
              <ArrowRight size="20" class="group-hover:translate-x-1 transition-transform duration-300" />
            </a>
          </div>
        </div>
      </div>

      <!-- Regular Posts Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <article
          v-for="(post, index) in regularPosts"
          :key="post.title"
          ref="el => regularRefs[index] = el"
          class="group relative rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-blue-500/50 transition-all duration-300 overflow-hidden"
        >
          <div class="relative aspect-[16/10] overflow-hidden">
            <ImageWithFallback
              :src="post.image"
              :alt="post.title"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
            <div class="absolute top-4 left-4">
              <span class="px-3 py-1 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-300 text-sm backdrop-blur-sm">
                {{ post.category }}
              </span>
            </div>
          </div>

          <div class="p-6">
            <h3 class="text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">{{ post.title }}</h3>
            <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ post.excerpt }}</p>

            <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
              <div class="flex items-center gap-1">
                <Calendar size="14" />
                <span>{{ post.date }}</span>
              </div>
              <div class="flex items-center gap-1">
                <Clock size="14" />
                <span>{{ post.readTime }}</span>
              </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-white/10">
              <div class="flex items-center gap-2 text-sm text-gray-400">
                <User size="16" />
                <span>{{ post.author }}</span>
              </div>
              <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 group">
                <ArrowRight size="20" class="group-hover:translate-x-1 transition-transform duration-300" />
              </a>
            </div>
          </div>
        </article>
      </div>

      <!-- View All Button -->
      <div ref="viewAllRef" class="text-center mt-12">
        <a
          href="#"
          class="inline-flex items-center gap-2 px-8 py-4 border border-white/20 rounded-full text-white hover:bg-white/5 transition-all duration-300 group"
        >
          <span>View All Articles</span>
          <ArrowRight size="20" class="group-hover:translate-x-1 transition-transform duration-300" />
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useMotion } from '@vueuse/motion'
import { Calendar, Clock, ArrowRight, User } from 'lucide-vue-next'
import ImageWithFallback from './figma/ImageWithFallback.vue'

const blogPosts = [
  { title: 'The Future of AI in Software Development', excerpt: 'Explore how artificial intelligence is revolutionizing the way we build and deploy applications, from code generation to intelligent testing.', image: 'https://images.unsplash.com/photo-1697577418970-95d99b5a55cf?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Artificial Intelligence', author: 'Sarah Chen', date: 'Nov 10, 2025', readTime: '5 min read', featured: true },
  { title: 'Modern Web Design Principles for 2025', excerpt: 'Discover the latest trends and best practices in web design that create engaging and accessible user experiences.', image: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Design', author: 'Michael Park', date: 'Nov 8, 2025', readTime: '7 min read', featured: false },
  { title: 'Cloud-Native Architecture: A Complete Guide', excerpt: 'Learn how to build scalable, resilient applications using cloud-native technologies and microservices architecture.', image: 'https://images.unsplash.com/photo-1667984390538-3dea7a3fe33d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Cloud Computing', author: 'David Rodriguez', date: 'Nov 5, 2025', readTime: '10 min read', featured: false },
  { title: 'Best Practices for Mobile App Development', excerpt: 'Essential strategies and patterns for building high-performance mobile applications that users love.', image: 'https://images.unsplash.com/photo-1633250391894-397930e3f5f2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Mobile Development', author: 'Emma Thompson', date: 'Nov 3, 2025', readTime: '6 min read', featured: false },
  { title: 'Mastering Modern JavaScript Frameworks', excerpt: 'Deep dive into React, Vue, and other popular frameworks to choose the right tool for your next project.', image: 'https://images.unsplash.com/photo-1565229284535-2cbbe3049123?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Development', author: 'Alex Kim', date: 'Nov 1, 2025', readTime: '8 min read', featured: false },
  { title: 'Cybersecurity in the Age of Remote Work', excerpt: 'Critical security measures and best practices to protect your applications and data in a distributed workforce.', image: 'https://images.unsplash.com/photo-1762330463863-a6a399beb5ba?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', category: 'Security', author: 'Jessica Lee', date: 'Oct 28, 2025', readTime: '9 min read', featured: false },
]

const featuredPost = blogPosts.find(p => p.featured)
const regularPosts = blogPosts.filter(p => !p.featured)

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
