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
                <span>Cost:</span><div class="event-cost">$10.00</div>
                <div>
                    <b>Note: If you are paying with cash at the lodge/at the time of the event, please contact the current Worshipful Master or Secretary so that the ticket counts may be accurate</b>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-10">
            <div class="ticket-details">
                <label for="spinner">Select Quantity:</label>
                <input type="number" id="spinner" class="form-control" name="value" value="1">

                <div id="dropin-container"></div>

                <button class="button button--small button--green pull-right" id="submit-button">Pay Now</button>

                <label for="total-cost">Total Cost:</label><div class="total-cost">$0.00</div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script>
        var quantitySpinner = jQuery('#spinner'),
            totalCost       = document.querySelector('.total-cost'),
            button          = document.getElementById('submit-button'),
            cost            = (quantitySpinner.val() * 10.00).toFixed(2);

        totalCost.innerHTML = '$' + cost;

        quantitySpinner.spinner({
            min: 1,
            max: 20,
            step: 1,
            value: 1,
            change: function(event, ui)
            {
                cost = (quantitySpinner.val() * 10.00).toFixed(2);
                totalCost.innerHTML = '$' + cost;
            }
        });

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
    </script>
@endsection