let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'dist/js')
   .postCss('resources/css/app.css', 'dist/css', [
        tailwindcss('./tailwind.js'),
    ]).purgeCss({
        enabled: true,
        extensions: ['html', 'md', 'js', 'php', 'vue']
    });