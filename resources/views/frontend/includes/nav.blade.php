<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
                <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{{route('frontend.index')}}">
                <div class="navbar-brand">
                    <img id="brand-img" src="http://www.newjerseygrandlodge.org/images/Square_And_Compass.png"> Wallkill Lodge #627
                </div>
            </a>
        </div><!--navbar-header-->

        <div class="collapse navbar-collapse" id="frontend-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="{{route('frontend.index')}}">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li class="">
                    <a href="{{route('frontend.calendar')}}">
                        <i class="fa fa-calendar"></i> Events
                    </a>
                </li>
                <li class="">
                    <a href="{{route('frontend.trestle-board.index')}}">
                        <i class="fa fa-book"></i> Trestle Board
                    </a>
                </li>
                <li class="">
                    <a href="{{route('frontend.gallery.albums')}}">
                        <i class="fa fa-image"></i> Gallery
                    </a>
                </li>
                <li class="">
                    <a href="{{route('frontend.ticket-sales')}}">
                        <i class="fa fa-ticket"></i> Ticket Sales
                    </a>
                </li>
                <li class="">
                    <a href="">
                        <i class="fa fa-question-circle"></i> FAQ
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!$logged_in_user)
                    <li>{{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => active_class(Active::checkRoute('frontend.auth.login')) ]) }}</li>

                    {{--@if (config('access.users.registration'))--}}
                        {{--<li>{{ link_to_route('frontend.auth.register', trans('navs.frontend.register'), [], ['class' => active_class(Active::checkRoute('frontend.auth.register')) ]) }}</li>--}}
                    {{--@endif--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ $logged_in_user->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @permission('view-backend')
                                <li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
                            @endauth
                            <li>{{ link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => active_class(Active::checkRoute('frontend.user.account')) ]) }}</li>
                            <li>{{ link_to_route('frontend.auth.logout', trans('navs.general.logout')) }}</li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>