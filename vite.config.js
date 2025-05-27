import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    base: '/build/', // важно для корректной работы ссылок в продакшене

    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/Pages/**/*.vue'
            ],
            refresh: true,
            buildDirectory: 'build',
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        outDir: 'public/build', // куда складывается прод-результат
        manifest: true,
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'resources/js/app.js'),
            },
            output: {
                manualChunks: {
                    'vendor': ['vue', '@inertiajs/vue3'],
                },
            },
        },
        assetsDir: 'assets',
        emptyOutDir: true,
    },
    server: {
        proxy: {
            '/api': 'http://localhost:8000',
        },
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '~fonts': path.resolve(__dirname, 'public/assets/font'),
            'ziggy': path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/vue.es.js'),
        }
    },
    optimizeDeps: {
        include: [
            'vue',
            '@inertiajs/vue3',
            'ziggy',
        ],
    },
});
