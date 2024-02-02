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
                        <h3>Make Payment</h3>  
                  </div>
                  <div class="card-body">

                     @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                     </div>
                     @endif

                     <form role="form" action="{{ route('makePaymentp') }}" method="post" class="require-validation" id="payment-form">
                        @csrf

                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-12 form-group required'>
                              <label class='control-label'>Enter amount</label> 
                              <input class='form-control' size='4' type='text' name="amount" placeholder="Enter amount">
                           </div>                         
                        </div>  

                        <div class="form-row row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-md btn-block" type="submit">Pay Now</button>
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