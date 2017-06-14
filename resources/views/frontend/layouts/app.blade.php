<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else
            {{ Html::style(mix('css/frontend.css')) }}
        @endif

        @yield('after-styles')

        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('build/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="app-layout">
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')

            @yield('before_content')

            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!--#app-->

        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 footer-opts">
                        <ul class="contact-list fa-ul">
                            <span class="contact-text col-md-8 col-sm-12 col-xs-12">Contact Us</span>
                            <li class="col-md-12 col-xs-12">
                                <i class="fa-li fa fa-envelope fa-lg"></i> <a class="link-text text-muted" onclick="window.open(this.href,'_blank');return false;" href="mailto:sciaschi1@gmail.com">Email us</a>
                            </li>
                            <li class="col-md-12 col-xs-12">
                                <i class="fa-li fa fa-phone fa-lg"></i> (845) 888-8888
                            </li>
                            <li class="col-md-12 col-xs-12">
                                <i class="fa-li fa fa-location-arrow fa-lg"></i> <a class="link-text text-muted" href="http://maps.google.com/maps?daddr=61 Main St Walden, New York">61 Main St Walden, New York</a>
                            </li>
                        </ul>
                        <ul class="contact-list fa-ul">
                            <span class="contact-text col-md-8 col-sm-12 col-xs-12">Follow Us</span>
                            <li class="col-md-12 col-sm-12 col-xs-12">
                                <i class="fa-li fa fa-facebook fa-lg"></i> <a class="link-text text-muted" onclick="window.open(this.href,'_blank');return false;" href="mailto:sciaschi1@gmail.com">Facebook</a>
                            </li>
                            <li class="col-md-12 col-sm-12 col-xs-12">
                                <i class="fa-li fa fa-twitter fa-lg"></i> <a class="link-text text-muted" onclick="window.open(this.href,'_blank');return false;" href="mailto:sciaschi1@gmail.com">Twitter</a>
                            </li>
                            <li class="col-md-12 col-sm-12 col-xs-12">
                                <i class="fa-li fa fa-location-arrow fa-lg"></i> <a class="link-text text-muted" href="http://maps.google.com/maps?daddr=61 Main St Walden, New York">61 Main St Walden, New York</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <p class="navbar-text pull-right">
                            <span class="developer-text">Developed by Brother Sean Ciaschi</span>
                        </p>
                    </div>

                </div>
            </div>

        <!-- Scripts -->
        @yield('before-scripts')
        {!! Html::script(mix('js/frontend.js')) !!}
        <script src="{{asset('build/plugins/fullcalendar/moment.min.js')}}"></script>
        <script src="{{asset('build/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
        <script src="{{asset('build/plugins/fullcalendar/gcal.min.js')}}"></script>
        @yield('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>