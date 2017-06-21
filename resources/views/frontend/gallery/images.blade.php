@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($images as $image)
                <div class="well col-md-4">
                    <a href="{{route('frontend.storage.album.images', ['albumId' => $albumId,'filename' => $image->image])}}" data-toggle="lightbox" data-gallery="album_{{$albumId}}" class="col-sm-4">
                        <img class="inner-album-img" src="{{route('frontend.storage.album.images', ['albumId' => $albumId,'filename' => $image->image])}}" class="img-fluid">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection