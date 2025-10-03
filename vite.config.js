import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    // preprocess: require('svelte-preprocess')(),
    // compilerOptions: {
    //   compatibility: {
    //     componentApi: 4  // Isso mantém a compatibilidade com a sintaxe antiga
    //   }
    // },
    resolve: {
        alias: {
          $components: '/resources/js/components',
          $lib: '/resources/js/lib',
          $tamplete: '/resources/js/Pages/tamplete',
        },
      },
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
            
        }),
        svelte()
    ],
    
});