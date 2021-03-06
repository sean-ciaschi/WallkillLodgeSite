@extends('frontend.layouts.app')

@section('content')
    <div class="row container receipt-wrapper">
        <div class="col-sm-12">
            <h1 class="page_title">Thank you for your purchase!</h1>
        </div>
        <div class="col-sm-12">
            <img src="{{asset('images/ticket-header.png')}}" alt="Masonic Symbol">
        </div>
        <div class="col-sm-12">
            <h2>Your receipt and ticket(s) have been sent to your email which should arrive in 1 minute to 5 minutes</h2>
            <h3>View/Download your receipt <a href="{{$responseBody['receipt_url']}}">here</a></h3>
        </div>
    </div>
@endsection