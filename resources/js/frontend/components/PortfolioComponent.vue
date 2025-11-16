<template>
  <section id="portfolio" class="py-32 bg-gradient-to-b from-black to-gray-900 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      <!-- Section Header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 class="text-white mb-4">Featured Work</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">
          A showcase of our recent projects and creative solutions
        </p>
      </div>

      <!-- Projects Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(project, index) in projects"
          :key="project.title"
          ref="el => projectRefs[index] = el"
          class="group relative aspect-[4/3] rounded-2xl overflow-hidden cursor-pointer"
        >
          <!-- Image -->
          <ImageWithFallback
            :src="project.image"
            :alt="project.title"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
          />

          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300" />

          <!-- Content -->
          <div class="absolute inset-0 p-6 flex flex-col justify-end">
            <div class="translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
              <span class="inline-block px-3 py-1 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-300 text-sm mb-3">
                {{ project.category }}
              </span>
              <h3 class="text-white mb-2">{{ project.title }}</h3>

              <!-- View Project Link -->
              <div
                class="opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center gap-2 text-blue-400"
              >
                <span>View Project</span>
                <ExternalLink size="16" />
              </div>
            </div>
          </div>

          <!-- Border glow on hover -->
          <div class="absolute inset-0 rounded-2xl border border-transparent group-hover:border-blue-500/50 transition-colors duration-300" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useMotion } from '@vueuse/motion'
import { ExternalLink } from 'lucide-vue-next'
import ImageWithFallback from './figma/ImageWithFallback.vue'

const projects = [
  { title: 'E-Commerce Platform', category: 'Web Development', image: 'https://images.unsplash.com/photo-1605379399642-870262d3d051?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
  { title: 'Mobile Banking App', category: 'Mobile Design', image: 'https://images.unsplash.com/photo-1646153114001-495dfb56506d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
  { title: 'AI Dashboard', category: 'UI/UX Design', image: 'https://images.unsplash.com/photo-1558655146-d09347e92766?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
  { title: 'SaaS Platform', category: 'Full Stack', image: 'https://images.unsplash.com/photo-1730036900477-09391e7a5414?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
  { title: 'Brand Identity', category: 'Branding', image: 'https://images.unsplash.com/photo-1758873272921-4b64aef3c32b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
  { title: 'Workflow Automation', category: 'Enterprise', image: 'https://images.unsplash.com/photo-1722159475082-0a2331580de3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080' },
]

const headerRef = ref(null)
const projectRefs = ref([])

onMounted(() => {
  if (headerRef.value) {
    useMotion(headerRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.6 }
    })
  }

  projectRefs.value.forEach((el, i) => {
    if (el) {
      useMotion(el, {
        initial: { opacity: 0, y: 30 },
        enter: { opacity: 1, y: 0 },
        transition: { duration: 0.6, delay: i * 0.1 }
      })
    }
  })
})
</script>
