const mix = require('laravel-mix');
const {vue} = require('laravel-mix');
/*
|----------------------------------------
|Mix Asset Management
|----------------------------------------
|
|Mix provides a clean, fluent API for defining some webpack build steps
|for your Laravel applications. By default, we are compiling the css
|file for the application as well as Bundling up all the JS files,
|
*/

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
