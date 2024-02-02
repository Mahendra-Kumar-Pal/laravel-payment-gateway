<!DOCTYPE html>
<html>
   <head>
      <title>How To Integrate Stripe Payment Gateway In Laravel 8</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container mt-5">         
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="card panel-default credit-card-box mt-5">
                  <div class="card-header" >
                        <h3>Account Details</h3>  
                  </div>
                  <div class="card-body">

                     @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                     </div>
                     @endif

                     <form role="form" action="{{ route('createPaymentMethod') }}" method="post" class="require-validation" id="payment-form">
                        @csrf

                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Name on Card</label> 
                              <input class='form-control' size='4' type='text' name="card_type">
                           </div>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Card Number</label> 
                              <input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_number">
                           </div>                           
                        </div>   

                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-4 form-group cvc required'>
                              <label class='control-label'>CVC</label> 
                              <input autocomplete='off' class='form-control card-cvc' placeholder='Ex. 311' size='4' type='text' name='cvv'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Month</label> 
                              <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' name='exp_month'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Year</label> 
                              <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name='exp_year'>
                           </div>
                        </div>   

                        <div class="form-row row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-md btn-block" type="submit">Create Now</button>
                           </div>
                        </div>
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   </html>