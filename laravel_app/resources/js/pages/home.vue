<script setup lang="ts">
import {Content} from "@/types/content";
import NewsList from "@/components/NewsList.vue";

interface Props {
    items: Content[],
    currentPage: number,
    lastPage: number,
}
defineProps<Props>()
</script>

<template>
<div>
    <NewsList
        :items="items"
        :current-page="currentPage"
        :page-count="lastPage"
    />
</div>
</template>

<style scoped>

</style>
