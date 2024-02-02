<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Session, Auth};
use Stripe\{Stripe, StripeClient, Customer, Charge, PaymentIntent};

class StripeController extends Controller
{

    private $stripe;
    public function __construct(){
        $this->stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        // header('Content-Type: application/json');
    }

    // -----------create payment method----------------
    // public function createPaymentMethodp()
    // {
    //     return view('create-payment-method');
    // }

    // public function createPaymentMethod(Request $request)
    // {
    //     $paymentMethods = $this->stripe->paymentMethods->create([
    //         'type' => $request->card_type,
    //         'card' => [
    //             'number' => $request->card_number,
    //             'exp_month' => $request->exp_month,
    //             'exp_year' => $request->exp_year,
    //             'cvc' => $request->cvv,
    //         ],
    //     ]);

    //     $user = User::first();
    //     $user->update(['payment_method_id' => $paymentMethods->id]);
        
    //     Session::flash('success', 'Payment method created Successfully !');
    //     return back();
    // }

    //-----------get payment method---------------------
    // public function getPaymentMethod()
    // {
    //     $payment_method_id = User::first()->pluck('payment_method_id');
    //     $cardDetails = $this->stripe->paymentMethods->retrieve(
    //         $payment_method_id[0],
    //         []
    //     );
    //     // $cardDetails = \Stripe\PaymentMethod::all([
    //     //     "type" => "card"
    //     // ]);
    //     return view('get-payment-method', compact('cardDetails'));
    // }

    //-----------edit & update payment method-----------
    // public function editPaymentMethod(){
    //     $payment_method_id = User::first()->pluck('payment_method_id');
    //     $cardDetails = $this->stripe->paymentMethods->retrieve(
    //         $payment_method_id[0],
    //         []
    //     );
    //     return view('edit-payment-method', compact('cardDetails', 'payment_method_id'));
    // }
    // public function updatePaymentMethod($payment_method_id){
    //     // dd($payment_method_id);
    //     $this->stripe->paymentMethods->update(
    //         $payment_method_id,
    //         ['metadata' => ['order_id' => '6735']]
    //     );

    //     return redirect()->back()->with('success', 'Updated successfully');
    // }

    // -----------create customer---------------------
    public function createCustomerp()
    {
        return view('stripe.create-customer');
    }

    public function createCustomer(Request $request)
    {
        $user = User::where('name', 'stripe')->first();
        $customer = $this->stripe->customers->create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => "Customer for subscription",
            // 'payment_method' => $user->payment_method_id,
        ]);

        $user->update(['stripe_customer_id' => $customer->id]);
        
        Session::flash('success', 'Customer created successfully!');
        return back();
    }


    //-----------attach customer---------------------
    // public function attachPaymentMethod()
    // {
    //     $user = User::first();
    //     $this->stripe->paymentMethods->attach(
    //         $user->payment_method_id,
    //         ['customer' => $user->customer_id]
    //     );
    //     return "Attached successfully!";
    // }

    //-----------make payment---------------------
    // public function makePaymentp()
    // {
    //     return view('make-payment');
    // }

    // public function makePayment(Request $request)
    // {
    //     $user = User::first();
    //     PaymentIntent::create([
    //         // 'payment_method_types' => ['card'],
    //         'payment_method' => $user->payment_method_id,
    //         'customer' => $user->customer_id,
    //         'setup_future_usage' => 'off_session',
    //         'amount' => $request->amount,
    //         'currency' => 'usd',
    //         'automatic_payment_methods' => [
    //           'enabled' => 'true',
    //         ],
    //         // 'amount' => $request->amount,
    //         // 'currency' => 'usd',
    //         // 'automatic_payment_methods' => ['enabled' => true],
    //         // 'customer' => $user->customer_id,
    //         // 'payment_method' => $user->payment_method_id,
    //         // 'off_session' => true,
    //         // 'confirm' => true,
    //     ]);

    //     // Charge::create([
    //     //     'amount' => 2000,
    //     //     'currency' => 'usd',
    //     //     'customer' => $customer['id'],
    //     //     'description' => 'My First Test Charge',
    //     // ]);
   
    //     Session::flash('success', 'Payment Successful !');
           
    //     return back();
    // }
    
}

















// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Log;
// // use App\Services\Stripe as StripeServices;
// use Stripe;
// use App\Models\User;


// class StripeController extends Controller{
	
// 	public $stripe;
	
//     // public function __construct(StripeServices $stripe) {
//     public function __construct() {
//         $this->stripe =  new Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
//         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
//     }
	
// 	//add cards and get stripe settings (private)
// 	function getStripeSettings() {
//         // dd('getStripeSettings');
// 		$response = \Stripe\Token::create(array(
// 		  "card" => array(
// 			"number"    => 4242424242424242,
// 			"exp_month" => 11,
// 			"exp_year"  => 2032,
// 			"cvc"       => 111,
// 			"name"      => 'card'
// 		)));
// 		// return $response;
//         // dd($response['id']);
// 		return $response['id'];
// 	}
	
