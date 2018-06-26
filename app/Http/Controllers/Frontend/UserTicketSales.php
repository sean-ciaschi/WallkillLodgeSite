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
use Braintree\Exception;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use SquareConnect\ApiException;
use SquareConnect\Model\ChargeResponse;
use Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UserTicketSales extends Controller
{
    public function __construct(){}

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id = null)
    {
        if($id)
        {
            $activeEvent = Event::where('is_active', 1)->where('id', $id)->first();
        }
        else
        {
            $activeEvent = null;
        }

        $events = Event::where('is_active', 1)->get();

        return view('frontend.ticket-sales.ticket-sales')->with([
            'activeEvent'   => $activeEvent,
            'event'         => $events,
        ]);
    }

    /**
     * @param Request $request
     * @return Event
     */
    public function getEventById(Request $request)
    {
        $eventModel = new Event();

        return json_encode($eventModel->where('id', $request->get('id'))->first());
    }

    /**
     * @param $responseBody
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success($responseBody)
    {
        return view('frontend.ticket-sales.ticket-sales-receipt')->with([
            'response'  => $responseBody
        ]);
    }

    public function chargeSale(Request $request)
    {

        $amount             = (integer) $request->get('cost');
        $buyerEmail         = $request->get('buyerEmail');
        $nonceFromTheClient = $request->get('nonce');
        $event              = (new Event)->where('id', $request->get('eventId'))->get();

        $locationId         = env('SQUARE_LOCATION_ID', 0);
        $access_token       = env('SQUARE_ACCESS_TOKEN', 0);
        $squareProcesser    = new \SquareConnect\Configuration;

        try
        {
            $squareProcesser::getDefaultConfiguration()->setAccessToken($access_token);

            $transactions_api   = new \SquareConnect\Api\TransactionsApi();
            $request_body       = [
                "card_nonce" => $nonceFromTheClient,
                # Monetary amounts are specified in the smallest unit of the applicable currency.
                # This amount is in cents. It's also hard-coded for $1, which is not very useful.
                "amount_money" => array (
                    "amount" => $amount,
                    "currency" => "USD"
                ),
                "buyer_email_address" => $buyerEmail,
                # Every payment you process for a given business have a unique idempotency key.
                # If you're unsure whether a particular payment succeeded, you can reattempt
                # it with the same idempotency key without worrying about double charging
                # the buyer.
                "idempotency_key" => uniqid(),
                "note"  => $event->name
            ];

            try
            {
                $charge = $transactions_api->charge($locationId, $request_body);
                $this->createAndSendTickets($request, $charge);
            }
            catch (ApiException $e)
            {
                echo "Caught exception " . $e->getMessage();
            }
        }
        catch (Exception $exception)
        {
            dd($exception);
        }
    }

    /**
     * Create and Send Tickets
     *
     * @param Request        $request
     * @param ChargeResponse $charge
     * @return mixed
     */
    public function createAndSendTickets(Request $request, ChargeResponse $charge)
    {
        $transaction        = $charge->getTransaction();
        $tenders            = $transaction->getTenders();
        $locationId         = env('SQUARE_LOCATION_ID', 0);
        $access_token       = env('SQUARE_ACCESS_TOKEN', 0);
        $headers = [
            'Authorization' => 'Bearer ' . $access_token,
            'Accept'        => 'application/json',
        ];

        $client = new Client();
        $res = $client->get('https://connect.squareup.com/v1/'.$locationId.'/payments/'.$tenders[0]->getId(), [
            'headers' =>  $headers
        ]);

        $responseBody = json_decode($res->getBody());

        $buyerName  = $request->get('buyerName');
        $buyerEmail = $request->get('buyerEmail');
        $quantity   = $request->get('quantity');
        $eventId    = $request->get('eventId');

        $buyerTickets = (new \App\Models\UserTicketSales\UserTicketSales)->create([
            'event_id'      => $eventId,
            'buyer_name'    => $buyerName,
            'buyer_email'   => $buyerEmail,
            'quantity'      => $quantity
        ])->id;

        Mail::to($buyerEmail)->send(new SendTickets($buyerTickets, $responseBody));

        return $this->success($responseBody);
    }
}
