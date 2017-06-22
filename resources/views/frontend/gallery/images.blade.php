@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($images as $image)
                <div class="col-xs-12 col-md-4" style="text-align: center;">
                    <a href="{{route('frontend.storage.album.images', ['albumId' => $albumId,'filename' => $image->image])}}" data-fancybox="gallery" class="col-md-12">
                        <img class="inner-album-img img-thumbnail" src="{{route('frontend.storage.album.images', ['albumId' => $albumId,'filename' => $image->image])}}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection