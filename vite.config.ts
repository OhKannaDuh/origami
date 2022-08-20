import { defineConfig } from 'vite'
import laravel from 'vite-plugin-laravel'
import vue from '@vitejs/plugin-vue'
import inertia from './resources/ts/vite/inertia-layout'
import { quasar } from '@quasar/vite-plugin'

export default defineConfig({
    plugins: [
        inertia(),

        vue({}),

        laravel({}),

        quasar({})
    ],
})
