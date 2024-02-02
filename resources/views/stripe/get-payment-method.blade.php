<!DOCTYPE html>
<html>
   <head>
      <title>How To Integrate Stripe Payment Gateway In Laravel 8</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container mt-5">         
         <div class="row">
            <div class="col-md-12">
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

                     <table class="table table-bordered">
                        <tr>
                           <th>Card Type</th>
                           <th>CVC</th>
                           <th>Expire Month</th>
                           <th>Expire Year</th>
                           <th>Last 4 digit of card</th>
                        </tr>
                        <tr>
                           <td>{{ $cardDetails->type }}</td>
                           <td>{{ $cardDetails->card['cvc'] }}</td>
                           <td>{{ $cardDetails->card['exp_month'] }}</td>
                           <td>{{ $cardDetails->card['exp_year'] }}</td>
                           <td>{{ $cardDetails->card['last4'] }}</td>
                           {{-- <td>{{ dd($cardDetails) }}</td> --}}
                        </tr>
                     </table>
                     
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