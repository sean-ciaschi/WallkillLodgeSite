@extends('frontend.layouts.app')

@section('content')
    <h1>Trestle Board</h1>
    @foreach($posts as $post)
        <div class="well posts_wrapper">
                <div class="post">
                    <div class="post_title">
                        {{$post->title}}
                        <div class="pull-right">
                            {{date('F d, Y', strtotime($post->created_at))}} at {{date('h:m a', strtotime($post->created_at))}}
                        </div>
                    </div>
                    <div class="container post_content">
                        {!! $post->content !!}

                        <a href="{{route('frontend.trestle-board.download-attachment', ['fileName' => $post->attachment_path])}}" target="_blank">Download Attachment</a>

                    </div>
                </div>
        </div>
    @endforeach
@endsection