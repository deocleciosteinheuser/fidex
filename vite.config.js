import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'
export default defineConfig(({ command }) => {
    const isProduction = command === 'build';

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                ],
                refresh: true,
            })
        ],
        optimizeDeps: {
            include: ['resources/js/jquery.js'],
        },
        build: {
            minify: isProduction,
            rollupOptions: {
                output: {
                    globals: {
                        jquery: 'resources/js/jquery.js',
                    },
                },
            },
            commonjsOptions: {
                include: ['resources/js/jquery.js'],
            },
        },
        resolve: {
            alias: {
                '@': '/resources/js',
                '~jquery': path.resolve(__dirname, 'node_modules/jquery') ,
                '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
                '~bootstrap-table': path.resolve(__dirname, 'node_modules/bootstrap-table'),
                '~bootstrap-select': path.resolve(__dirname, 'node_modules/bootstrap-select'),
                '~bootstrap-select-plus': path.resolve(__dirname, 'node_modules/bootstrap-select-plus'),
                '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons'),

            }
        },

    }
});
