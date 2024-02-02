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

                     <form role="form" action="{{ route('updatePaymentMethod', $payment_method_id[0]) }}" method="post" class="require-validation" id="payment-form">
                        @csrf

                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Name on Card</label> 
                              <input class='form-control' size='4' type='text' name="card_type" value="{{ $cardDetails->type }}">
                           </div>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Card Number</label> 
                              <input autocomplete='off' class='form-control card-number' value="{{ $cardDetails->card['last4'] }}" size='20' type='text' name="card_number">
                           </div>                           
                        </div>   

                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-4 form-group cvc required'>
                              <label class='control-label'>CVC</label> 
                              <input autocomplete='off' value="{{ $cardDetails->card['cvc'] }}" class='form-control card-cvc' placeholder='Ex. 311' size='4' type='text' name='cvv'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Month</label> 
                              <input class='form-control card-expiry-month' value="{{ $cardDetails->card['exp_month'] }}" placeholder='MM' size='2' type='text' name='exp_month'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Year</label> 
                              <input class='form-control card-expiry-year' value="{{ $cardDetails->card['exp_year'] }}" placeholder='YYYY' size='4' type='text' name='exp_year'>
                           </div>
                        </div>        

                        <div class="form-row row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
                           </div>
                        </div>
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   {{-- </body> <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}
   <script type="text/javascript">
      // $(function() {
      //    var $form = $(".require-validation");
      //    $('form.require-validation').bind('submit', function(e) {
      //       var $form = $(".require-validation"),
      //       inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
      //       $inputs = $form.find('.required').find(inputSelector),
      //       $errorMessage = $form.find('div.error'),
      //       valid = true;
      //       $errorMessage.addClass('hide');
      //       $('.has-error').removeClass('has-error');
      //       $inputs.each(function(i, el) {
      //             var $input = $(el);
      //             if ($input.val() === '') {
      //                $input.parent().addClass('has-error');
      //                $errorMessage.removeClass('hide');
      //                e.preventDefault();
      //             }
      //       });
      //       if (!$form.data('cc-on-file')) {
      //          e.preventDefault();
      //          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      //          Stripe.createToken({
      //             number: $('.card-number').val(),
      //             cvc: $('.card-cvc').val(),
      //             exp_month: $('.card-expiry-month').val(),
      //             exp_year: $('.card-expiry-year').val()
      //          }, stripeResponseHandler);
      //       }
      //    });
      
      //    function stripeResponseHandler(status, response) {
      //       if(response.error) {
      //             $('.error')
      //             .removeClass('hide')
      //             .find('.alert')
      //             .text(response.error.message);
      //       }else {
      //          /* token contains id, last4, and card type */
      //          var token = response['id'];
      //          $form.find('input[type=text]').empty();
      //          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
      //          $form.get(0).submit();
      //       }
      //    }
      // });
   </script>
   <script type="text/javascript">
     
   // $(function() {
     
       /*------------------------------------------
       --------------------------------------------
       Stripe Payment Code
       --------------------------------------------
       --------------------------------------------*/
       
      //  var $form = $(".require-validation");
        
      //  $('form.require-validation').bind('submit', function(e) {
      //      var $form = $(".require-validation"),
      //      inputSelector = ['input[type=email]', 'input[type=password]',
      //                       'input[type=text]', 'input[type=file]',
      //                       'textarea'].join(', '),
      //      $inputs = $form.find('.required').find(inputSelector),
      //      $errorMessage = $form.find('div.error'),
      //      valid = true;
      //      $errorMessage.addClass('hide');
       
      //      $('.has-error').removeClass('has-error');
      //      $inputs.each(function(i, el) {
      //        var $input = $(el);
      //        if ($input.val() === '') {
      //          $input.parent().addClass('has-error');
      //          $errorMessage.removeClass('hide');
      //          e.preventDefault();
      //        }
      //      });
        
      //      if (!$form.data('cc-on-file')) {
      //        e.preventDefault();
      //        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      //        Stripe.createToken({
      //          number: $('.card-number').val(),
      //          cvc: $('.card-cvc').val(),
      //          exp_month: $('.card-expiry-month').val(),
      //          exp_year: $('.card-expiry-year').val()
      //        }, stripeResponseHandler);
      //      }
       
      //  });
         
       /*------------------------------------------
       --------------------------------------------
       Stripe Response Handler
       --------------------------------------------
       --------------------------------------------*/
   //     function stripeResponseHandler(status, response) {
   //         if (response.error) {
   //             $('.error')
   //                 .removeClass('hide')
   //                 .find('.alert')
   //                 .text(response.error.message);
   //         } else {
   //             /* token contains id, last4, and card type */
   //             var token = response['id'];
                    
   //             $form.find('input[type=text]').empty();
   //             $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
   //             $form.get(0).submit();
   //         }
   //     }
        
   // });
   </script>
   </html>