// 	//create customer (private)
// 	public function createStripeUser(){
//         // dd('createStripeUser');
//         // $card_token = $request->stripe_token;
//         $card_token = $this->getStripeSettings();
//         // dd($card_token);
//         $user = User::whereId(1)->first();
//         // dd($user->name);

// 		if($user->stripe_customer_id!=''){
// 			$customerId=$user->stripe_customer_id;
// 		}else{
//             // dd($user);
// 			$customer=$this->stripe->customers->create([
//                             'name' => $user->name,
//                             'email' => $user->email,
//                             'description' => "Customer for subscription"
//                         ]);
//             // dd($customer->id);
//             $customerId=$customer->id;

// 			\App\Models\User::where('id',$user->id)->update([
// 					'stripe_customer_id'	=>$customer->id
// 				]);
// 		}

//         // $stripe_secret = \Config('constants.stripe_secret');
//         // $stripe_secret = "sk_test_51N3ChaKsn6QQRGauJs2sKutBtJOtnB9uJnVlK81SdFbjXRkfbmjO5fDHP04VBo4XutlgZHd3TgCu72B7cdCBrWsW00JZYN37lk";
//         // $stripe = new \Stripe\StripeClient(
//         //   $stripe_secret
//         // );
		
//         // dd($customerId);
//         // create and save card on stripe
//         $card_response = $this->stripe->customers->createSource(
//           $customerId,['source' => $card_token]
//         );

// 		$data=[
// 			"customer_id"=>$customerId,
// 			"card_id"=>$card_response['id'],
// 		];
//         // dd($data);
//         return $data;
// 	}
	
// 	// list all the cards
// 	// public function listCard(Request $request){
// 	// 	try{
// 	// 		$customer_id = $request->customer_id;
// 	// 		$stripe_account = Config('constants.stripe_account');
// 	// 		$stripe_secret = $stripe_account['secret'];

// 	// 		$stripe = new \Stripe\StripeClient(
// 	// 		  $stripe_secret
// 	// 		);

// 	// 		$cards = $stripe->customers->allSources(
// 	// 		  $customer_id,
// 	// 		  ['object' => 'card', 'limit' => 3]
// 	// 		);
// 	// 		return $cards;
// 	// 	}
// 	// 	catch(\Exception $e){
// 	// 		return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]); 
// 	// 	 }
//     // }
   
//    //update the cards 
//     // public function updateCardDetails(Request $request){
// 	//    try{
// 	// 	   $validator = Validator::make($request->all(),[
// 	// 			"customer_id"	=>"required",
// 	// 			"card_id"		=>"required"
// 	// 		]);
// 	// 		if($validator->fails()){
// 	// 		  $response = $validator->messages();
// 	// 		  return response()->json(["error_msg" => $response, "status" => "Failed","data"=>NULL],400);
// 	// 		}
// 	// 		$stripe = new \Stripe\StripeClient('sk_test_51N3ChaKsn6QQRGauJs2sKutBtJOtnB9uJnVlK81SdFbjXRkfbmjO5fDHP04VBo4XutlgZHd3TgCu72B7cdCBrWsW00JZYN37lk');
// 	// 		$updated=$stripe->customers->updateSource($request->customer_id,$request->card_id,['name' => $request->name]);
// 	// 		return response()->json($updated);
			
		  
// 	// 	}catch(\Exception $e){
// 	// 		return response()->json(['message' => $e->getMessage(),'status'=>'failed'],400);  
// 	// 	}
//     // }
   
//    //delete the cards
//     // public function deleteCard(Request $request){
//     //     try{
//     //         $validator = Validator::make($request->all(),[
//     //             "customer_id"	=>"required",
//     //             "card_id"		=>"required"
//     //         ]);
//     //         if($validator->fails()){
//     //             $response = $validator->messages();
//     //             return response()->json(["error_msg" => $response, "status" => "Failed","data"=>NULL],400);
//     //         }
//     //         // Get the card id and customer id from your database or from request body
//     //         $card_id = $request->card_id;
//     //         $customer_id = $request->customer_id;
//     //         // Connect to your stripe account

//     //         $stripe_account = Config('constants.stripe_account');
//     //         $stripe_secret = $stripe_account['secret'];

//     //         $stripe = new \Stripe\StripeClient(
//     //         $stripe_secret
//     //         );

//     //         $delete_response = $stripe->customers->deleteSource(
//     //         $customer_id,
//     //         $card_id,
//     //         []
//     //         );
//     //         return $delete_response;
//     //     }
//     //     catch(\Exception $e){
//     //         return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]); 
//     //     }
//     // }
	
