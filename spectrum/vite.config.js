import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path'; // Import path module for alias configuration

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // Alias for your JS files
            'images': path.resolve(__dirname, 'public/images'), // Alias for your images
            'primevue': path.resolve(__dirname, 'node_modules/primevue'),  // New alias for PrimeVue
        },
    },
    server: {
        host: 'localhost',
        port: 8008,
    },
});
