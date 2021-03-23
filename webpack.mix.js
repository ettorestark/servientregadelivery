const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/shopify.scss", "public/css")
    .js("resources/js/settings.js", "public/js")
    .js("resources/js/products.js", "public/js")
    .js("resources/js/servientregadelivery-v1.0.js", "public/js");

// disable notifications laravel mix
mix.disableSuccessNotifications();
