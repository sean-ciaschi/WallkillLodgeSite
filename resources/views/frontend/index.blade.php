@extends('frontend.layouts.app')

@section('before_content')
    @notmobile()
    <!-- Full Page Image Background Carousel Header -->
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <!-- Set the first background image using inline CSS below. -->
                <img class="d-block w-100" src ="https://scontent-iad3-1.xx.fbcdn.net/v/t1.0-9/1891243_377317762424096_374112220093852261_n.jpg?oh=b7fa15214c96d6fd6c900ed295ae7194&oe=59E6A8DF"
                        style=""/>
            </div>
            <div class="carousel-item">
                <!-- Set the second background image using inline CSS below. -->
                <img class="d-block w-100" src ="https://scontent-iad3-1.xx.fbcdn.net/v/t1.0-9/10450796_361168124039060_3023797322292611501_n.jpg?oh=6169a0c3394f5b75e7b1a8fe90f1d74d&oe=59E5369BF"/>
            </div>
            <div class="carousel-item">
                <!-- Set the third background image using inline CSS below. -->
                <img class="d-block w-100" src ="https://scontent-iad3-1.xx.fbcdn.net/v/t1.0-9/62493_130922827063592_815700082_n.png?oh=d41dc470cb715c852f74561e27b1950c&oe=59EA85B2"/>
            </div>
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
    @endnotmobile
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 well">
            <div class="lodge-officer-header">
                <h2>2017-2018 Lodge Officers</h2>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Worshipful Master:. Bob Agazzi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Senior Warden:. Sean McMorris</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Junior Warden:. Nick Iacovitti</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Secretary:. Collin Oakinforth</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Treasurer:. George Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Senior Deacon:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Junior Deacon:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Marshal:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Tiler:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Chaplain:. Jose Ithier</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Steward:. Sean Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px; align:center;">
                <h3>Steward:.</h3>
            </div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts')
    <script>
        $('.carousel').carousel({
            interval: 6000,
            pause: "false"
        });
    </script>
@endsection