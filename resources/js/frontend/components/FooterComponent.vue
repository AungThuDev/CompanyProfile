<template>
  <footer class="bg-black border-t border-white/10 py-8">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Left: Copyright -->
        <div class="text-gray-400 flex items-center gap-2">
          <span>© 2025 Tech Wave. Made with</span>
          <Heart class="text-red-500 fill-red-500" size="16" />
        </div>

        <!-- Right: Links -->
        <div class="flex gap-6">
          <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
            Privacy Policy
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
            Terms of Service
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Heart } from 'lucide-vue-next'
</script>
