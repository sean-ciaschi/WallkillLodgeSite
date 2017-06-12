@extends('frontend.layouts.app')

@section('content')
    <div class="modal fade eventModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
        <div class="col-md-4">
            <h1 class="page_title">Upcoming Events</h1>
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
                },
                timeFormat: 'h:mm a',
                eventClick: function(calEvent, jsEvent, view) {

                    var selectors = {
                        modal: document.querySelector('.eventModal'),
                        modalTitle: document.querySelector('.modal-title'),
                        modalBody:  document.querySelector('.modal-body')
                    };

                    var html = '';

                    console.log(calEvent.location);

                    if(calEvent.description != undefined)
                    {
                        html += '<p class="event-desc">';
                            html += '<span class="event_child_txt">Description:</span> '+ calEvent.description;
                        html += '</p>';
                    }

                    html += '<p class="all-day">';
                        html += '<span class="event_child_txt">All Day Event?:</span> '+(calEvent.allDay ? 'Yes' : 'No');
                    html += '</p>';

                    html += '<p class="start-time">';
                        html += '<span class="event_child_txt">Start Time:</span> '+moment(calEvent.start).format("MM/DD/YYYY hh:mma");
                    html += '</p>';

                    html += '<p class="end-time">';
                        html += '<span class="event_child_txt">End Time:</span> '+moment(calEvent.end).format("MM/DD/YYYY hh:mma");
                    html += '</p>';

                    if(calEvent.location != undefined)
                    {
                        html += '<p class="event_loc">';
                            html += '<span class="event_child_txt">Location:</span> '+calEvent.location+' (<a href="http://maps.google.com/maps?daddr='+calEvent.location+'" target="_blank">Directions</a>)';
                        html += '</p>';
                    }

                    if (calEvent.url)
                    {
                        html += '<p class="open-gcal">';
                            html += '<span class="event_child_txt"><a href="'+calEvent.url+'" target="_blank">Copy Event to Google Calendar</a></span>';
                        html += '</p>';
                    }

                    selectors.modalTitle.innerHTML  = 'Event: ' + calEvent.title;
                    selectors.modalBody.innerHTML   = html;

                    jQuery(selectors.modal).modal('toggle');

                    if (calEvent.url)
                    {
                        return false;
                    }
                }
            });
        });

    </script>
@endsection