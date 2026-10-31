import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    resolve: {
        alias: {
        $components: '/resources/js/components',
        $lib: '/resources/js/lib',
        $site: '/resources/js/Pages/site',
        $admin: '/resources/js/Pages/admin',
        $master: '/resources/js/Pages/master',
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        svelte(),
    ],
    optimizeDeps: {
        exclude: ['@inertiajs/svelte']
    }
});