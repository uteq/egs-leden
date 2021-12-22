const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

colors.persianRed = {
    '50': '#fcf4f5',
    '100': '#fae8ea',
    '200': '#f1c6cb',
    '300': '#e9a4ab',
    '400': '#d9606d',
    '500': '#c81c2e',
    '600': '#b41929',
    '700': '#961523',
    '800': '#78111c',
    '900': '#620e17'
}
colors.primary = colors.persianRed;

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: colors,

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
};
