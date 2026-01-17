import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue"
import { wayfinder } from "@laravel/vite-plugin-wayfinder"
import vuetify from "vite-plugin-vuetify"

export default defineConfig({
    plugins: [
        wayfinder(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
        vuetify({autoImport: true}),
    ],
    server: {
        host: true,
        hmr: {
            host: "localhost",
        },
    },
});
