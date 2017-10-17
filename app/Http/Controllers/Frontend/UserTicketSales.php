<?php

namespace App\Http\Controllers\Frontend;

/*
 * Created by PhpStorm.
 * User: sean.ciaschi
 * Date: 8/17/2017
 * Time: 2:31 PM
 */

use App\Mail\SendTickets;
use Illuminate\Support\Facades\Mail;
use Knp\Snappy\Pdf;
use Braintree\Exception;
use Braintree_ClientToken;
use Braintree_Transaction;
use App\Models\Event\Event;
use Braintree_Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTicketSales extends Controller
{
    public $provider;

    public function __construct()
    {
        $config = config('braintree');

        Braintree_Configuration::environment($config['environment']);
        Braintree_Configuration::merchantId($config['merc_id']);
        Braintree_Configuration::publicKey($config['public_key']);
        Braintree_Configuration::privateKey($config['private_key']);

        $this->provider = new Braintree_ClientToken();      // To use express checkout.
    }

    public function index(Request $request)
    {
        $event = Event::where('is_active', 1)->get();

        return view('frontend.ticket-sales.ticket-sales')->with([
            'event'     => $event,
            'clientId'  => $this->provider->generate(),
        ]);
    }

    public function chargeSale(Request $request)
    {
        $nonceFromTheClient = $request->get('nonce');

        try {
            $result = Braintree_Transaction::sale([
                'amount' => $request->get('cost'),
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);
            if ($result->success) {
                $this->createAndSendTickets($request);
            }
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Create and Send Tickets
     *
     * @param Request $request
     * @return mixed
     */
    public function createAndSendTickets(Request $request)
    {
        $buyerName  = $request->get('buyerName');
        $buyerEmail = $request->get('buyerEmail');
        $quantity   = $request->get('quantity');
        $eventId    = $request->get('eventId');

        $buyerTickets = \App\Models\UserTicketSales\UserTicketSales::create([
            'event_id'      => $eventId,
            'buyer_name'    => $buyerName,
            'buyer_email'   => $buyerEmail,
            'quantity'      => $quantity
        ])->id;

        return Mail::to("sciaschi1@gmail.com")->send(new SendTickets($buyerTickets));
    }
}
