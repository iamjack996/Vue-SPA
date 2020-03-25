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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    './node_modules/vue/dist/vue.js',
    './node_modules/axios/dist/axios.min.js',
], 'public/js/vue.js');

// mix.scripts([
//     './node_modules/socket.io/lib/socket.js',
// ], 'public/js/socket.js');

mix.copy('node_modules/socket.io', 'public/js/socket.io');
mix.copy('node_modules/socket.io-adapter', 'public/js/socket.io-adapter');
mix.copy('node_modules/socket.io-client', 'public/js/socket.io-client');
mix.copy('node_modules/socket.io-parser', 'public/js/socket.io-parser');
mix.copy('node_modules/sockjs', 'public/js/sockjs');
mix.copy('node_modules/sockjs-client', 'public/js/sockjs-client');
