import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                figtree: ['Figtree', ...defaultTheme.fontFamily.sans],
                motter: ['Motter Corpus', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // brown: '#a52a2a',
                brown: 'rgb(246 92 61)',
                accent: 'rgb(246 92 61)',
                background: 'rgb(101 9 89)',
            },
        },
    },

    plugins: [forms, typography],
};
