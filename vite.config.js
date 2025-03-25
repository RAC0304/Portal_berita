import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/navbar.js",
                "resources/js/index.js",
                "resources/js/create.js",
                "resources/js/edit.js",
                "resources/css/show.css",
                "resources/css/navbar.css",
                "resources/css/index.css",
                "resources/css/create.css",
                "resources/css/edit.css",
                "resources/css/beranda.css",
            ],
            refresh: true,
        }),
    ],
});
