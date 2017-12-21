@extends('frontend.layouts.app')

@section('before_content')
    @notmobile()

    <!--Carousel Wrapper-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <!--First slide-->
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/carousel_1.jpg" alt="First slide">
            </div>
            <!--/First slide-->
            <!--Second slide-->
            <div class="carousel-item">
                <img class="d-block w-100" src="images/carousel_2.jpg" alt="Second slide">
            </div>
            <!--/Second slide-->
            <!--Third slide-->
            <div class="carousel-item">
                <img class="d-block w-100" src="images/carousel_3.png" alt="Third slide">
            </div>
            <!--/Third slide-->
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
    @endnotmobile
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 well">
            <div class="lodge-officer-header">
                <h2>2017-2018 Lodge Officers</h2>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Worshipful Master:. Bob Agazzi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/sw.jpg')}}" style="width:150px; height:150px; align:center;">
                <h3>Senior Warden:. Sean McMorris</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/jw.jpg')}}" style="width:150px; height:150px; align:center;">
                <h3>Junior Warden:. Nick Iacovitti</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/sec.jpg')}}" style="width:150px; height:150px; align:center;">
                <h3>Secretary:. Collin Oakinforth</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Treasurer:. George Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/sd.jpg')}}" style="width:150px; height:150px; align:center;">
                <h3>Senior Deacon:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/jd.jpg')}}" style="width:150px; height:150px; align:center;">
                <h3>Junior Deacon:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Marshal:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Tiler:.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Chaplain:. Jose Ithier</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Steward:. Sean Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;">
                <h3>Steward:.</h3>
            </div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts')
    <script>
        $('.carousel').carousel();
    </script>
@endsection