@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Upcoming Events</h1>
        </div>
        <div class="col-md-12">
            <div class="responsiveCal">
            </div>
        </div>

    </div>

@endsection

@section('after-scripts')
    <script type='text/javascript'>

        $(document).ready(function() {
            $('.responsiveCal').fullCalendar({
                googleCalendarApiKey: '	AIzaSyDuEHqh_8Op9ZiJ4o5Daz9Vve96io63qAA',
                events: {
                    googleCalendarId: '84o9isja4rb050mlq10a5acaac@group.calendar.google.com'
                }
            });
        });

    </script>
@endsection