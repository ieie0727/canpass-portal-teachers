import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build', // ビルド出力先を指定
        rollupOptions: {
            input: {
                app: 'resources/js/app.js', // エントリーファイル
            },
        },
    },
});
