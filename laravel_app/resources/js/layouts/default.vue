<script setup lang="ts">
import AppHeader from "@/components/AppHeader.vue";
import magnify from "@/assets/vectors/magnify.svg"
import SearchSheet from "@/components/SearchSheet.vue";
import {ref} from "vue";

const showSearch = ref(false)
</script>

<template>
    <v-app class="bg-background">
        <AppHeader />

        <v-fab
            app
            icon
            size="large"
            color="primary"
            @click="showSearch = true"
        >
            <v-img
                :src="magnify"
                style="filter: invert(1)"
                width="24px"
                height="24px"
            />
        </v-fab>
        <SearchSheet v-model="showSearch" />

        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
