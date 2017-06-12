@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1 class="page_title">Trestle Board</h1>
        </div>
    </div>

    @if(isset($posts) && count($posts) == 0)
        <p>No current posts found!</p>
    @endif

    @foreach($posts as $post)
        <div class="well posts_wrapper">
            <div class="row">
                <div class="col-md-12 post">
                    <div class="col-md-12 post_title">
                        {{$post->title}}
                        <div class="pull-right">
                            @role('Administrator')
                                <a href="{{route('frontend.trestle-board.delete-post', ['id' => $post->id])}}"><i class="fa fa-trash" title="Delete Post"></i></a>
                            @endauth
                            {{date('F d, Y', strtotime($post->created_at))}} at {{date('h:m a', strtotime($post->created_at))}}
                        </div>
                    </div>
                    <div class="col-md-12 post_content">
                        {!! $post->content !!}

                        <a href="{{route('frontend.trestle-board.download-attachment', ['fileName' => $post->attachment_path])}}" target="_blank">Download Attachment</a>

                    </div>
                </div>
            </div>

        </div>
    @endforeach
@endsection