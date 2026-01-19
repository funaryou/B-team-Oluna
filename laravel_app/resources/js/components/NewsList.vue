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
            :link="detail(item.id).url"
        />
    </div>
</template>

<style lang="scss" scoped>
@use "vuetify/settings";
@use "sass:map";

.item {
    flex-basis: 100%;
}

@media (map.get(settings.$display-breakpoints, "sm")) or (map.get(settings.$display-breakpoints, "md")) {
    .item {
        flex-basis: calc(50% - 8px);
    }
}

@media (map.get(settings.$display-breakpoints, "lg-and-up")) {
    .item {
        flex-basis: calc(33% - 8px);
    }
}
</style>
