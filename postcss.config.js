export default {
    plugins: {
        'tailwindcss/nesting': {},
        tailwindcss: {
            content: [
                './resources/**/*.{php,vue}',
            ],
        },
        autoprefixer: {},
        cssnano: {},
    },
};
