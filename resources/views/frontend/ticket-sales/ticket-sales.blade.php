<?php
    if(isset($event) && $event->count() != 0)
    {
        $activeEvent = $event->first();
    }
    else
    {
        $activeEvent = null;
    }
?>

@extends('frontend.layouts.app')

@section('title')
    {{app_name()}} :: Ticket Sales
@stop

@section('head_js')
    <script src="https://js.braintreegateway.com/web/dropin/1.6.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div class="row container event-wrapper">
        <div class="col-sm-12">
            <h1 class="page_title">Event Tickets</h1>
        </div>
        @if(isset($activeEvent) && $activeEvent != null)
            <div class="col-sm-6">
                <div class="payment-input well">
                    <h3 class="event-name">{{$activeEvent->name}}</h3>
                    <span>Location:</span><div class="event-where">{{$activeEvent->location}}</div>
                    <span>Time of Event:</span><div class="event-time">{{$activeEvent->date}}</div>
                    <span>Cost:</span><div class="event-cost">${{$activeEvent->price}}</div>
                    <div>
                        <p>Note: If you are paying with cash at the lodge/at the time of the event, please contact the current Worshipful Master or Secretary so that the ticket counts may be accurate</p>
                        <p style="font-weight: bold;">ALL TICKETS ARE NON-REFUNDABLE</p>
                        <p style="font-weight: bold;">Recipient must have ID and Tickets with them at time/place of event to verify the purchase</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mt-10">
                <div class="ticket-details">
                    <div class="row">
                        <form role="form" id="user-form" data-toggle="validator">
                            <div class="md-form col-sm-12">
                                <input type="text" id="user-fname" class="form-control validate" required>
                                <label for="user-fname">Recipient First name</label>
                            </div>
                            <div class="md-form col-sm-12 ">
                                <input type="text" id="user-lname" class="form-control validate" required>
                                <label for="user-lname">Recipient Last name</label>
                            </div>
                            <div class="md-form col-sm-12">
                                <input type="email" id="user-email" class="form-control validate" required>
                                <label for="user-email">Recipient Email</label>
                            </div>
                        </form>
                    </div>
                    {{--<div id="dropin-container"></div>--}}

                    <div class="card">
                        <h3 class="card-header primary-color white-text custom-card-header">Card Information</h3>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Card Number</label>
                                    <div id="sq-card-number"></div>
                                </div>
                                <div class="col-sm-12 ">
                                    <label>CVV</label>
                                    <div id="sq-cvv"></div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Expiration Date</label>
                                    <div id="sq-expiration-date"></div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Postal Code</label>
                                    <div id="sq-postal-code"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <label for="spinner">Select Quantity:</label>
                            </div>
                            <div class="col-sm-6">
                                <input id="spinner" type="range" min="1" max="20" value="1" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <span class="col-sm-6">Total Cost:</span>
                            <div class="total-cost col-sm-6" id="total-cost">$0.00</div>
                        </div>
                    </div>

                    <input type="hidden" id="card-nonce" name="nonce">
                    <input type="button" class="button button--small button--green pull-right" onclick="requestCardNonce(event)" value="Pay Now">

                </div>
            </div>
        @else
            <div class="text-muted" style="text-align: center;">
                No tickets are currently for sale!
            </div>
        @endif
    </div>
@endsection

