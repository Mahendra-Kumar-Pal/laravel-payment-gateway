<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
   
class PayPalController extends Controller
{
    // ---------------itsolutionstuff start------------------
    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'ItSolutionStuff.com',
                'price' => 100,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('paypal.payment.success');
        $data['cancel_url'] = route('paypal.payment.cancel');
        $data['total'] = 100;
  
        $provider = new PayPalClient;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
   
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    public function success(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
        }
  
        dd('Something is wrong.');
    }
    // ---------------itsolutionstuff end------------------

    // ---------------medium start------------------
    public function createTransaction()
    {
        return view('paypal.transaction');
    }

    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.successTransaction'),
                "cancel_url" => route('paypal.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('paypal.createTransaction')->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('paypal.createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('paypal.createTransaction')->with('success', 'Transaction complete.');
        } else {
            return redirect()->route('paypal.createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()->route('paypal.createTransaction')->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
    // ---------------medium end------------------
}