// 	//makePayments
// 	public function makePayment(){
// 		try{
// 			// $validator = Validator::make($request->all(),[
// 			// 	"collective_id"	=>"required",
// 			// 	"team_id"		=>"required",
// 			// 	"amount"		=>"required",
// 			// 	"message"		=>"required",
// 			// 	"card_id"		=>"required"
// 			// ]);
// 			// if($validator->fails()){
// 			// 	$response = $validator->messages();
// 			// 	return response()->json(["error_msg" => $response, "status" => "Failed","data"=>NULL],400);
// 			// }
// 			// dd('makePayment');
// 			$cardId=$this->createStripeUser();
// 			$charge = $this->createCharge($cardId['card_id'], '200', 'First transaction', $cardId['customer_id']);
// 			$user = User::whereId(1)->first();
// 			\App\Models\Payment::updateOrCreate([
// 				'transaction_id'	=> $charge['balance_transaction']
// 			],[
// 				'transaction_id'	=> 	$charge['balance_transaction'],
// 				'customer_id'		=>	$charge['customer'],
// 				'card_id'			=>	$charge['customer'],
// 				'user_id'			=>	$user->id,
// 				'amount'			=>	'200',
// 				'message'			=>	'First transaction',
// 				'status'			=>	$charge['status'],
// 				'response'			=>	json_encode($charge),
// 				'payment_datetime'	=>	$charge->created,
// 				// 'collective_id'		=>	$request->collective_id,
// 				// 'team_id'			=>	$request->team_id
// 			]);
// 			$data=[
// 				'transaction_id'	=> $charge['balance_transaction'],
// 				'customer_id'		=>	$charge['customer'],
// 				'amount'			=>	'200',
// 				'status'			=>	$charge['status'],
// 			];
// 			return response()->json(['message'=>"Payment has been successfully completed.",'status'=>'success','data'=>$data],200);
// 		}
// 		catch(\Exception $e){
// 			return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
// 		}
// 	}
	
// 	// (private)
// 	public function createCharge($source, $amount,$message,$customerId)
//     {
//         $charge = null;
//         try {
// 			$charge = Stripe\Charge::create ([
//                 "amount" => $amount * 100,
//                 "currency" => "inr",
//                 "source" => $source,
//                 "description" => $message ,
// 				"customer" => $customerId
// 			]);
//         } catch (Exception $e) {
//             $charge['error'] = $e->getMessage();
//         }
//         // dd($charge);
//         return $charge;
//     }
	
// 	//retrieve card details
// 	// public function cardDetails($customer_id,$card_id){
// 	// 	$cardDetails = $this->stripe->customers->retrieveSource($customer_id,$card_id,[]); 
// 	// 	return $cardDetails;
// 	// }
	
	
	
// 	//llist all the transaactions
// 	// public function transactionList(Request $request){
// 	// 	$allTransactions=\App\Models\Payment::orderBy('id','DESC');
// 	// 	if(Auth::user()->role_id==2){
// 	// 		$allTransactions=$allTransactions->where('collective_id',Auth::user()->id);
// 	// 	}else if(Auth::user()->role_id==4){
// 	// 		$allTransactions=$allTransactions->where('collective_id',$request->collective_id);
// 	// 	}else{
// 	// 		$allTransactions=$allTransactions->where('user_id',Auth::user()->id);
// 	// 	}
		
// 	// 	if(isset($request->team_id)){
// 	// 		$allTransactions=$allTransactions->where('team_id',$request->team_id);
// 	// 	}
		
// 	// 	$allTransactions=$allTransactions->where('status','succeeded');
	
//     //     // 	---- total amount 
// 	//     $all_data = $allTransactions->get();
//     // 	    $total_amount = 0;
//     // 	    foreach($all_data as $value){
//     // 	        $total_amount  += $value->amount ;
//     // 	    }
//     //     // --- End total amount
	
// 	//     if(isset($request->get_raised)){
// 	//         $data = array('status'=>'success','msg'=>'Stripe raised amount.');
//     // 	    $data['amount_raised'] = $total_amount;
//     // 	    return response()->json($data,200);
// 	//     }

// 	//     $allTransactions=$allTransactions->paginate(15)->toarray();
// 	// 	if(count($allTransactions['data'])>0){
// 	// 		foreach($allTransactions['data'] as $key=>$data){
// 	// 			if($data['collective_id'] !='' && $data['team_id']!=''){
// 	// 				$collective	=	\App\Models\User::find($data['collective_id']);
// 	// 				$team		=	\App\Models\Team::find($data['team_id']);
// 	// 				$allTransactions['data'][$key]['collective_name']=$collective->first_name." ".$collective->last_name;
// 	// 				$userId=$data['user_id'];
// 	// 				$contributor=\App\Models\User::find($userId);
// 	// 				$allTransactions['data'][$key]['contributor_name']=$contributor->first_name." ".$contributor->last_name;
// 	// 				$allTransactions['data'][$key]['contributor_id']=$userId;
// 	// 				$allTransactions['data'][$key]['team_name']=$team->team_name;
// 	// 				$allTransactions['data'][$key]['created_at']=date('m-d-y H:i:s',strtotime($allTransactions['data'][$key]['created_at']));
// 	// 				$allTransactions['data'][$key]['updated_at']=date('m-d-y H:i:s',strtotime($allTransactions['data'][$key]['updated_at']));
// 	// 			}
// 	// 		}
// 	// 	}
// 	// 	return response()->json([
// 	// 		'message'=>'Transactions fetched successfully.',
// 	// 		'status'=>'success',
// 	// 		'total_amount'=>$total_amount,
// 	// 		'data'=>\App\Http\Resources\TransactionResource::collection($allTransactions['data'])
// 	// 	],200);
		
// 	// }
// }












