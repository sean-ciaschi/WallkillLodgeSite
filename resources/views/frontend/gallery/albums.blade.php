@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page_title">Gallery - Albums</h1>
            </div>
            @foreach($albums as $album)
                <div class="well col-xs-12 col-md-5" style="text-align: center;">
                    {{--<img class="album-img img-thumbnail"  src="{{route('frontend.storage.album', ['filename' => $album->cover_image])}}">--}}
                    <h2>{{$album->name}}</h2>
                    <p>{{str_limit($album->description, 150)}}</p>
                    <a href="{{route('frontend.gallery.images', ['albumId' => $album->id])}}"><div class="btn btn-success pull-right">View Album</div></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection