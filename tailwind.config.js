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
                entering: "fadeIn 0.3s ease-out forwards",
            },
            keyframes: {
                fadeIn: {
                    "0%": {
                        opacity: "0",
                        transform: "translateY(16px)",
                    },
                    "100%": {
                        opacity: "1",
                        transform: "translateY(0)",
                    },
                },
            },
        },
    },
    plugins: [
        forms,
        function ({ addUtilities }) {
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