@section('after-scripts')
    <script>
        @if(isset($activeEvent) && $activeEvent != null)
            var applicationId = "{{  env('SQUARE_APP_ID', 0) }}"; // <-- Add your application's ID here
            var locationId = "{{ env('SQUARE_LCOATION_ID', 0) }}";  // <-- For Apple Pay, set your location ID here

            // Make sure the application ID is set before continuing.
            // Note: checking locationId if using Apple Pay.
            if (applicationId == '') {
                alert('You need to provide a value for the applicationId variable.');
            }

            // Create and initialize a payment form object
            var paymentForm = new SqPaymentForm({
                applicationId: applicationId,
                locationId: locationId,
                inputClass: 'sq-input',
                inputStyles: [
                    {
                        fontSize: '15px'
                    }
                ],
                // Used for credit card payments
                cardNumber: {
                    elementId: 'sq-card-number',
                    placeholder: '•••• •••• •••• ••••'
                },
                cvv: {
                    elementId: 'sq-cvv',
                    placeholder: 'CVV'
                },
                expirationDate: {
                    elementId: 'sq-expiration-date',
                    placeholder: 'MM/YY'
                },
                postalCode: {
                    elementId: 'sq-postal-code',
                    placeholder: '12345'
                },
                // Payment form callback functions
                callbacks: {

                    // Used for credit card payments. Called when the SqPaymentForm
                    // completes a request to generate a card nonce, even if the request
                    // failed because of an error.
                    cardNonceResponseReceived: function(errors, nonce, cardData) {
                        if (errors) {
                            console.log("Encountered errors:");

                            // This logs all errors encountered during nonce generation to the
                            // Javascript console.
                            errors.forEach(function(error) {
                                console.log('  ' + error.message);
                            });

                            return;
                        } else {

                            // You can delete this line, it's provided for testing purposes
                            alert('Nonce received: ' + nonce);


                            // Assign the nonce value to the hidden form field
                            document.getElementById('card-nonce').value = nonce;

                            var buyerName = document.getElementById('user-fname').value + ' ' + document.getElementById('user-lname').value;

                            if(document.getElementById('user-fname').value == '')
                            {
                                document.getElementById('user-fname').classList.add('invalid');
                                toastr.warning('Please fill out all form fields');
                                return false;
                            }
                            else if(document.getElementById('user-lname').value == '')
                            {
                                document.getElementById('user-lname').classList.add('invalid');
                                toastr.warning('Please fill out all form fields');
                                return false;
                            }
                            else if(document.getElementById('user-email').value == '')
                            {
                                document.getElementById('user-lname').classList.add('invalid');
                                toastr.warning('Please fill out all form fields');
                                return false;
                            }

                            // Let the form continue to the payment processing page
                            jQuery.ajax({
                                method: "POST",
                                url: '{{route('frontend.ticket-sales.process-payment')}}',
                                data: {
                                    nonce: nonce,
                                    cost: cost * 100,
                                    quantity: quantitySpinner.val(),
                                    eventId: {!! isset($activeEvent) && isset($activeEvent->id) ? $activeEvent->id : null; !!},
                                    buyerEmail: document.getElementById('user-email').value,
                                    buyerName: buyerName
                                }
                            });
                        }
                    },

                    unsupportedBrowserDetected: function() {
                        // Fill in this callback to alert buyers when their browser is not supported.
                    },

                    // Fill in these cases to respond to various events that can occur while a
                    // buyer is using the payment form.
                    inputEventReceived: function(inputEvent) {
                        switch (inputEvent.eventType) {
                            case 'focusClassAdded':
                                // Handle as desired
                                break;
                            case 'focusClassRemoved':
                                // Handle as desired
                                break;
                            case 'errorClassAdded':
                                // Handle as desired
                                break;
                            case 'errorClassRemoved':
                                // Handle as desired
                                break;
                            case 'cardBrandChanged':
                                // Handle as desired
                                break;
                            case 'postalCodeChanged':
                                // Handle as desired
                                break;
                        }
                    },

                    paymentFormLoaded: function() {
                        // Fill in this callback to perform actions after the payment form is
                        // done loading (such as setting the postal code field programmatically).
                        // paymentForm.setPostalCode('94103');
                    }
                }
            });

            // This function is called when a buyer clicks the Submit button on the webpage
            // to charge their card.
            function requestCardNonce(event) {

                // This prevents the Submit button from submitting its associated form.
                // Instead, clicking the Submit button should tell the SqPaymentForm to generate
                // a card nonce, which the next line does.
                event.preventDefault();

                paymentForm.requestCardNonce();
            }

            var quantitySpinner = jQuery('#spinner'),
                totalCost       = document.querySelector('.total-cost'),
                button          = document.getElementById('submit-button'),
                    @if(isset($activeEvent) && $activeEvent != null)
                    cost        = (quantitySpinner.val() * {{$activeEvent->price}}).toFixed(2);
            @else
                cost = {{$activeEvent->price}}).toFixed(2);
            @endif

                totalCost.innerHTML = '$' + cost;


            $('#spinner').on('change input', function(item) {
                console.log('Changed');
                var value = item.currentTarget.value;
                @if(isset($activeEvent) && $activeEvent != null)
                    cost = (value * {{($activeEvent->price) ? $activeEvent->price : 0}}).toFixed(2);
                @else
                    cost = 0;
                @endif
                    totalCost.innerHTML = '$' + cost;
            });
        @endif
    </script>
@endsection