<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PhonepeController, PayPalController, StripeController, StripesController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//phonepe
Route::controller(PhonepeController::class)->prefix('phonepe')->as('phonepe.')->group(function () {
    Route::get('g-pay', 'gpay');
});
//paypal by ItSolutionStuff
//https://www.itsolutionstuff.com/post/laravel-58-paypal-integration-tutorialexample.html#google_vignette
Route::controller(PayPalController::class)->prefix('paypal')->as('paypal.')->group(function () {
    Route::get('payment', 'payment')->name('payment');
    Route::get('cancel', 'cancel')->name('payment.cancel');
    Route::get('payment/success', 'success')->name('payment.success');
});
//paypal by medium
//https://medium.com/geekculture/paypal-payment-gateway-integration-with-laravel-ebebc7ccf470
Route::controller(PayPalController::class)->prefix('paypal')->as('paypal.')->group(function () {
    Route::get('create-transaction', 'createTransaction')->name('createTransaction');
    Route::get('process-transaction', 'processTransaction')->name('processTransaction');
    Route::get('success-transaction', 'successTransaction')->name('successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('cancelTransaction');
});
//stripe
Route::controller(StripesController::class)->prefix('stripe')->as('stripe.')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::post('/payment', 'payment')->name('payment');
});
//stripe
Route::controller(StripeController::class)->prefix('stripe')->as('stripe.')->group(function () {
    Route::get('create-payment-method', 'createPaymentMethodp')->name('createPaymentMethodp');
    Route::post('create-payment-method', 'createPaymentMethod')->name('createPaymentMethod');
    Route::get('get-payment-method', 'getPaymentMethod')->name('getPaymentMethod');
    Route::get('edit-payment-method', 'editPaymentMethod')->name('editPaymentMethod');
    Route::post('update-payment-method/{payment_method_id}', 'updatePaymentMethod')->name('updatePaymentMethod');

    Route::get('create-customer', 'createCustomerp')->name('createCustomerp');
    Route::post('create-customer', 'createCustomer')->name('createCustomer');

    Route::get('attach-payment-method', 'attachPaymentMethod')->name('attachPaymentMethod');

    Route::get('make-payment', 'makePaymentp')->name('makePaymentp');
    Route::post('make-payment', 'makePayment')->name('makePayment');

    Route::get('payment', 'makePayment');
});
