export default {
    plugins: {
        tailwindcss: {
            purge: [
                './resources/**/*.{php,vue}',
            ],
        },
        autoprefixer: {},
        'postcss-nesting': {},
        cssnano: {},
    },
};
