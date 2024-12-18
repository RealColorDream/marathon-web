import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/normalize.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/css/voyage.css', 'resources/css/auth.css',
                'resources/css/test-vite.css', 'resources/css/profil.css', 'resources/js/test-vite.js'],
            refresh: true,
        }),
    ],
});
