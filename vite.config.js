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
        outDir: 'public/build', // ビルド出力先
        assetsDir: '', // アセットを`.vite`ディレクトリではなく直下に配置
        rollupOptions: {
            input: {
                app: 'resources/js/app.js', // メインのエントリーファイル
                styles: 'resources/sass/app.scss', // SCSSファイル
            },
            output: {
                entryFileNames: '[name]-[hash].js',
                assetFileNames: '[name]-[hash][extname]',
            },
        },
    },
});
