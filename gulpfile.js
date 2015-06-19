var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
  'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/'
}

elixir(function(mix) {
    mix.sass('styles.scss',
             'public/css/',
             { includePaths: [paths.bootstrap + 'stylesheets/'] });
    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts');
});
