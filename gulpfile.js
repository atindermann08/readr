var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
      .copy("bower_components/font-awesome/css/font-awesome.min.css", "public/vendor/css/font-awesome.min.css")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.eot", "public/vendor/fonts/fontawesome-webfont.eot")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.svg", "public/vendor/fonts/fontawesome-webfont.svg")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.ttf", "public/vendor/fonts/fontawesome-webfont.ttf")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.woff", "public/vendor/fonts/fontawesome-webfont.woff")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.woff2", "public/vendor/fonts/fontawesome-webfont.woff2")
      .copy("bower_components/font-awesome/fonts/FontAwesome.otf", "public/vendor/fonts/FontAwesome.otf")
      .copy("bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js", "public/vendor/js/bootstrap.min.js")
      .copy("bower_components/jquery/dist/jquery.min.js", "public/vendor/js/jquery.min.js")
      .copy(
          'public/*',
          '../public_html/'
        );
});
