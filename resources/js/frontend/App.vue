<script setup>
import NavigationComponent from './components/NavigationComponent.vue'
import HeroSectionComponent from './components/HeroSectionComponent.vue'
import ServiceComponent from './components/ServiceComponent.vue'
import PortfolioComponent from './components/PortfolioComponent.vue'
import BlogSectionComponent from './components/BlogSectionComponent.vue'
import AboutComponent from './components/AboutComponent.vue'
import ContactComponent from './components/ContactComponent.vue'
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
  <hero-section-component />

  <service-component :services="props.initialState.services" />

  <portfolio-component :projects="props.initialState.projects" />

  <blog-section-component />
  <about-component />
  <contact-component />
  <footer-component />
</template>
