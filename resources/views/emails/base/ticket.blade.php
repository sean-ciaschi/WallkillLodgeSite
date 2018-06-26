<?php
    use Carbon\Carbon;

    $dateOfEvent = null;

   if(isset($event->first()->date))
   {
       $dateOfEvent = Carbon::parse($event->first()->date)->format('F d, Y h:i A');
   }
?>
<html>
    <body>
        @for($i = 0; $i < $tickets->quantity; $i++)
            <div class="wrapper" style="display:block;">
                <img style="margin-left: 31%;" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/images/ticket-header.png';?>">
                <br/>
                <div style="page-break-after: always;text-align:center">
                    <h2>Event:  {{ $event->first()->name }}</h2>
                    <h2>Where:  {{ $event->first()->location }}</h2>
                    <h2>Date:   {{ $dateOfEvent }}</h2>
                    <h2>Buyer:  {{ $tickets->first()->buyer_name }}</h2>
                    <h2>Ticket: {{$i + 1}}/{{ $tickets->quantity }}</h2>
                </div>
            </div>
        @endfor
    </body>
</html>



