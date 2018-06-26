@extends('backend.layouts.app')

@section('after-styles')
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
@endsection

@section('after-scripts')
    @if(isset($images) && $images != 'undefined')
        <script>
            var api = $.fileuploader.getInstance('#fileupload');
            api.append({!! $images !!});
        </script>
    @endif
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Create Album</h1>
    </div>
    <div class="well">
        <div class="row">
            @if(isset($albumName) && isset($albumDesc))
                {{ Form::open(['route' => ['admin.gallery.ajax-edit-album', $id], 'method' => 'POST', 'files'=>true]) }}

                <div class="col-md-12 form-group">
                    {{ Form::label('album_name', 'Album Name: *') }}
                    {{ Form::text('album_name', $albumName, ['class' => 'form-control']) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('album_desc', 'Album Description: *') }}
                    {{ Form::textarea('album_desc', $albumDesc, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-12">
                    {{ Form::label('fileupload', 'Select Images to Add: *') }}
                    <input id="fileupload" type="file" name="images[]" data-fileuploader-maxSize="10" multiple>
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::submit('Save Changes', ['class' => 'btn btn-success pull-right']) }}
                </div>
                {{ Form::close() }}
            @else
                {{ Form::open(['route' => 'admin.gallery.ajax-create-album', 'method' => 'POST', 'files'=>true]) }}

                <div class="col-md-12 form-group">
                    {{ Form::label('album_name', 'Album Name: *') }}
                    {{ Form::text('album_name', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('album_desc', 'Album Description: *') }}
                    {{ Form::textarea('album_desc', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-12">
                    {{ Form::label('fileupload', 'Select Images to Add: *') }}
                    <input id="fileupload" type="file" name="images[]" data-fileuploader-maxSize="50" multiple>
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::submit('Create Album', ['class' => 'btn btn-success pull-right']) }}
                </div>
                {{ Form::close() }}
            @endif

        </div>
    </div>
@endsection