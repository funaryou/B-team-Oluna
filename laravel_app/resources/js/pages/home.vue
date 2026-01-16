<script setup lang="ts">
import NewsListItem from "@/components/NewsListItem.vue";
import {Content} from "@/types/content";
import {show} from "@/actions/App/Http/Controllers/PostController"

interface Props {
    items: Content[]
}
defineProps<Props>()
</script>

<template>
<div>
    <div class="d-flex flex-wrap ga-4">
        <NewsListItem
            v-for="item in items"
            :key="item.id"
            class="w-100"
            :image-url="item.thumbnail"
            :title="item.title"
            :tags="item.tags.map(e => e.tags)"
            :link="show(item.id)"
        />
    </div>
    <p v-if="items.length === 0" class="text-center">
        記事はまだありません
    </p>
</div>
</template>

<style scoped>

</style>
