<script setup>
import ArticleDetailComponent from "../components/ArticleDetailComponent.vue";
const props = defineProps({
  initialState: {
    type: Object,
    default: () => ({})
  }
})
</script>
<template>
    <div>
        <ArticleDetailComponent :allArticles="props.initialState.allArticles" />
    </div>
</template>
