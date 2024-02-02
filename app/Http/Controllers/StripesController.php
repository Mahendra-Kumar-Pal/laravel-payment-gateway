<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class StripesController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        return view('stripe.payment');
    }

    public function payment(Request $request)
    {
        //---validate form data---
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);
        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/index');
        }

        //---create token---
        $token = $this->createToken($request);
        // dd($this->stripe->retrieveSource)
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->redirectTo('/index');
        }
        if (empty($token['id'])) {
            $request->session()->flash('danger', 'Payment failed.');
            return response()->redirectTo('/index');
        }
        // dd($token['id']);

        //---create charge---
        $charge = $this->stripe->charges->create([
            'amount' => 200 * 100,
            'currency' => 'usd',
            'source' => $token->id,
            'description' => 'My first payment',
        ]);
        // dd($charge);
        if (!empty($charge) && $charge['status'] == 'succeeded') {
            $request->session()->flash('success', 'Payment completed.');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
        }

        return response()->redirectTo('stripe/index');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        // dd($tokenId);
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment',
                'customer' => $this->createCustomer(),
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    private function createCustomer()
    {
        $customer = $this->stripe->customers->create([
            'name' => 'Jack',
            'email' => 'Jack@gmail.com',
            'description' => 'Testing',
        ]);
        return $customer->id;
    }
}
