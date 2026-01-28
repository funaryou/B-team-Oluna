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
        <v-container class="max-w-[1200px] mx-auto px-4 pb-[340px]">
            <h1 class="text-[32px] font-normal leading-[1.2] font-['Regular'] py-[10px] mb-4 mt-0">{{ data.title }}</h1>
            <v-img
                v-if="data.thumbnail"
                :src="data.thumbnail"
                width="100%"
                aspect-ratio="1.89"
                cover
                class="post-thumbnail w-full h-auto thumbnail-rounded mb-4"
            />
            <div v-if="data.tags && data.tags.length > 0" class="text-right p-0 mb-4">
                <v-chip
                    v-for="tag in data.tags"
                    :key="tag"
                    class="h-auto min-h-0 p-0 display-inline-block line-height-1.2"
                    variant="text"
                    :ripple="false"
                >
                    #{{ tag }}
                </v-chip>
            </div>
            <div class="p-0 text-break-all whitespace-pre-wrap" style="padding-bottom: 400px;">{{ data.text }}</div>
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
.thumbnail-rounded {
    border-radius: 12px;
}

.text-break-all {
    word-break: break-all;
}

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