import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/css/main.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
