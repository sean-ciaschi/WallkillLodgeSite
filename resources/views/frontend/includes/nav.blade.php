<nav class="navbar navbar-expand-lg navbar-dark navbar-default">
    <div class="container">
        <a href="{{route('frontend.index')}}">
            <div class="navbar-brand">
                <img id="brand-img" src="{{asset('assets/img/square_compass.png')}}" alt="Masonic Square and Compass"> Wallkill Lodge #627
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
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>