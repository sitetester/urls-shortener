import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import vue from '@vitejs/plugin-vue'; //  We need import plugin that we just installed to use Vue in our app
import DefineOptions from 'unplugin-vue-define-options/vite'

export default defineConfig({
    plugins: [
        vue(),
        DefineOptions(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
