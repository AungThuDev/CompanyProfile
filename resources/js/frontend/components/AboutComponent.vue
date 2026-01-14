<template>
  <section id="about" class="py-32 bg-black relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl" />
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl" />

    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Image Side -->
        <div ref="imageMotion" class="relative">
          <div class="relative rounded-2xl overflow-hidden">
            <ImageWithFallback
              src="https://images.unsplash.com/photo-1758873272921-4b64aef3c32b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjcmVhdGl2ZSUyMHRlYW0lMjB3b3Jrc3BhY2V8ZW58MXx8fHwxNzYyOTQzODIyfDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
              alt="Tech Wave Team"
              class="w-full h-[600px] object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />
          </div>

          <!-- Decorative elements -->
          <div class="absolute -top-6 -right-6 w-32 h-32 border border-blue-500/30 rounded-2xl rotate-12 hidden lg:block" />
          <div class="absolute -bottom-6 -left-6 w-24 h-24 border border-purple-500/30 rounded-full hidden lg:block" />
        </div>

        <!-- Content Side -->
        <div ref="contentMotion">
          <h2 class="text-white mb-6">About Tech Wave</h2>
          <p class="text-gray-400 mb-6">
            We are a passionate team of designers, developers, and strategists dedicated to
            creating exceptional digital experiences. With a focus on innovation and quality,
            we turn complex challenges into elegant solutions.
          </p>
          <p class="text-gray-400 mb-8">
            Our approach combines cutting-edge technology with creative design thinking to
            deliver products that not only meet but exceed expectations. We believe in building
            long-term partnerships with our clients through transparency, communication, and
            exceptional results.
          </p>

          <!-- Highlights -->
          <div class="space-y-3 mb-8">
            <div
              v-for="(highlight, index) in highlights"
              :key="highlight"
              ref="highlightRefs"
              class="flex items-start gap-3"
            >
              <CheckCircle class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" />
              <span class="text-gray-300">{{ highlight }}</span>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/10">
            <div
              v-for="(stat, i) in stats"
              :key="stat.label"
              ref="statRefs"
              class="text-center"
            >
              <component :is="stat.icon" class="mx-auto mb-2" :size="24" color="#3b82f6" />
              <div class="text-white mb-1">{{ stat.value }}</div>
              <div class="text-sm text-gray-400">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useInViewMotion } from '../composables/useInViewMotion'
import ImageWithFallback from './figma/ImageWithFallback.vue'
import { CheckCircle, Users, Award, TrendingUp } from 'lucide-vue-next'

const stats = [
  { icon: Users, value: '150+', label: 'Happy Clients' },
  { icon: Award, value: '300+', label: 'Projects Delivered' },
  { icon: TrendingUp, value: '98%', label: 'Success Rate' },
]

const highlights = [
  'Expert team with 10+ years of experience',
  'Agile development methodology',
  'End-to-end project management',
  'Continuous support and maintenance',
]

// Refs for motion
const imageMotion = ref(null)
const contentMotion = ref(null)
const highlightRefs = ref([])
const statRefs = ref([])

onMounted(() => {
  useInViewMotion(imageMotion, {
    initial: { opacity: 0, x: -50 },
    enter: { opacity: 1, x: 0 },
    transition: { duration: 0.8 },
  })

  useInViewMotion(contentMotion, {
    initial: { opacity: 0, x: 50 },
    enter: { opacity: 1, x: 0 },
    transition: { duration: 0.8 },
  })

  highlightRefs.value.forEach((el, index) => {
    useInViewMotion({ value: el }, {
      initial: { opacity: 0, x: 20 },
      enter: { opacity: 1, x: 0 },
      transition: { duration: 0.5, delay: index * 0.1 },
    })
  })

  statRefs.value.forEach((el, index) => {
    useInViewMotion({ value: el }, {
      initial: { opacity: 0, x: -50 },
      enter: { opacity: 1, x: 0 },
      transition: { duration: 0.8, delay: index * 0.1 },
    })
  })
})
</script>
