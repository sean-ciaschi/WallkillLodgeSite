@extends('frontend.layouts.app')

@section('title')
    {{app_name()}} :: Trestle Board
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page_title">Trestle Board - Winter 2019/Spring 2020</h1>
            </div>
        </div>

        @if(isset($posts) && count($posts) == 0)
            <p>No current posts found!</p>
        @endif
        <div class="posts_wrapper">
            @foreach($posts as $post)
                <div class="row">
                    <div class="col-md-12 post well">
                        <div class="col-md-12 post_title">
                            {{$post->title}}
                            <div class="pull-right">
                                @role('Administrator')
                                <a href="{{route('frontend.trestle-board.delete-post', ['id' => $post->id])}}"><i class="fa fa-trash" title="Delete Post"></i></a>
                                @endauth
                                Meeting Date: {{date('F d, Y', strtotime($post->date))}}
                            </div>
                        </div>
                        <div class="col-md-12 post_content">
                            {!! $post->content !!}

                            @if($post->attachment_path)
                                <a href="{{route('frontend.trestle-board.download-attachment', ['fileName' => $post->attachment_path])}}" target="_blank">Download Attachment</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection