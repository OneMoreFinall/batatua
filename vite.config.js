import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/home.js',
                'resources/js/contact.js',
                'resources/js/menuPage.js',
                'resources/js/adminDashboard.js',
                'resources/js/adminMenu.js',
            ],
            refresh: true,
        }),
    ],
});
