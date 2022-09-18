const mix = require('laravel-mix');
require('mix-env-file');
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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
mix.js('resources/js/listen.js', 'public/js',[
    require('laravel-echo'),
    require('pusher-js')
])
// mix.scripts([
//     'resources/js/listen.js'
// ], 'public/js/listen.js',require('laravel-echo'),
// require('pusher-js') )

mix.env(process.env.ENV_FILE);
