@extends('backend.layouts.app')

@section('after-styles')
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1 class="page_title">Add Images To Album</h1>
        </div>
        <div class="well">
            <div class="row">
                {{ Form::open(['route' => 'admin.gallery.ajax-add-images', 'method' => 'POST', 'files'=>true]) }}
                <div class="form-group col-md-12">
                    {{ Form::label('album_sel', 'Select Album: *') }}
                    {{ Form::select('album_sel', $albums, null, ['class' => 'form-control col-md-12']) }}
                </div>
                <div class="form-group col-md-12">
                    {{ Form::label('fileupload', 'Select Images to Add: *') }}
                    <input id="fileupload" type="file" name="images[]" data-fileuploader-maxSize="2" multiple>
                </div>
                <div class="form-group col-md-12">
                    {{ Form::submit('Add Images to Album') }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection