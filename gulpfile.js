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
    mix.sass(['app.scss'], 'public/assets/css')
      .copy("bower_components/font-awesome/css/font-awesome.min.css", "public/assets/vendor/css/font-awesome.min.css")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.eot", "public/assets/vendor/fonts/fontawesome-webfont.eot")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.svg", "public/assets/vendor/fonts/fontawesome-webfont.svg")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.ttf", "public/assets/vendor/fonts/fontawesome-webfont.ttf")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.woff", "public/assets/vendor/fonts/fontawesome-webfont.woff")
      .copy("bower_components/font-awesome/fonts/fontawesome-webfont.woff2", "public/assets/vendor/fonts/fontawesome-webfont.woff2")
      .copy("bower_components/font-awesome/fonts/FontAwesome.otf", "public/assets/vendor/fonts/FontAwesome.otf")
      .copy("bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js", "public/assets/vendor/js/bootstrap.min.js")
      .copy("bower_components/jquery/dist/jquery.min.js", "public/assets/vendor/js/jquery.min.js")
      // .copy("bower_components/select2/dist/js/select2.min.js", "public/vendor/js/select2.min.js")
      .copy("bower_components/select2/dist/js/select2.full.min.js", "public/assets/vendor/js/select2.min.js")
      .copy("bower_components/select2/dist/css/select2.min.css", "public/assets/vendor/css/select2.min.css")
      .copy("bower_components/select2-bootstrap-css/select2-bootstrap.min.css", "public/assets/vendor/css/select2-bootstrap.min.css")
      .copy(
          'public/assets/*',
          '../public_html/assets/'
        );
});
