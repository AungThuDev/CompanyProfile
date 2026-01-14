<template>
  <section id="services" class="py-32 bg-black relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-32 bg-gradient-to-b from-transparent via-blue-500/50 to-transparent" />

    <div class="max-w-7xl mx-auto px-6">
      <!-- Section Header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 class="text-white mb-4">Our Services</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">
          Comprehensive solutions tailored to your unique business needs
        </p>
      </div>

      <!-- Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(service, index) in services"
          :key="service.id"
          ref="el => serviceRefs[index] = el"
          class="group relative p-8 rounded-2xl bg-gradient-to-br from-white/5 to-white/0 border border-white/10 hover:border-blue-500/50 transition-all duration-300 hover:shadow-[0_0_40px_rgba(59,130,246,0.15)]"
        >
          <!-- Gradient overlay on hover -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

          <div class="relative">
            <div
              class="mb-6 inline-flex p-3 rounded-xl bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-white/10 group-hover:scale-110 transition-transform duration-300"
            >
              <ImageWithFallback :src="`/storage/${service.icon}`" class="w-6 h-6 text-blue-400" />
            </div>

            <h3 class="text-white mb-3">{{ service.title }}</h3>
            <p class="text-gray-400">{{ service.description }}</p>

            <!-- Hover arrow -->
            <div
              ref="el => hoverRefs[index] = el"
              class="mt-4 text-blue-400 flex items-center gap-2 opacity-0"
            >
              <span>Learn more</span>
              <span>→</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useInViewMotion } from '../composables/useInViewMotion'

import ImageWithFallback from './figma/ImageWithFallback.vue'

const props = defineProps({
  services: {
    type: Array,
    default: () => []
  }
})

// const services = [
//   { icon: Code2, title: 'Web Development', description: 'Custom web applications built with modern frameworks and best practices.' },
//   { icon: Smartphone, title: 'Mobile Apps', description: 'Native and cross-platform mobile solutions for iOS and Android.' },
//   { icon: Palette, title: 'UI/UX Design', description: 'Beautiful, intuitive interfaces that users love to interact with.' },
//   { icon: Cloud, title: 'Cloud Solutions', description: 'Scalable cloud infrastructure and deployment strategies.' },
//   { icon: Lock, title: 'Security', description: 'Enterprise-grade security implementations and compliance.' },
//   { icon: Zap, title: 'Performance', description: 'Lightning-fast applications optimized for speed and efficiency.' },
// ]

// Refs for animations
const headerRef = ref(null)
const serviceRefs = ref([])
const hoverRefs = ref([])

onMounted(() => {
  if (headerRef.value) {
    useInViewMotion(headerRef, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.6 }
    })
  }

  serviceRefs.value.forEach((el, index) => {
    if (el) {
      useInViewMotion({ value: el }, {
        initial: { opacity: 0, y: 30 },
        enter: { opacity: 1, y: 0 },
        whileHover: { scale: 1.02 },
        whileTap: { scale: 0.98 },
        transition: { duration: 0.6, delay: index * 0.1 }
      })
    }
  })

  hoverRefs.value.forEach((el) => {
    if (el) {
      useInViewMotion({ value: el }, {
        initial: { opacity: 0, x: -10 },
        whileHover: { opacity: 1, x: 0 },
        transition: { duration: 0.3 }
      })
    }
  })
})
</script>
