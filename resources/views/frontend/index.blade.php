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
                <h2>2019-2020 Lodge Officers</h2>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.jpg')}}" style="width:150px; height:150px; align:center;" alt="Worshipful Master">
                <h3>Worshipful Master:. W. Gil Torres</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Senior Warden">
                <h3>Senior Warden:. W. Bob Schroeder</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Junior Warden">
                <h3>Junior Warden:. Bro. Rafael Corchado Jr.</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Secretary">
                <h3>Secretary:. W. James Curry</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Secretary">
                <h3>Asst. Secretary:. R.W. Colin Oakenfull</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Treasurer">
                <h3>Treasurer:. Bro. George Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Senior Deacon">
                <h3>Senior Deacon:. Bro. George Batchelor</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Junior Deacon">
                <h3>Junior Deacon:. Bro. Sean Ciaschi</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Marshal">
                <h3>Marshal:. W. Frank Glynn</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Tiler">
                <h3>Tiler:. W. Sam Phelps III</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Chaplain">
                <h3>Chaplain:. R.W. John Cola</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Chaplain">
                <h3>Junior Master of Ceremonies:. Bro. Jeremy Pearl</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Chaplain">
                <h3>Senior Master of Ceremonies:. Bro. Eric Vandalinda</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Steward 1">
                <h3>Steward:. Bro. Kyle Williams</h3>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <img class="officer-photo" src="{{asset('images/home-images/default.png')}}" style="width:150px; height:150px; align:center;" alt="Steward 2">
                <h3>Steward:. Vacant</h3>
            </div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts')
    <script>
        $('.carousel').carousel();
    </script>
@endsection