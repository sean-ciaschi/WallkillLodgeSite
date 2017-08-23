@extends('backend.layouts.app')

@section('after-styles')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Events</h1>
    </div>
    <a href="{{route('admin.gallery.create-album')}}">
        <div class="btn btn-success btn-sm pull-right mb-10">
            <i class="fa fa-plus"></i> Create Event
        </div>
    </a>
    <table style="table-layout: fixed; width:100%;">
        <tr style="text-align: center">
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Settings</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->name}}</td>
                <td>{{str_limit($event->description, 120)}}</td>
                <td>{{$event->date}}</td>
                <td>
                    <a href="{{route('admin.blog.edit-post', ['id' => $event->id])}}">
                        <div class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </a>
                    <a href="{{route('admin.blog.delete-post', ['id' => $event->id])}}">
                        <div class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection