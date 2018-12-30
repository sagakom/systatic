let tailwindcss = require('tailwindcss');
let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'dist/js')
   .postCss('resources/css/app.css', 'dist/css', [
        tailwindcss('./tailwind.js'),
    ]);