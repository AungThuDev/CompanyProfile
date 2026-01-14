<script setup>
import AllArticleComponent from "../components/AllArticleComponent.vue";
const props = defineProps({
  initialState: {
    type: Object,
    default: () => ({})
  }
})
</script>
<template>
    <div>
        <AllArticleComponent :allArticles="props.initialState.allArticles" :categories="props.initialState.categories" />
    </div>
</template>
