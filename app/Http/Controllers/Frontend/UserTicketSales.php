<?php namespace App\Http\Controllers\Frontend;
/**
 * Created by PhpStorm.
 * User: sean.ciaschi
 * Date: 8/17/2017
 * Time: 2:31 PM
 */

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use Braintree\Exception;
use Braintree_ClientToken;
use Braintree_Configuration;
use Braintree_Transaction;
use Illuminate\Http\Request;
use Knp\Snappy\Pdf;

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
            'clientId'  => $this->provider->generate()
        ]);
    }

    public function chargeSale(Request $request)
    {
        $nonceFromTheClient = $request->get('nonce');

        try
        {
            $result = Braintree_Transaction::sale([
                'amount' => $request->get('cost'),
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            if($result->success)
            {
                $this->generateTicket($result);
            }
        }
        catch (Exception $exception)
        {
            dd($exception);
        }
    }

    public function generateTicket($ticketResponse)
    {
        $html = '';

        $html .= '<div class="ticket-wrapper">';
            $html .= '<div class="ticket-info">';
                $html .= '<img src="images/ticket-header.png">';
                $html .= '<span>Thank you for supporting our event! We appreciate your commitment and hope you enjoy yourself!</span>';
            $html .= '</div>';
        $html .= '</div>';

        $snappy = new Pdf('pdf');

        return $snappy->generateFromHtml($html, 'test-ticket.pdf');
    }
}