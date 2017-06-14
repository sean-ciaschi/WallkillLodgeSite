@extends('frontend.layouts.app')

@section('before_content')
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
                <img src="https://unsplash.it/2000/1250?image=397" data-color="lightblue" alt="First Image">
            </div>
            <div class="item">
                <img src="https://unsplash.it/2000/1250?image=689" data-color="firebrick" alt="Second Image">
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
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

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
                'background-image' : 'url(' + $src + ')',
                'background-color' : $color
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