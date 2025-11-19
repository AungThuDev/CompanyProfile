<script setup>
import NavigationComponent from './components/NavigationComponent.vue'
import FooterComponent from './components/FooterComponent.vue'

const props = defineProps({
  initialState: {
    type: Object,
    default: () => ({})
  }
})
</script>

<template>
  <navigation-component />
  <router-view v-slot="{ Component }">
    <component :is="Component" :initialState="props.initialState" />
  </router-view>
  <footer-component />
</template>
