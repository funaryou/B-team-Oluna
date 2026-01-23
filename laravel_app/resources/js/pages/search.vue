<script setup lang="ts">
import {Content} from "@/types/content";
import NewsList from "@/components/NewsList.vue";

defineProps<{
    currentPage: number
    perPage: number
    total: number
    lastPage: number
    items: Content[]
}>()
</script>

<template>
    <div>
        <NewsList
            :items="items"
            :current-page="currentPage"
            :page-count="lastPage"
            no-result-text="見つかりませんでした"
        />
    </div>
</template>
