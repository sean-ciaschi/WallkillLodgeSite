@extends('backend.layouts.app')

@section('before-styles')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endsection

@section('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height:500,
            });
        });
    </script>
@endsection

@section('content')
    {{Form::open(array('action' => 'Backend\Blog\BlogController@createPost', 'files' => true))}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Content')}}
            {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
            {{Form::file('attachment', array('multiple'=>true), $attributes = array())}}
        </div>
        <div class="form-group">
            {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm'))}} </div>
    {{Form::close()}}
@endsection