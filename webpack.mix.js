const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/home.js', 'public/js')
    .sass('resources/sass/home.scss', 'public/css')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css')
    .js('resources/js/search.js', 'public/js')
    .sass('resources/sass/search.scss', 'public/css');