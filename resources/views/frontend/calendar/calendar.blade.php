@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Upcoming Events</h1>
        </div>
        <div class="col-md-12">
            <div class="responsiveCal">
                <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=sean.ciaschi%40goftx.com&amp;color=%231B887A&amp;ctz=America%2FNew_York" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>

    </div>

@endsection