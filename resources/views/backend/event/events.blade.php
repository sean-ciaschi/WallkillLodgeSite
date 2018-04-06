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
    <a href="{{route('admin.events.create-event')}}">
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
        @if($events && $events->count())
            @foreach($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{str_limit($event->description, 120)}}</td>
                    <td>{{$event->date}}</td>
                    <td>
                        <a href="{{route('admin.events.update-event', ['id' => $event->id])}}">
                            <div class="btn btn-info btn-sm">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </a>
                        <a href="{{route('admin.events.delete-event', ['id' => $event->id])}}">
                            <div class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </div>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection