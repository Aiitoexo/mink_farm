import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                autumn: {
                    50: '#fdf6f1',
                    100: '#f7e3d5',
                    200: '#ecc5a5',
                    300: '#dea176',
                    400: '#c97d4d',
                    500: '#b45f33',
                    600: '#9b4a28',
                    700: '#803a23',
                    800: '#652f20',
                    900: '#4e251b',
                },
                harvest: {
                    50: '#fcf9eb',
                    100: '#f7edc5',
                    200: '#f0da8b',
                    300: '#e5c14f',
                    400: '#d6a423',
                    500: '#bc8512',
                    600: '#96670e',
                    700: '#734f11',
                    800: '#5c3f13',
                    900: '#4b3314',
                }
            }
        },

    },

    plugins: [forms],
};
