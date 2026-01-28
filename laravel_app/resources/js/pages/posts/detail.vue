<script lang="ts">
import DetailLayout from "@/layouts/DetailLayout.vue";
export default {
    layout: DetailLayout
}
</script>

<script setup lang="ts">
import PostDetail from "@/components/PostDetail.vue";

// デモデータ
const demoText = Array(450).fill("TEXT").join("")
const demoData = {
    id: 1,
    title: "OLUNA - デモ投稿タイトル",
    text: "これはデモ投稿の本文です。\n\n複数行にわたるテキストコンテンツをここに表示します。\n\n実際のアプリケーションでは、データベースから取得した記事の内容がここに表示されます。" + demoText,
    thumbnail: "https://picsum.photos/800/450?random=4",
    tags: ["t", "te", "tes","test", "testt", "testtt","testttt", "testtttt", "testttttt","testtttttt", "testttttttt", "testtttttttt"],
    likes: 42,
    images: [
        "https://picsum.photos/800/450?random=1",
        "https://picsum.photos/800/450?random=2",
        "https://picsum.photos/800/450?random=3"
    ]
}
</script>

<template>
    <div>
        <PostDetail :data="demoData" />
    </div>
</template>

<style scoped>
    
</style>
