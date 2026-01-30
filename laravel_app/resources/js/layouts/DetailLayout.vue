<script setup lang="ts">
import AppHeader from "@/components/AppHeader.vue";
</script>

<template>
    <v-app class="bg-white">
        <AppHeader />

        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
