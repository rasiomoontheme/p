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

mix

    .js("resources/js/app.js", "public/js")
    // .js("resources/js/main.min.js", "public/js")
    // .js("resources/js/index.min.js", "public/js")

    //.sass('resources/sass/app.scss', 'public/css');
    //.sass('resources/sass/base.scss','public/css').version();

    // .js([
    //     'public/js/main-src/perfect-scrollbar.min.js',
    //     'public/js/bootstrap-multitabs/multitabs.js',
    //     'public/js/main-src/index.min.js',
    // ],'public/js/main.js')
    /*
    .scripts([
        'public/js/base-src/jquery.min.js',
        'public/js/base-src/bootstrap.js',
    ],'public/js/base.js')
    
    */
   
    .styles([
        "public/css/vendor/bootstrap.min.css",
        "public/css/vendor/materialdesignicons.min.css",
        "public/css/vendor/style.min.css",
    ],'public/css/base.css')
    .version();
