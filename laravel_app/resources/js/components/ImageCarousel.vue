<script setup lang="ts">
import { computed, ref } from 'vue'
import navPrev from '@/assets/vectors/nav-prev.svg'
import navNext from '@/assets/vectors/nav-next.svg'

interface Props {
    images: string[]
    modelValue: number
}

interface Emits {
    (e: 'update:modelValue', value: number): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const hasNext = computed(() => props.modelValue < props.images.length - 1)
const hasPrevious = computed(() => props.modelValue > 0)

const nextImage = () => {
    if (hasNext.value) {
        emit('update:modelValue', props.modelValue + 1)
    }
}

const previousImage = () => {
    if (hasPrevious.value) {
        emit('update:modelValue', props.modelValue - 1)
    }
}

// Swipe detection implementation
const touchStartX = ref(0)
const touchEndX = ref(0)
const minSwipeDistance = 50 // Minimum distance required for a swipe

const handleTouchStart = (e: TouchEvent) => {
    touchStartX.value = e.changedTouches[0].screenX
}

const handleTouchEnd = (e: TouchEvent) => {
    touchEndX.value = e.changedTouches[0].screenX
    handleSwipe()
}

const handleSwipe = () => {
    const distance = touchEndX.value - touchStartX.value
    
    if (distance < -minSwipeDistance) {
        nextImage()
    }
    else if (distance > minSwipeDistance) {
        previousImage()
    }
}
</script>

<template>
    <div 
        class="carousel-container glass-effect"
        @touchstart="handleTouchStart"
        @touchend="handleTouchEnd"
    >
        <div class="carousel-content">
            <div 
                class="nav-section" 
                :class="{ disabled: !hasPrevious }"
                @click="previousImage"
            >
                <v-btn
                    v-if="images.length > 1"
                    :disabled="!hasPrevious"
                    icon
                    variant="text"
                    color="white"
                    class="nav-btn"
                >
                    <img :src="navPrev" alt="Previous" />
                </v-btn>
            </div>

            <div class="image-section">
                <!-- 
                     Using v-for and v-show to preload all images.
                     This improves perceived performance when switching images.
                -->
                <img 
                    v-for="(image, index) in images"
                    :key="index"
                    :src="image"
                    v-show="modelValue === index"
                    alt="Carousel Image"
                    class="main-image"
                />
            </div>
            
            <div 
                class="nav-section"
                :class="{ disabled: !hasNext }"
                @click="nextImage"
            >
                <v-btn
                    v-if="images.length > 1"
                    :disabled="!hasNext"
                    icon
                    variant="text"
                    color="white"
                    class="nav-btn"
                >
                    <img :src="navNext" alt="Next" />
                </v-btn>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Transformed Tailwind classes to standard CSS */
.carousel-container {
    position: relative;
    width: 100%;
    height: 205px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

@media (min-width: 1024px) {
    .carousel-container {
        height: 400px;
    }
}

.glass-effect {
    background: rgba(255, 203, 80, 0.4);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.carousel-content {
    position: relative;
    z-index: 20;
    display: flex;
    flex: 1;
    align-items: center;
    justify-content: center;
    gap: 16px;
    padding: 0 16px;
    height: 100%;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.nav-section {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 53px;
    height: 53px;
    cursor: pointer;
    transition: background-color 0.2s;
    z-index: 30;
    flex-shrink: 0;
}

.nav-section:not(.disabled):hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.nav-section.disabled {
    cursor: default;
    opacity: 0.3;
}

.image-section {
    flex: 1;
    min-width: 0;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 0;
}

.main-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
}

.nav-btn {
    width: auto !important;
    height: auto !important;
}

.nav-btn img {
    width: 100%;
    height: 100%;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));
}

@media (min-width: 1024px) {
    .nav-section {
        width: 80px;
        height: 80px;
    }
}
</style>
