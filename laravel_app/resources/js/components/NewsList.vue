<script setup lang="ts">
import NewsListItem from "@/components/NewsListItem.vue";
import {Content} from "@/types/content";
import {detail} from "@/routes/web/posts";

defineProps<{
    items: Content[]
}>()
</script>

<template>
    <div class="d-flex flex-wrap ga-4">
        <NewsListItem
            v-for="item in items"
            :key="item.id"
            class="item"
            :image-url="item.thumbnail"
            :title="item.title"
            :tags="item.tags.map(e => e.tags)"
            :link="detail(item.id)"
        />
    </div>
</template>

<style lang="scss" scoped>
.item {
    flex-basis: 100%;
}

@media screen and (min-width: 960px) {
    .item {
        flex-basis: calc(50% - 8px);
    }
}

@media screen and (min-width: 1200px) {
    .item {
        flex-basis: calc(33% - 8px);
    }
}
</style>
