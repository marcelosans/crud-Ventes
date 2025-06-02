import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            // Asegúrate de que tus librerías están correctamente resueltas
            'dropzone': 'node_modules/dropzone/dist/dropzone.js',
            'lodash': 'node_modules/lodash/lodash.js',
        },
    },
});
