let mix = require('laravel-mix');
const {join} = require("path");

mix.alias({
    '@': join(__dirname, 'resources/js'),
    '@store': join(__dirname, 'resources/js/store'),
    '@components': join(__dirname, 'resources/js/Components'),
    '@api': join(__dirname, 'resources/js/api'),
});

console.log(__dirname);
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/app.js', 'public/build/js').vue();
mix.sass('resources/scss/app.scss','public/build/css/app.build.css')
    .postCss('public/build/css/app.build.css', 'public/build/css/app.css', [
        //
    ]);
