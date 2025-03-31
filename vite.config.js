import path from 'node:path'
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import autoprefixer from 'autoprefixer'
import tailwind from 'tailwindcss'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/base.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    css: {
        postcss: {
            plugins: [tailwind(), autoprefixer()],
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '@views': path.resolve(__dirname, 'resources/js/views'),
            '@assets': path.resolve(__dirname, 'resources/assets'),
            '@scss': path.resolve(__dirname, 'resources/scss'),
            '@controllers': path.resolve(__dirname, 'resources/js/controllers'),
        },
    },
})
