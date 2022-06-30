import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/assets/css/app.css',
            'resources/assets/js/app.js',
        ]),
    ],
});
