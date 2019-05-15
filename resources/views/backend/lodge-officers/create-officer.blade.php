@extends('backend.layouts.app')

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">
            @if($pageType == 'edit')
                Edit
            @else
                Create
            @endif Officer </h1>
    </div>
    @if($pageType == 'edit')
        {{Form::open(array('action' => ['Backend\Blog\AdminLodgeOfficerController@updateOfficer', 'id' => $officerId], 'files' => true))}}
    @else
        {{Form::open(array('action' => 'Backend\Blog\AdminLodgeOfficerController@createOfficer', 'files' => true))}}
    @endif
    <div class="box-body">
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', isset($name) ? $name : null, array('class' => 'form-control', 'placeholder'=>'Name'))}}
        </div>
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', isset($name) ? $name : null, array('class' => 'form-control', 'placeholder'=>'Name'))}}
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