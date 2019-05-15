@extends('backend.layouts.app')
@section('before-styles')
@endsection

@section('after-styles')
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Lodge Officers - Create</h1>
    </div>
    <a href="{{route('admin.officers.create')}}">
        <div class="btn btn-success btn-sm pull-right mb-10">
            <i class="fa fa-plus"></i> Create new Officer
        </div>
    </a>
    <table style="table-layout: fixed; width:100%;">
        <tr style="text-align: center">
            <th>Name</th>
            <th>Position</th>
            <th>Station</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        @foreach($officers as $officer)
            <tr>
                <td>{{$officer->name}}</td>
                <td>{{$officer->position}}</td>
                <td>{{$officer->office}}</td>
                <td>{{$officer->created_at}}</td>
                <td>
                    <a href="{{route('admin.officers.edit-officer', ['id' => $officer->id])}}">
                        <div class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </a>
                    <a href="{{route('admin.officers.delete-officer', ['id' => $officer->id])}}">
                        <div class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection