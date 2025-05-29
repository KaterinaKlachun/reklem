import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

const isProduction = process.env.NODE_ENV === 'production';
const baseUrl = isProduction ? 'https://reklem.onrender.com' : 'http://localhost';

export default defineConfig({
    base: '/build/',

    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
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
        manifest: true,
        outDir: 'public/build',
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
            'ziggy': path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/index.esm.js'),
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
