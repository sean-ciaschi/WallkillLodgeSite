var defaultOpts = {
    googleCalendarApiKey: 'AIzaSyCamEOyqgGIdb3yRMdDfke3Es-tT-i7IK4',
    events: {
        googleCalendarId: 'wm.wallkill627@gmail.com'
    },
    textEscape: false,
    timeFormat: 'h:mm a',
    eventClick: function(calEvent, jsEvent, view)
    {

        var selectors = {
            modal:      document.querySelector('.eventModal'),
            modalTitle: document.querySelector('.modal-title'),
            modalBody:  document.querySelector('.modal-body')
        },
            html = '';

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
};

$('.responsiveCal').fullCalendar(defaultOpts);
