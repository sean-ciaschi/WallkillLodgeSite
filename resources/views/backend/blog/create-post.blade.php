@extends('backend.layouts.app')

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">
            @if($pageType == 'edit')
                Edit
            @else
                Create
            @endif Trestle Board Post </h1>
    </div>
    @if($pageType == 'edit')
        {{Form::open(array('action' => ['Backend\Blog\AdminBlogController@updatePost', 'id' => $postId], 'files' => true))}}
    @else
        {{Form::open(array('action' => 'Backend\Blog\AdminBlogController@createPost', 'files' => true))}}
    @endif
    <div class="box-body">
        <div class="form-group">
            {{Form::label('meeting-date', 'Meeting Date: *')}}
            <div class="input-group date" data-provide="datepicker">
                {{ Form::text('meetingDate', $meetingDate, array('class' => 'form-control meeting-date')) }}
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>

        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', isset($title) ? $title : null, array('class' => 'form-control', 'placeholder'=>'Title'))}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Content')}}
            {{Form::textarea('body', isset($content) ? $content : null ,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
            {{Form::file('attachment')}}
        </div>
        <div class="form-group">
            {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm'))}}
        </div>
        {{Form::close()}}
    </div>
@endsection

@section('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height:500
            });

            jQuery('.meeting-date').datepicker();
        });
    </script>
@endsection