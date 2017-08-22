@extends('backend.layouts.app')

@section('after-styles')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Trestle Board - Posts</h1>
    </div>
    <a href="{{route('admin.gallery.create-album')}}">
        <div class="btn btn-success btn-sm pull-right mb-10">
            <i class="fa fa-plus"></i> Create Post
        </div>
    </a>
    <table style="width:100%">
        <tr>
            <th>Album</th>
            <th>Created At</th>
            <th>Settings</th>
        </tr>
        @foreach($albums as $album)
            <tr>
                <td>{{$album->name}}</td>
                <td>{{$album->created_at}}</td>
                <td>
                    <a href="{{route('admin.gallery.edit-album', ['id' => $album->id])}}">
                        <div class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </a>
                    <a href="{{route('admin.gallery.ajax-delete-album', ['id' => $album->id])}}">
                        <div class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection