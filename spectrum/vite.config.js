import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@use 'bootstrap/scss/functions' as *; @use 'bootstrap/scss/variables' as *; @use 'bootstrap/scss/mixins' as *;`,
            },
        },
    },
});
