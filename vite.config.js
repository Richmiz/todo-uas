import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// This configuration file is used to set up Vite for a Laravel project.
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
