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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page_title">Upcoming Events</h1>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <div class="responsiveCal">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after-scripts')
    @mobile()
        <script src="{{asset('build/plugins/fullcalendar/gcal.min.js')}}"></script>
        <script type='text/javascript' src="assets/js/calendar.mobile.js"></script>
    @elsemobile
        <script src="{{asset('build/plugins/fullcalendar/gcal.min.js')}}"></script>
        <script type='text/javascript' src="assets/js/calendar.js"></script>
    @endmobile
@endsection