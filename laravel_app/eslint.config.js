import pluginVue from "eslint-plugin-vue"
import {defineConfigWithVueTs, vueTsConfigs} from "@vue/eslint-config-typescript"
import stylistic from "@stylistic/eslint-plugin"

export default defineConfigWithVueTs(
    pluginVue.configs["flat/essential"],
    vueTsConfigs.recommended,
    {
        rules: {
            "vue/multi-word-component-names": "off",
        },
    },
    { // stylistic configs
        plugins: {
            "@stylistic": stylistic,
        },
        rules: {
            "@stylistic/indent": ["error", 4],
            "@stylistic/comma-dangle": ["error", "always-multiline"],
            "@stylistic/quotes": ["error", "double"],
        },
    },
    {
        ignores: [
            "vendor/**",
            "public/**",
            "resources/js/{actions,routes,wayfinder}/**",
        ],
    },
)
