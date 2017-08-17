@extends('frontend.layouts.app')

@section('head_js')
    <script src="https://js.braintreegateway.com/web/dropin/1.6.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div class="row container event-wrapper">
        <div class="col-sm-6">
            <div class="payment-input well">
                <h3 class="event-name">Event Name</h3>
                <span>Location:</span><div class="event-where">15 Test Location, New Windsor, NY 12553</div>
                <span>Time of Event:</span><div class="event-time">8:00 AM</div>
                <span>Cost:</span><div class="event-cost">$0.00</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="ticket-details">
                <label for="spinner">Select Quantity:</label>
                <input type="number" id="spinner" class="form-control" name="value">
                <div id="dropin-container"></div>
                <button class="btn btn-success pull-right" id="submit-button">Pay Now</button>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script>
        var button = document.getElementById('submit-button');

        braintree.dropin.create({
            authorization: '{{$clientId}}',
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                        }
                    });

                    jQuery.ajax({
                        method: "POST",
                        url: '{{route('frontend.ticket-sales.process-payment')}}',
                        data: { nonce: payload.nonce}
                    });
                });
            });
        });

        jQuery('#spinner').spinner({
            min: 1,
            max: 20,
            step: 1,
            value: 1
        });
    </script>
@endsection