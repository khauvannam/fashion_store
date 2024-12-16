import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

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
            animation: {
                loadingBorder: "loading-border 3s linear forwards",
                'loading-border': 'loading-border 3s linear forwards',
                'fade-in': 'fade-in 0.5s ease-in forwards',
                'fade-out': 'fade-out 0.5s ease-out forwards',
            },
            keyframes: {
                'loading-border': {
                    '0%': {width: '0'},
                    '100%': {width: '100%'},
                },
                'fade-in': {
                    '0%': {opacity: '0'},
                    '100%': {opacity: '1'},
                },
                'fade-out': {
                    '0%': {opacity: '1'},
                    '100%': {opacity: '0'},
                },
            },
        },
    },
    plugins: [
        forms,
        function ({addUtilities}) {
            addUtilities({
                ".no-spinner": {
                    "-webkit-appearance": "textfield",
                    "-moz-appearance": "textfield",
                    appearance: "textfield",
                },
                ".no-spinner::-webkit-inner-spin-button, .no-spinner::-webkit-outer-spin-button":
                    {
                        "-webkit-appearance": "none",
                        margin: "0",
                    },
            });
        },
    ],
};
