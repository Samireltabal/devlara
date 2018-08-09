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


mix.combine([
             'resources/assets/admin/bower_components/jquery/dist/jquery.min.js',
             'resources/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js',
             'resources/assets/admin/dist/js/adminlte.min.js',
             'resources/assets/admin/plugins/iCheck/icheck.min.js',
             'node_modules/chart.js/dist/Chart.min.js',
             'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
             'node_modules/izitoast/dist/js/iziToast.min.js',
             'node_modules/jsbarcode/dist/barcodes/JsBarcode.code128.min.js',
             'node_modules/jquery-ui-dist/jquery-ui.js',
             'resources/assets/js/custom.js',


             ],'public/admin/app.js');
mix.styles([
         'resources/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css',
         'resources/assets/admin/bower_components/font-awesome/css/font-awesome.min.css',
         'resources/assets/admin/bower_components/Ionicons/css/ionicons.min.css',
         'resources/assets/admin/dist/css/AdminLTE.min.css',
         'resources/assets/admin/plugins/iCheck/square/green.css',
         'resources/assets/admin/dist/css/skins/skin-green.min.css',
         'node_modules/jquery-ui-dist/jquery-ui.css',
         'node_modules/jquery-ui-dist/jquery-ui.structure.min.css',
         'node_modules/jquery-ui-dist/jquery-ui.theme.min.css',
         'node_modules/izitoast/dist/css/iziToast.min.css',
         'resources/assets/css/custom.css',

           ],'public/admin/app.css');

mix.styles([
         'resources/assets/rtl/bootstrap.min.css',
         'resources/assets/rtl/bootstrap-rtl.min.css',
         'resources/assets/admin/bower_components/font-awesome/css/font-awesome.min.css',
         'resources/assets/admin/bower_components/Ionicons/css/ionicons.min.css',
         'resources/assets/rtl/AdminLTE.min.css',
         'resources/assets/rtl/rtl.css',
         'resources/assets/rtl/profile.css',
         'resources/assets/admin/plugins/iCheck/square/green.css',
         'node_modules/izitoast/dist/css/iziToast.min.css',
         'node_modules/jquery-ui-dist/jquery-ui.css',
         'node_modules/jquery-ui-dist/jquery-ui.structure.min.css',
         'node_modules/jquery-ui-dist/jquery-ui.theme.min.css',
         'resources/assets/rtl/skin-green.min.css',
         'resources/assets/css/custom.css',
                      ],'public/admin/app-rtl.css');

mix.styles([
      'resources/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css',
      'resources/assets/css/print.css',
], 'public/admin/print.css');              
