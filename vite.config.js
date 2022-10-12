import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/responsive.scss',
                'resources/css/admin.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
