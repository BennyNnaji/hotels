import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#8C6E63', // Primary
                accent: '#C4A484',      // Accent
                secondary: '#5A6D57', // Highlight
                // Add more colors if needed
            },
        },
    },

    plugins: [forms,
        require('tailwindcss-elevation'),

    ],
};
