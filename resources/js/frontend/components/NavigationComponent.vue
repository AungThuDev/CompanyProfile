<template>
  <nav
    ref="navRef"
    class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-md border-b border-white/10"
  >
    <div class="max-w-7xl mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <a href="#" class="text-white" @click.prevent="scrollToSection('hero')">
            <span class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500
                        bg-clip-text text-transparent font-bold text-xl md:text-2xl lg:text-3xl">
                Tech Wave
            </span>
        </a>




        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center gap-8">
          <a
            v-for="(item, index) in navItems"
            :key="item"
            href="#"
            @click.prevent="scrollToSection(item)"
            class="text-gray-300 hover:text-white transition-colors duration-300 relative group"
            >
            {{ item }}
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-400 to-purple-600 group-hover:w-full transition-all duration-300"
            />
            </a>

        </div>

        <!-- Mobile Menu Button -->
        <button @click="isOpen = !isOpen" class="md:hidden text-white p-2">
          <component :is="isOpen ? X : Menu" :size="24" />
        </button>
      </div>

      <!-- Mobile Navigation -->
      <div
        v-if="isOpen"
        ref="mobileNavRef"
        class="md:hidden mt-4 pb-4 flex flex-col overflow-hidden"
      >
        <a
          v-for="item in navItems"
          :key="item"
          :href="`#${item.toLowerCase()}`"
          @click="isOpen = false"
          class="block py-2 text-gray-300 hover:text-white transition-colors duration-300"
        >
          {{ item }}
        </a>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useMotion } from '@vueuse/motion'
import { Menu, X } from 'lucide-vue-next'

const isOpen = ref(false)
const navItems = ['Services', 'Portfolio', 'Blog', 'About', 'Contact']

const scrollToSection = (item) => {
  const section = document.getElementById(item.toLowerCase())
  if (section) {
    section.scrollIntoView({ behavior: 'smooth', block: 'start' })
    isOpen.value = false
  }
}

const navRef = ref(null)
const logoRef = ref(null)
const mobileNavRef = ref(null)
const navLinksRefs = ref([])

onMounted(() => {
  // Animate the main nav
  if (navRef.value) {
    useMotion(navRef.value, {
      initial: { y: -100, opacity: 0 },
      enter: { y: 0, opacity: 1, transition: { duration: 0.6 } }
    })
  }

  if (logoRef.value) {
    useMotion(logoRef.value, {
      initial: { opacity: 0 },
      enter: { opacity: 1, transition: { delay: 0.2 } }
    })
  }

  navLinksRefs.value.forEach((el, index) => {
    if (el) {
      useMotion(el, {
        initial: { opacity: 0, y: -20 },
        enter: { opacity: 1, y: 0, transition: { delay: 0.1 * index } }
      })
    }
  })

  watch(isOpen, (open) => {
    if (open && mobileNavRef.value) {
      useMotion(mobileNavRef.value, {
        initial: { opacity: 0, height: 0 },
        enter: { opacity: 1, height: 'auto', transition: { duration: 0.3 } },
        leave: { opacity: 0, height: 0, transition: { duration: 0.3 } }
      })
    }
  })
})
</script>
