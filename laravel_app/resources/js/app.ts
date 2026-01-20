import {createInertiaApp} from "@inertiajs/vue3";
import {createApp, DefineComponent, h} from "vue"
import {createVuetify} from "vuetify";
import Default from "@/layouts/default.vue";
import "vuetify/styles"
import "@mdi/font/css/materialdesignicons.min.css"

await createInertiaApp({
    resolve(name) {
        const pages = import.meta.glob<DefineComponent>("./pages/**/*.vue", {eager: true})
        const page = pages[`./pages/${name}.vue`]
        page.default.layout = page.default.layout || Default
        return page
    },
    setup({ el, App, props, plugin }) {
        const vuetify = createVuetify({
            theme: {
                defaultTheme: "light",
                themes: {
                    light: {
                        colors: {
                            background: "#FFCB50",
                            primary: "#8C6057",
                        },
                    },
                },
            },
        })
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .mount(el)
    },
})
