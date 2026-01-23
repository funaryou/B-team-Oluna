<script setup lang="ts">
import NewsListItem from "@/components/NewsListItem.vue";
import {Content} from "@/types/content";
import {detail} from "@/routes/web/posts";
import {computed} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps<{
    items: Content[],
    currentPage: number,
    pageCount: number,
    noResultText: string
}>()

const page = computed({
    get() {
        return props.currentPage
    },
    set(value: number) {
        const newUrl = new URL(location.href)
        newUrl.searchParams.set("page", value.toString())
        router.visit(newUrl)
    },
})
</script>

<template>
    <div class="d-flex flex-column ga-4">
        <div class="d-flex flex-wrap ga-4">
            <NewsListItem
                v-for="item in items"
                :key="item.id"
                class="item"
                :image-url="item.thumbnail"
                :title="item.title"
                :tags="item.tags"
                :link="detail(item.id).url"
            />
        </div>
        <p v-if="items.length === 0" class="text-center">
            {{ noResultText }}
        </p>
        <v-pagination v-model="page" :length="pageCount" />
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
