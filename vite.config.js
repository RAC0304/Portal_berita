import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/navbar.css",
                "resources/js/navbar.js",
                "resources/css/index.css",
                "resources/js/index.js",
                "resources/css/create.css",
                "resources/js/create.js",
                "resources/css/edit.css",
                "resources/js/edit.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
