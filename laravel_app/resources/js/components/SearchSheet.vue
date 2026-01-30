<script setup lang="ts">
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import {search} from "@/actions/App/Http/Controllers/PostController";

defineProps<{
    modelValue: boolean
}>()

const emit = defineEmits<{
    (e: "update:model-value", value: boolean): void
}>()

const searchText = ref("")

const visitSearchResult = (e: { keyCode: number; }) => {
    if (e.keyCode !== 13) return
    router.visit(search({query: {keyword: searchText.value}}))
    emit("update:model-value", false)
}
</script>

<template>
    <v-bottom-sheet
        :model-value="modelValue"
        @update:model-value="$emit('update:model-value', $event)"
    >
        <v-card rounded="t-xl">
            <template #title>
                <v-text-field
                    v-model="searchText"
                    class="pt-2"
                    label="検索"
                    rounded="pill"
                    variant="outlined"
                    prepend-inner-icon="mdi-magnify"
                    autofocus
                    @keydown.enter="visitSearchResult"
                />
            </template>
        </v-card>
    </v-bottom-sheet>
</template>

<style scoped>

</style>
