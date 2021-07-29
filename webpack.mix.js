const mix = require('laravel-mix');
const fs = require('fs')
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
    //.babel('resources/views/**/*.blade.js', 'public/js/modules.js')
    .babel(recursiveRoutes("resources/views"), 'public/js/modules.js')
    .sass('resources/sass/app.scss', 'public/css');

function recursiveRoutes(folderName) {
    const basePath = !folderName.includes(__dirname)
        ? path.join(__dirname, folderName)
        : folderName;

    return fs.readdirSync(basePath).reduce((initial, file) => {
        const fullName = path.join(basePath, file);
        const stat = fs.lstatSync(fullName);
        if (stat.isDirectory()) {
            const res = recursiveRoutes(fullName);
            return [...initial, ...res]
        }

        if(!file.includes('.blade.js')) return initial
        return initial.concat([fullName])
    }, [])
}
