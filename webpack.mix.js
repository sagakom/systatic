var tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'dist/js')
   .postCss('resources/css/app.css', 'dist/css', [
        tailwindcss('./tailwind.js'),
    ]);