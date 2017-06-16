@extends('frontend.layouts.app')

@section('before_content')
    @notmobile()
        <div id="mycarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mycarousel" data-slide-to="1"></li>
                <li data-target="#mycarousel" data-slide-to="2"></li>
                <li data-target="#mycarousel" data-slide-to="3"></li>
                <li data-target="#mycarousel" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item">
                    <img src="https://scontent-iad3-1.xx.fbcdn.net/v/t1.0-9/1891243_377317762424096_374112220093852261_n.jpg?oh=b7fa15214c96d6fd6c900ed295ae7194&oe=59E6A8DF" data-color="lightblue" alt="First Image">
                </div>
                <div class="item">
                    <img src="https://scontent-iad3-1.xx.fbcdn.net/v/t1.0-9/11188464_458435660978972_6652031462252564388_n.jpg?oh=01369880485c8310015f8a01d7cf3bdc&oe=59E689F4" data-color="firebrick" alt="Second Image">
                </div>
                <div class="item">
                    <img src="https://unsplash.it/2000/1250?image=675" data-color="violet" alt="Third Image">
                </div>
                <div class="item">
                    <img src="https://unsplash.it/2000/1250?image=658" data-color="lightgreen" alt="Fourth Image">
                </div>
                <div class="item">
                    <img src="https://unsplash.it/2000/1250?image=638" data-color="tomato" alt="Fifth Image">
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    @endnotmobile
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="well">
                <img src="http://lorempixel.com/1280/1024/abstract" style="width:150px; height:150px;">
                <p>Worshipful Master:. Bob Agazzi</p>
            </div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts')
    <script>
        var $item = $('.carousel .item');
        var $wHeight = $(window).height() - 50;
        $item.eq(0).addClass('active');
        $item.height($wHeight);
        $item.addClass('full-screen');

        $('.carousel img').each(function() {
            var $src = $(this).attr('src');
            var $color = $(this).attr('data-color');
            $(this).parent().css({
                'background' : 'url(' + $src + ') no-repeat center center fixed',
                'background-color' : $color,
                'background-position': '0 -20em',
                '-webkit-background-size': 'cover',
                '-moz-background-size': 'cover',
                '-o-background-size': 'cover',
                'background-size': 'cover'
            });
            $(this).remove();
        });

        $(window).on('resize', function (){
            $wHeight = $(window).height();
            $item.height($wHeight);
        });

        $('.carousel').carousel({
            interval: 6000,
            pause: "false"
        });
    </script>
@endsection