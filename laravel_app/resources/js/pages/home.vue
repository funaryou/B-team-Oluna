<script setup lang="ts">
import {Content} from "@/types/content";
import NewsList from "@/components/NewsList.vue";

interface Props {
    items: Content[]
}
defineProps<Props>()
</script>

<template>
<div>
    <NewsList :items="items" />
    <p v-if="items.length === 0" class="text-center">
        記事はまだありません
    </p>
</div>
</template>

<style scoped>

</style>
