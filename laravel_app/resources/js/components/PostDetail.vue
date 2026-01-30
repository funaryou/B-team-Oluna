<script setup lang="ts">
import { ref, computed } from 'vue';
import ImageCarousel from "@/components/ImageCarousel.vue";

interface Props {
    data: {
        id: number
        title: string
        text: string
        tags: string[]
        images: string[]
        thumbnail: string
    }
}

const props = defineProps<Props>()

const currentImageIndex = ref(0)

const allImages = computed(() => {
    const imgs: string[] = []
    if (props.data.thumbnail) {
        imgs.push(props.data.thumbnail)
    }
    if (props.data.images && props.data.images.length > 0) {
        imgs.push(...props.data.images)
    }
    return imgs
})
</script>

<template>
    <div>
        <v-container class="post-container">
            <h1 class="post-title">{{ data.title }}</h1>
            <v-img
                v-if="data.thumbnail"
                :src="data.thumbnail"
                width="100%"
                aspect-ratio="1.89"
                cover
                class="post-thumbnail"
            />
            <div v-if="data.tags && data.tags.length > 0" class="tags-container">
                <v-chip
                    v-for="tag in data.tags"
                    :key="tag"
                    class="tag-chip"
                    variant="text"
                    :ripple="false"
                >
                    #{{ tag }}
                </v-chip>
            </div>
            <div class="post-text">{{ data.text }}</div>
            <ImageCarousel 
                v-if="allImages.length > 0"
                :images="allImages"
                v-model="currentImageIndex"
                class="fixed-bottom-carousel"
            />
        </v-container>
    </div>
</template>

<style scoped>
/* Replicating Tailwind classes with standard CSS */

.post-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    padding-bottom: 340px;
}

.post-title {
    font-size: 32px;
    font-weight: normal;
    line-height: 1.2;
    font-family: 'Regular', sans-serif;
    padding: 10px 0;
    margin: 0 0 16px 0;
}

.post-thumbnail {
    width: 100%;
    height: auto;
    border-radius: 12px;
    margin-bottom: 16px;
}

.tags-container {
    text-align: right;
    padding: 0;
    margin-bottom: 16px;
}

.tag-chip {
    height: auto !important;
    min-height: 0 !important;
    padding: 0 !important;
    display: inline-block;
    line-height: 1.2;
}

.post-text {
    padding: 0;
    word-break: break-all;
    white-space: pre-wrap;
    padding-bottom: 400px;
}

/* Existing styles */
.fixed-bottom-carousel {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 205px;
    z-index: 100;
    border-radius: 24px 24px 0 0;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
}

@media (min-width: 1024px) {
    .fixed-bottom-carousel {
        height: 400px;
    }
}
</style>