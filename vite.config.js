import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/normalize.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/css/voyage.css', 'resources/css/show-etape.css', 'resources/css/show-voyage.css', 'resources/css/404.css',
                'resources/css/auth.css', 'resources/css/accueil.css', 'resources/css/profil.css'],
            refresh: true,
        }),
    ],
});
