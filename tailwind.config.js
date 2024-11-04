import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#8C6E63", // Primary
                primaryDark: "#6B4D4B", // Darker Primary
                accent: "#C4A484", // Accent
                accentDark: "#A6836B", // Darker Accent
                secondary: "#5A6D57", // Highlight
                secondaryDark: "#3F4D3C", // Darker Highlight
            },
        },
    },

    plugins: [forms, require("tailwindcss-elevation")],
};
