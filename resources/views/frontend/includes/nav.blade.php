<nav class="navbar navbar-expand-lg navbar-dark navbar-default">
    <div class="container">
        <a href="{{route('frontend.index')}}">
            <div class="navbar-brand">
                <img id="brand-img" src="{{asset('assets/img/square_compass.png')}}"> Wallkill Lodge #627
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frontend-navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="frontend-navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.index')}}">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.calendar')}}">
                        <i class="fa fa-calendar"></i> Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.trestle-board.index')}}">
                        <i class="fa fa-book"></i> Trestle Board
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.gallery.albums')}}">
                        <i class="fa fa-image"></i> Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.ticket-sales')}}">
                        <i class="fa fa-ticket"></i> Ticket Sales
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="">--}}
                        {{--<i class="fa fa-question-circle"></i> FAQ--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!$logged_in_user)
                    <li class="nav-item">
                        {{ link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => active_class(Active::checkRoute('frontend.auth.login')) ]) }}</li>

                    {{--@if (config('access.users.registration'))--}}
                        {{--<li>{{ link_to_route('frontend.auth.register', trans('navs.frontend.register'), [], ['class' => active_class(Active::checkRoute('frontend.auth.register')) ]) }}</li>--}}
                    {{--@endif--}}
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>
                        <div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdownMenuLink">
                            @permission('view-backend')
                                {{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) , [], ['class' => 'dropdown-item' ]}}
                            @endauth
                            {{ link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => active_class(Active::checkRoute('frontend.user.account')) . ' dropdown-item' ]) }}
                            {{ link_to_route('frontend.auth.logout', trans('navs.general.logout')), [], ['class' => 'dropdown-item'] }}
                        </div>
                    </li>
                @endif
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>