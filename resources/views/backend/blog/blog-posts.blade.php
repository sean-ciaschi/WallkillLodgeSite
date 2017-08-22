@extends('backend.layouts.app')

@section('after-styles')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Trestle Board - Posts</h1>
    </div>
    <a href="{{route('admin.blog.create')}}">
        <div class="btn btn-success btn-sm pull-right mb-10">
            <i class="fa fa-plus"></i> Create Post
        </div>
    </a>
    <table style="table-layout: fixed; width:100%;">
        <tr style="text-align: center">
            <th>Title</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Settings</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{str_limit($post->content, 120)}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <a href="{{route('admin.blog.edit-post', ['id' => $post->id])}}">
                        <div class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </a>
                    <a href="{{route('admin.blog.delete-post', ['id' => $post->id])}}">
                        <div class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection