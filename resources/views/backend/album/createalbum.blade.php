@extends('backend.layouts.app')

@section('content')
    <div class="span4" style="display: inline-block;margin-top:100px;">


        <form name="createnewalbum" method="POST" action="{{route('admin.create_album')}}" enctype="multipart/form-data">
            <fieldset>
                <legend>Create an Album</legend>
                <div class="form-group">
                    <label for="name">Album Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Album Name" value="{{Form::old('name')}}">
                </div>
                <div class="form-group">
                    <label for="description">Album Description</label>
                    <textarea name="description" type="text"class="form-control" placeholder="Albumdescription">{{Form::old('descrption')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Select a Cover Image</label>
                    {{Form::file('cover_image')}}
                </div>
                <button type="submit" class="btnbtn-default">Create!</button>
            </fieldset>
        </form>
    </div>
@endsection