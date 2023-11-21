import defaultColors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
    ],
    theme: {
        colors: {
            // tailwindcss colors
            ...defaultColors,

            // Primer Contacto
            'vegas-gold': "#BFA758",
            'blue-green': "#11484A",
            'verdigris': "#40B6AA",
            'tangerine-yellow': "#FDCE00",
            'philippine-silver': "#B3B3B3",
            'bright-gray': "#EDEEED",

        },
        extend: {},
    },
};
