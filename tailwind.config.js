/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    dark: '#40513B',
                    green: '#609966',
                    soft: '#9DC08B',
                    mint: '#bcead5',
                }
            }
        },
    },
    plugins: [],
};