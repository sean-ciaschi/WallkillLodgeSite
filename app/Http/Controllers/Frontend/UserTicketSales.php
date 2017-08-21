<?php namespace App\Http\Controllers\Frontend;
/**
 * Created by PhpStorm.
 * User: sean.ciaschi
 * Date: 8/17/2017
 * Time: 2:31 PM
 */

use App\Http\Controllers\Controller;
use Braintree_ClientToken;
use Braintree_Configuration;
use Braintree_Transaction;
use Illuminate\Http\Request;

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
        return view('frontend.ticket-sales.ticket-sales')->with([
           'clientId' => $this->provider->generate()
        ]);
    }

    public function chargeSale(Request $request)
    {
        $nonceFromTheClient = $request->get('nonce');

        $result = Braintree_Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        dd($result);
    }
}