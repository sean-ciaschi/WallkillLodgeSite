@extends('backend.layouts.app')

@section('after-styles')
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-md-12">
        <h1 class="page_title">Create Event</h1>
    </div>
    <div class="well">
        <div class="row">
            @if(isset($event))
                {{ Form::open(['route' => ['admin.events.ajax.update-event', 'id' => $event->id], 'method' => 'POST']) }}
            @else
                {{ Form::open(['route' => 'admin.events.ajax.create-event', 'method' => 'POST']) }}
            @endif
            <div class="col-md-12 form-group">
                {{ Form::label('event_name', 'Event Name: *') }}
                {{ Form::text('event_name', (isset($event) && $event->name) ? $event->name : null, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('event_desc', 'Event Description: *') }}
                {{ Form::textarea('event_desc', (isset($event) && $event->description) ? $event->description : null, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('autocomplete', 'Event Address: *') }}
                <input id="autocomplete" class="form-control" placeholder="Enter Address" name="event_location" type="text" value='{{(isset($event) && $event->location) ? $event->location : null}}'/>
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('spinner', 'Cost of Event (USD): *') }}
                <div class="input-group spinner" data-trigger="spinner">
                    <input type="text" class="form-control text-left" name="event_cost" value="{{(isset($event) && $event->price) ? $event->price : 1.00}}" data-rule="currency">
                    <span class="input-group-addon">
                        <a href="javascript:;" class="spin-up" data-spin="up"><i class="fa fa-caret-up"></i></a>
                        <a href="javascript:;" class="spin-down" data-spin="down"><i class="fa fa-caret-down"></i></a>
                    </span>
                </div>
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('is-active', 'Active Event: *') }}
                <input id="is-active" type="checkbox" name="event_is_active" {{(isset($event) && $event->is_active) ? 'checked' : false}} data-toggle="toggle">
            </div>
            <div class="col-md-12 form-group">
                {{ Form::label('event_date', 'Event Date: *') }}
                <div class="input-group date" data-provide="datepicker">
                    {{ Form::text('event_date', (isset($event) && $event->date) ? $event->date : null, array('class' => 'form-control event-date')) }}
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-group">
                {{ Form::submit('Save Changes', ['class' => 'btn btn-success pull-right']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('after-scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/globalize.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height:500
            });

            $("#spinner")
                .spinner('delay', 200) //delay in ms
                .spinner('changed', function(e, newVal, oldVal) {
                    // trigger lazed, depend on delay option.
                })
                .spinner('changing', function(e, newVal, oldVal) {
                    // trigger immediately
                });

            //jQuery( "#spinner" ).spinner( "option", "culture", 'en-US' );
            jQuery('.event-date').datetimepicker();
        });

    </script>

    <script>
        // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position)
                {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        document.getElementById("autocomplete").onfocus = function() {
            geolocate();
        };
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcZk7U-YT3Us88WVJmh8ybBX1c2O5HuaI&libraries=places&callback=initAutocomplete" async defer></script>

@endsection