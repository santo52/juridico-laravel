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

mix.webpackConfig({
    optimization: {
        minimize: true
    }
})

mix.babel([
        'resources/js/global/index.js',
        'resources/js/global/functions.js'
    ], 'public/js/app.js')
    .babel('resources/views/**/*.blade.js', 'public/js/modules.js')
    .sass('resources/sass/app.scss', 'public/css');
