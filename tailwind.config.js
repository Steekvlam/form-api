const colors = require("tailwindcss/colors");
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        // prettier-ignore
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
            padding: '1rem'
        },
        extend: {
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
