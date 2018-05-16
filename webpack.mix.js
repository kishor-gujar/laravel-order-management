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
mix.copy( 'node_modules/admin-lte/plugins/datatables/dataTables.bootstrap4.js', 'resources/assets/js')
    .copy( 'node_modules/admin-lte/plugins/datatables/jquery.dataTables.js', 'resources/assets/js')

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
