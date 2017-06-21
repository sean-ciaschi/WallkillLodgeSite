@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="well">
            <div class="row">
                {{ Form::open(['route' => 'admin.gallery.ajax-add-images', 'method' => 'POST', 'files'=>true]) }}
                    <div class="form-group col-md-12">
                        {{ Form::label('album_sel', 'Select Album: *') }}
                        {{ Form::select('album_sel', $albums, null, ['class' => 'form-control col-md-12']) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('fileupload', 'Select Images to Add: *') }}
                        <input id="fileupload" type="file" name="images[]" multiple>
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::submit('Add Images to Album') }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection