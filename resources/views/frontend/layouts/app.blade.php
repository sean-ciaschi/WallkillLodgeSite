<!doctype html>
<html lang='{{ app()->getLocale() }}'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name='description' content='@yield('meta_description', 'Wallkill Lodge #627 was established in 1866 and continues to serve the community ')'>
        <meta name='author' content='@yield('meta_author', 'Sean Ciaschi')'>
        @yield('meta')

        <!-- Styles -->
        <link rel='icon' href='{{asset('favicon.ico')}}' type='image/icon'>
        @yield('before-styles')
        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else
            {{ Html::style(mix('css/frontend.css')) }}
        @endif

        @yield('after-styles')
        <link href='{{asset('build/plugins/select2/select2.min.css')}}' rel='stylesheet'>
        <link href='{{asset('build/plugins/fullcalendar/fullcalendar.css')}}' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css' />
        <link href='{{asset('assets/css/jquery-ui.min.css')}}' rel='stylesheet'>
        <link href='{{asset('assets/css/bootstrap.min.css')}}' rel='stylesheet'>
        <!-- Material Design Bootstrap -->
        <link href='{{asset('assets/css/mdbpro.min.css')}}' rel='stylesheet'>
        <!-- Your custom styles (optional) -->
        <link href='{{asset('assets/css/main.css')}}' rel='stylesheet'>

        <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
        @yield('head_js')

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id='app-layout'>
        <div id='app'>
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')

            @yield('before_content')

            <div class='container-fluid'>
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!--#app-->
        <!--Footer-->
        <footer class="page-footer stylish-color-dark">
            <!--Footer Links-->
            <div class="container">
                <!-- Footer links -->
                <div class="row text-center text-md-left mt-3 pb-3">
                    <!--First column-->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="title mb-4 font-bold">Wallkill Lodge #627</h6>
                        <p>Making good men, better men</p>
                    </div>
                    <!--/.First column-->

                    <hr class="w-100 clearfix d-md-none">

                    <!--Second column-->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="title mb-4 font-bold">Our Site</h6>
                        <p><a href="{{route('frontend.index')}}">Home</a></p>
                        <p><a href="{{route('frontend.calendar')}}">Events</a></p>
                        <p><a href="{{route('frontend.trestle-board.index')}}">Trestle Board</a></p>
                        <p><a href="{{route('frontend.gallery.albums')}}">Gallery</a></p>
                        <p><a href="{{route('frontend.ticket-sales')}}">Ticket Sales</a></p>
                    </div>
                    <!--/.Second column-->

                    <hr class="w-100 clearfix d-md-none">

                    <!--Fourth column-->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="title mb-4 font-bold">Contact</h6>
                        <p><i class="fa fa-home mr-3"></i><a class='link-text' href='https://maps.google.com/maps?daddr=61 Main St Walden, New York'>61 Main St Walden, New York</a></p>
                        <p><i class="fa fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fa fa-phone mr-3"></i> +1 845-123-4567</p>
                        <p><i class="fa fa-print mr-3"></i> +1 845-123-4567</p>
                    </div>
                    <!--/.Fourth column-->

                </div>
                <!-- Footer links -->

                <hr>

                <div class="row py-3 d-flex align-items-center">
                    <div class="col">
                        <!--Copyright-->
                        <p class="text-center text-md-left grey-text">© 2017 Copyright: <a href="https://www.wallkill627.com"><strong>Wallkill Lodge #627</strong></a></p>
                        <!--/.Copyright-->
                    </div>

                    <!--Grid column-->
                    <div class="col">
                        <!--Social buttons-->
                        <div class="social-section text-center text-md-left">
                            <ul>
                                <li><a class="btn-floating btn-sm rgba-white-slight mr-xl-4" href="https://www.facebook.com/Wallkill627/"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                        <!--/.Social buttons-->
                    </div>
                    <!--Grid column-->

                    <div class="col">
                        <ul>
                            <li>Developed by Bro. Sean Ciaschi</li>
                            <li><a href='https://nymasons.org/site/'>Grand Lodge of New York</a></li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        @yield('before-scripts')
        {!! Html::script(mix('js/frontend.js')) !!}
        <script src='{{asset('build/plugins/fullcalendar/moment.min.js')}}'></script>
        <script src='{{asset('assets/js/jquery-ui.min.js')}}'></script>
        <script src='{{asset('build/plugins/select2/select2.min.js')}}'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js'></script>
        <!-- Bootstrap tooltips -->
        <script type='text/javascript' src='{{asset('assets/js/popper.min.js')}}'></script>

        <!-- MDB core JavaScript -->
        <script type='text/javascript' src='{{asset('assets/js/mdbpro.min.js')}}'></script>
        <script src='{{asset('build/plugins/fullcalendar/fullcalendar.min.js')}}'></script>

        <script src='{{asset('assets/js/validator.min.js')}}'></script>
        @yield('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>