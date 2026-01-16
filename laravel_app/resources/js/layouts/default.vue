<script setup lang="ts">
import AppHeader from "@/components/AppHeader.vue";
</script>

<template>
    <v-app class="bg-background">
        <AppHeader />

        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
