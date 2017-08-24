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

@section('head_js')
    <script src="https://js.braintreegateway.com/web/dropin/1.6.1/js/dropin.min.js"></script>
@endsection

@section('content')
    <div class="row container event-wrapper">
        <div class="col-md-12">
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
                        <b>Note: If you are paying with cash at the lodge/at the time of the event, please contact the current Worshipful Master or Secretary so that the ticket counts may be accurate</b>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mt-10">
                <div class="ticket-details">
                    <div id="dropin-container"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <label for="spinner">Select Quantity:</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" id="spinner" class="form-control" name="value" value="1">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <span class="col-md-6">Total Cost:</span>
                            <div class="total-cost col-md-6" id="total-cost">$0.00</div>
                        </div>
                    </div>

                    <button class="button button--small button--green pull-right" id="submit-button">Pay Now</button>

                </div>
            </div>
        @else
            <div class="text-muted" style="text-align: center;">
                No tickets currently for sale
            </div>

        @endif
    </div>
@endsection

@section('after-scripts')
    <script>
        var quantitySpinner = jQuery('#spinner'),
            totalCost       = document.querySelector('.total-cost'),
            button          = document.getElementById('submit-button'),
            @if(isset($activeEvent) && $activeEvent != null)
                cost        = (quantitySpinner.val() * {{$activeEvent->price}}).toFixed(2);
            @else
                cost = 0;
            @endif
        totalCost.innerHTML = '$' + cost;

        quantitySpinner.spinner({
            min: 1,
            max: 20,
            step: 1,
            value: 1,
            change: function(event, ui)
            {
                @if(isset($activeEvent) && $activeEvent != null)
                    cost = (quantitySpinner.val() * {{($activeEvent->price) ? $activeEvent->price : 0}}).toFixed(2);
                @else
                    cost = 0;
                @endif
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
                        data: {
                            nonce: payload.nonce,
                            cost: cost
                        }
                    });
                });
            });
        });
    </script>
@endsection