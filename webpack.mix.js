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
    .sass("resources/sass/toastr.scss", "public/css");

mix.js("resources/asset/system/js/system.js", "public/compiledCssAndJs/js/")
    .js("resources/asset/system/js/dashboard.js", "public/compiledCssAndJs/js/")
    .js(
        "resources/asset/system/js/transaction.js",
        "public/compiledCssAndJs/js/"
    )
    .js(
        "resources/asset/system/js/transaction_og.js",
        "public/compiledCssAndJs/js/"
    )
    .js("resources/asset/system/js/bill.js", "public/compiledCssAndJs/js/")
    .js(
        "resources/asset/system/js/nepali-date.js",
        "public/compiledCssAndJs/js/"
    )
    .js(
        "resources/asset/system/js/frontend/dashboard",
        "public/compiledCssAndJs/js/frontend"
    )
    .sass(
        "resources/asset/system/styles/system.scss",
        "public/compiledCssAndJs/css"
    )
    .options({
        processCssUrls: false
    });
