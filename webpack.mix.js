let mix = require('laravel-mix');

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


mix.copy('resources/assets/css/bootstrap.min.css', 'public/css/bootstrap.min.css');
mix.copy('resources/assets/css/style.css', 'public/css/style.css')

mix.copy('resources/assets/js/jquery-3.3.1.slim.min.js', 'public/js/jquery-3.3.1.slim.min.js');
mix.copy('resources/assets/js/popper.min.js', 'public/js/popper.min.js');

mix.copyDirectory('resources/assets/imgs', 'public/imgs');
mix.copyDirectory('resources/assets/font', 'public/font');



mix.js('resources/assets/js/bootstrap.js', 'public/js/bootstrap.js')
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
