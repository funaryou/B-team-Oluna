<script setup lang="ts">
import AppHeader from "@/components/AppHeader.vue";
import magnify from "@/assets/vectors/magnify.svg"
</script>

<template>
    <v-app class="bg-background">
        <AppHeader />

        <v-fab
            app
            icon
            size="large"
            color="primary"
        >
            <v-img
                :src="magnify"
                style="filter: invert(1)"
                width="24px"
                height="24px"
            />
        </v-fab>

        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
