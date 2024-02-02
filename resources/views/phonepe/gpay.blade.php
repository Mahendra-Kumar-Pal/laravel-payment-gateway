<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Pay</title>
    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
</head>
<body>

    <button id="google-pay-button">Google Pay</button>

    <script>
        const paymentsClient = new google.payments.api.PaymentsClient({
            environment: 'TEST',
            merchantInfo: {
                merchantId: 'your_merchant_id_here',
                merchantName: 'Your Merchant Name'
            }
        });
    </script>

    <script>
        document.getElementById('google-pay-button').addEventListener('click', () => {
            const paymentDataRequest = {
                apiVersion: 2,
                apiVersionMinor: 0,
                allowedPaymentMethods: [
                    {
                        type: 'CARD',
                        parameters: {
                            allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                            allowedCardNetworks: ['AMEX', "DISCOVER", "INTERAC", "JCB", "MASTERCARD",  'VISA']
                        },
                        tokenizationSpecification: {
                            type: 'PAYMENT_GATEWAY',
                            parameters: {
                                gateway: 'your_payment_gateway_here'
                            }
                        }
                    }
                ],
                merchantInfo: {
                    merchantId: 'your_merchant_id_here',
                    merchantName: 'Your Merchant Name'
                },
                transactionInfo: {
                    totalPriceStatus: 'FINAL',
                    totalPriceLabel: 'Total',
                    totalPrice: '10.00',
                    currencyCode: 'USD'
                }
            };

            const paymentDataRequestJson = JSON.stringify(paymentDataRequest);

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then((paymentData) => {
                    // Handle payment data
                })
                .catch((err) => {
                    // Handle error
                });
        });
    </script>

    {{-- from google --}}
    {{-- <script>
        const tokenizationSpecification = {
            type: 'PAYMENT_GATEWAY',
            parameters: {
                'gateway': 'acceptblue',
                'gatewayMerchantId': 'YOUR_GATEWAY_MERCHANT_ID'
            }
        };
        const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
        const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

        // Describe your allowed payment methods
        const baseCardPaymentMethod = {
            type: 'CARD',
            parameters: {
                allowedAuthMethods: allowedCardAuthMethods,
                allowedCardNetworks: allowedCardNetworks
            }
        };
        const cardPaymentMethod = Object.assign(
            {tokenizationSpecification: tokenizationSpecification},
            baseCardPaymentMethod
        );
    </script> --}}

    {{-- Load the Google Pay API JavaScript library --}}
    {{-- <script async src="https://pay.google.com/gp/p/js/pay.js" onload="console.log('TODO: add onload function')"></script> --}}

    {{-- <script>
        const paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});

        // Determine readiness to pay with the Google Pay API
        const isReadyToPayRequest = Object.assign({}, baseRequest);
        isReadyToPayRequest.allowedPaymentMethods = [baseCardPaymentMethod];

        paymentsClient.isReadyToPay(isReadyToPayRequest)
        .then(function(response) {
            if (response.result) {
                // add a Google Pay payment button
            }
        })
        .catch(function(err) {
            // show error in developer console for debugging
            console.error(err);
        });

        // Add a Google Pay payment button
        const button = paymentsClient.createButton({onClick: () => console.log('TODO: click handler'), allowedPaymentMethods: []}); // same payment methods as for the loadPaymentData() API call
        document.getElementById('container').appendChild(button);

        // Create a PaymentDataRequest object
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = {
            totalPriceStatus: 'FINAL',
            totalPrice: '123.45',
            currencyCode: 'USD',
            countryCode: 'US'
        };
        paymentDataRequest.merchantInfo = {
            merchantName: 'Example Merchant'
            merchantId: '12345678901234567890'
        };

        // Register an event handler for user gestures
        paymentsClient.loadPaymentData(paymentDataRequest).then(function(paymentData){
                // if using gateway tokenization, pass this token without modification
                paymentToken = paymentData.paymentMethodData.tokenizationData.token;
            }).catch(function(err){
                // show error in developer console for debugging
                console.error(err);
        });
    </script> --}}

</body>
</html>