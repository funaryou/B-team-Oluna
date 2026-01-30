<script lang="ts">
import DetailLayout from "@/layouts/DetailLayout.vue";
export default {
    layout: DetailLayout
}
</script>

<script setup lang="ts">
import PostDetail from "@/components/PostDetail.vue";

const { data } = defineProps<{ data: any }>()
</script>

<template>
    <div>
        <PostDetail :data="data" />
    </div>
</template>

<style scoped>
    
</style>
