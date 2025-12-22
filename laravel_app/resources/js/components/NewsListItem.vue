<script setup lang="ts">
interface Props {
    title: string
    tags: string[]
    imageUrl: string
}
defineProps<Props>()
</script>

<template>
    <v-card rounded="xl" elevation="8">
        <v-img class="thumb-img" :src="imageUrl" />
        <v-card-subtitle class="d-flex ga-2">
            <span v-for="tag in tags" :key="tag">#{{ tag }}</span>
        </v-card-subtitle>
        <v-card-title class="text-h5">{{ title }}</v-card-title>
    </v-card>
</template>

<style lang="scss" scoped>
@use "vuetify/settings";
@use "sass:map";

.thumb-img {
    $margin: 8px;
    margin: $margin;
    border-radius: calc(map.get(settings.$rounded, "xl") - $margin);
}
</style>
