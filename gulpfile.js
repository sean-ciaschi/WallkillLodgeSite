var elixir = require('laravel-elixir');

elixir(function(mix)
{
    mix

    .copy(
        'node_modules/font-awesome/fonts',
        'public/build/fonts/font-awesome'
    )
    .copy(
        'node_modules/bootstrap-sass/assets/fonts/bootstrap',
        'public/build/fonts/bootstrap'
    )
    .copy(
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'public/js/vendor/bootstrap'
    )
    .copy(
        'node_modules/fullcalendar/dist',
        'public/build/plugins/fullcalendar'
    )
    .copy(
        'node_modules/moment/min/moment.min.js',
        'public/build/plugins/fullcalendar'
    )

});