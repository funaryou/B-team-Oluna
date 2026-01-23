<script setup lang="ts">
import siteLogo from "@/assets/img/site_logo.png"
import {Link} from "@inertiajs/vue3";
</script>

<template>
<header class="container bg-primary">
    <Link href="/">
        <v-img :src="siteLogo" />
    </Link>
</header>
</template>

<style lang="scss" scoped>
.container {
    position: sticky;
    top: 0;
    z-index: 999;
    height: 60px;
    padding: 8px 0;
    $rounding-radius: 30px;
    border-bottom-right-radius: $rounding-radius;
    border-bottom-left-radius: $rounding-radius;
    box-shadow: 0 5px 5px rgb(#000000, 25%);
}
</style>
