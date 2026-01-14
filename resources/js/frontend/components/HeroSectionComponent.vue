<template>
  <section
    id="hero"
    ref="heroRef"
    class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-black via-gray-900 to-black"
  >
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
      <div ref="bg1Ref" class="absolute top-1/4 -left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl" />
      <div ref="bg2Ref" class="absolute bottom-1/4 -right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl" />
    </div>

    <!-- Grid Pattern Overlay -->
    <div
      class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.02)_1px,transparent_1px)] bg-[size:100px_100px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,black,transparent)]"
    />

    <div class="relative max-w-7xl mx-auto px-6 py-32 text-center">
      <!-- Badge -->
      <div ref="badgeRef" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm mb-8">
        <Sparkles size="16" class="text-blue-400" />
        <span class="text-sm text-gray-300">Crafting Digital Excellence</span>
      </div>

      <!-- Heading -->
      <h1 ref="headingRef" class="text-white mb-6 max-w-4xl mx-auto text-4xl sm:text-5xl font-bold">
        Transform Your Vision Into
        <span
          class="block bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 bg-clip-text text-transparent mt-2"
        >
          Digital Reality
        </span>
      </h1>

      <!-- Description -->
      <p ref="descRef" class="text-gray-400 mb-12 max-w-2xl mx-auto">
        We build innovative software solutions that drive growth, enhance user experiences,
        and bring your ideas to life with cutting-edge technology.
      </p>

      <!-- Buttons -->
      <div ref="buttonsRef" class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a
          href="#contact"
          class="group px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full text-white hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] transition-all duration-300 flex items-center gap-2"
        >
          Get Started
          <ArrowRight
            size="20"
            class="group-hover:translate-x-1 transition-transform duration-300"
          />
        </a>
        <a
          href="#portfolio"
          class="px-8 py-4 border border-white/20 rounded-full text-white hover:bg-white/5 transition-all duration-300"
        >
          View Our Work
        </a>
      </div>

      <!-- Floating Elements -->
      <div class="absolute top-1/4 left-10 hidden lg:block">
        <div ref="float1Ref" class="w-16 h-16 border border-blue-500/30 rounded-lg rotate-12" />
      </div>
      <div class="absolute bottom-1/4 right-10 hidden lg:block">
        <div ref="float2Ref" class="w-20 h-20 border border-purple-500/30 rounded-full" />
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2" ref="scrollRef">
      <div class="w-6 h-10 border-2 border-white/30 rounded-full flex items-start justify-center p-2">
        <div class="w-1.5 h-2 bg-white/50 rounded-full" />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useMotion } from '@vueuse/motion'
import { ArrowRight, Sparkles } from 'lucide-vue-next'

const heroRef = ref(null)
const bg1Ref = ref(null)
const bg2Ref = ref(null)
const badgeRef = ref(null)
const headingRef = ref(null)
const descRef = ref(null)
const buttonsRef = ref(null)
const float1Ref = ref(null)
const float2Ref = ref(null)
const scrollRef = ref(null)

onMounted(() => {
  // Hero Section fade-in
  if (heroRef.value) {
    useMotion(heroRef.value, {
      initial: { y: 0 },
      enter: { y: 0 }
    })
  }

  // Background animations
  if (bg1Ref.value) {
    useMotion(bg1Ref.value, {
      animate: { scale: [1, 1.2, 1], rotate: [0, 90, 0] },
      transition: { duration: 20, repeat: Infinity, ease: 'linear' }
    })
  }
  if (bg2Ref.value) {
    useMotion(bg2Ref.value, {
      animate: { scale: [1, 1.3, 1], rotate: [0, -90, 0] },
      transition: { duration: 25, repeat: Infinity, ease: 'linear' }
    })
  }

  // Badge
  if (badgeRef.value) {
    useMotion(badgeRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.8, delay: 0.2 }
    })
  }

  // Heading
  if (headingRef.value) {
    useMotion(headingRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.8, delay: 0.4 }
    })
  }

  // Description
  if (descRef.value) {
    useMotion(descRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.8, delay: 0.6 }
    })
  }

  // Buttons
  if (buttonsRef.value) {
    useMotion(buttonsRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.8, delay: 0.8 }
    })
  }

  // Floating elements
  if (float1Ref.value) {
    useMotion(float1Ref.value, {
      animate: { y: [0, -20, 0] },
      transition: { duration: 4, repeat: Infinity, ease: 'easeInOut' }
    })
  }
  if (float2Ref.value) {
    useMotion(float2Ref.value, {
      animate: { y: [0, 20, 0] },
      transition: { duration: 5, repeat: Infinity, ease: 'easeInOut' }
    })
  }

  // Scroll indicator
  if (scrollRef.value) {
    useMotion(scrollRef.value, {
      initial: { opacity: 0 },
      enter: { opacity: 1 },
      transition: { delay: 1.5 }
    })
    const innerDot = scrollRef.value.querySelector('div div')
    if (innerDot) {
      useMotion(innerDot, {
        animate: { y: [0, 10, 0] },
        transition: { duration: 2, repeat: Infinity }
      })
    }
  }
})
</script>
