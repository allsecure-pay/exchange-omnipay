# Omnipay: AllSecure Exchange

**Allsecure Exchange driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements AllSecure support for Omnipay.

[Allsecure](https://www.allsecure.eu/) was founded in 2005 with the primary focus of helping technology vendors and their customers streamline their payments acceptance and operations.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "allsecure-pay/exchange-omnipay": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

### Initializing Gateway

```php
// Create a gateway
$gateway = Omnipay::create('AllsecureExchange');

// Initialise the gateway
$gateway->initialize(array(
    'apiKey' => 'your-api-key',
    'secretKey' => 'your-secret-key',
    'username' => 'your-username',
    'password' => 'your-password',
    'testMode'  => TRUE, // or FALSE when you are ready for live transactions
    'defaultMerchantTransactionIdPrefix'  => 'omnipay-', // prefix of the merchantTransactionId (optional)
));
```

**Note!** There will be different **API Key** for different payment channels


### Purchase Transaction

**Debit** on Allsecure Exchange Documentation

```php
try {
    // You need to define your own $formData array
    $card = new CreditCard($formData);
    
    $request = $gateway->purchase([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'card' => $card,
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code

You can also pass `transactionToken` on the payload if you receive a token using Allsecure Exchange `payment.js`

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-debit)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Authorize Transaction

**Preauthorize** in Allsecure Exchange Documentation

A Preauthorize reserves the payment amount on the customer's payment instrument.

Depending on the payment method you have up to 7 days until you must Capture the transaction before the authorization expires.

```php
try {
    // You need to define your own $formData array
    $card = new CreditCard($formData);
    
    $request = $gateway->authorize([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'card' => $card,
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```


Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code

You can also pass `transactionToken` on the payload if you receive a token using Allsecure Exchange `payment.js`

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-preauthorize)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Capture Transaction

A Capture completes the payment which was previously authorized with the Preauthorize method.

Depending on the payment method you can even capture only a partial amount of the authorized amount.

```php
try {
    // You need to define your own $formData array
    $card = new CreditCard($formData);
    
    $request = $gateway->capture([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'card' => $card,
        'referenceUuid' => 'bcdef23456bcdef23456', // UUID / transaction reference of a preauthorize
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code
`referenceUuid` | UUID / transaction reference of a preauthorize

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-capture)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Purchase Transaction

**Debit** in Allsecure Exchange Documentation

```php
try {
    // You need to define your own $formData array
    $card = new CreditCard($formData);
    
    $request = $gateway->purchase([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'card' => $card,
        'returnUrl' => 'https://www.example.com/return', // optional
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-debit)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Authorize Transaction

**Preauthorize** on Allsecure Exchange Documentation

A Preauthorize reserves the payment amount on the customer's payment instrument.

Depending on the payment method you have up to 7 days until you must Capture the transaction before the authorization expires.

```php
try {
    // You need to define your own $formData array
    $card = new CreditCard($formData);
    
    $request = $gateway->authorize([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'card' => $card,
        'returnUrl' => 'https://www.example.com/return', // optional
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```


Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-preauthorize)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Capture Transaction

A Capture completes the payment which was previously authorized with the Preauthorize method.

Depending on the payment method you can even capture only a partial amount of the authorized amount.

```php
try {

    $request = $gateway->capture([
        'amount' => '10.00', // this represents €10.00
        'currency' => 'EUR',
        'referenceUuid' => 'bcdef23456bcdef23456', // UUID / transaction reference of a preauthorize
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code
`referenceUuid` | UUID / transaction reference of a preauthorize

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-capture)


### Void Transaction

A Void cancels a previously performed authorization made with the Preauthorize method.

```php
try {

    $request = $gateway->void([
        'referenceUuid' => 'bcdef23456bcdef23456', // UUID / transaction reference of a preauthorize
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`referenceUuid` | UUID / transaction reference of a preauthorize

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-void)


### Create Card Transaction

**Register** in Allsecure Exchange Documentation

Registers a customer's payment instrument for future charges (Debits or Preauthorizations)

```php
try {

    // You need to define your own $formData array
    $card = new CreditCard($formData);

    $request = $gateway->createCard([
        'card' => $card,
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-capture)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Delete Card Transaction

**Deregister** in Allsecure Exchange Documentation

A Deregister deletes a previously registered payment instrument using Register.

```php
try {

    // You need to define your own $formData array
    $card = new CreditCard($formData);

    $request = $gateway->deleteCard([
        'referenceUuid' => 'ccf0ddd790db9d7ef41b',
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`referenceUuid` | UUID of a register, debit-with-register or preauthorize-with-register

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-capture)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Refund Transaction

A Refund reverses a payment which was previously performed with Debit or Capture.

Depending on the payment method you can even refund only a partial amount of the original transaction amou

```php
try {

    $request = $gateway->refund([
        'amount'                => '1.25',
        'currency'              => 'EUR',
        'referenceUuid'         => '48bbd15cdf9e5b81985d',
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here
        // Use $response->getTransactionReference() to get transaction uuid

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```

Required Fields | Notes
--- | ---
`merchantTransactionId` | Your unique transaction ID. If left blank, default one will be used |
`amount` | Decimals separated by ., max. 3 decimals
`currency` | 3 letter currency code
`referenceUuid` | UUID of a register, debit-with-register or preauthorize-with-register

For more information about the payload, refer to: [Allsecure Exchange Documentation](https://asxgw.com/documentation/apiv3#transaction-request-capture)

For more information about the card data, refer to: [Omnipay Credit Card Documentation](https://github.com/thephpleague/omnipay/tree/v2.3.1#credit-card--payment-form-input)


### Payout Transaction

Coming soon


### Incremental Authorization

Coming soon


## The Payment Responses

### Successful Response

For a successful responses, a reference will normally be generated, which can be used to capture or refund the transaction at a later date. The following methods are always available:

```php
$response = $gateway->purchase([
    'amount' => '10.00', 
    'currency' => 'EUR', 
    'card' => $card
])->send();

$response->isSuccessful(); // is the response successful?
$response->isRedirect(); // is the response a redirect?
$response->getTransactionReference(); // a transaction uuid generated by the payment gateway
$response->getMessage(); // a message generated by the payment gateway
```

If you are going to implement refund and void, you will need to always save the transaction reference since it is often used as `referenceUuid`.


### Redirect Response

After processing a payment, the cart should check whether the response requires a redirect, and if so, redirect accordingly:

```php
$response = $gateway->purchase([
    'amount' => '10.00', 
    'currency' => 'EUR', 
    'card' => $card
])->send();

if ($response->isSuccessful()) {
    // payment is complete
} elseif ($response->isRedirect()) {
    $response->redirect(); // this will automatically forward the customer
} else {
    // not successful
}
```

The customer isn't automatically forwarded on, because often the cart or developer will want to customize the redirect method (or if payment processing is happening inside an AJAX call they will want to return JS to the browser instead).

To display your own redirect page, simply call `getRedirectUrl()` on the response, then display it accordingly:

```php
$url = $response->getRedirectUrl();
```


### Error Response

You can test for a successful response by calling `isSuccessful()` on the response object. If there was an error communicating with the gateway, or your request was obviously invalid, an exception will be thrown. In general, if the gateway does not throw an exception, but returns an unsuccessful response, it is a message you should display to the customer. If an exception is thrown, it is either a bug in your code (missing required fields), or a communication error with the gateway.

The simplest way is to wrap the entire request in a try-catch block.

```php
try {

    $request = $gateway->refund([
        'amount'                => '1.25',
        'currency'              => 'EUR',
        'referenceUuid'         => '48bbd15cdf9e5b81985d',
    ]);
    
    $response = $transaction->send();

    if ($response->isSuccessful()) {

        // Do stuff here like marking order as complete

    } else {

        // Handle errors

    }

} catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

    // Handle Exception Errors (use $e->getResponse()->getBody() to get JSON data)

} catch (\Exception $e) {

    // Handle Exception Errors (use $e->getMessage() to get data)

}
```


## Advanced Usage

### Using Customer instead of CreditCard

Coming soon

### Schedule

Coming soon

### Accepting Notification

Coming soon

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/allsecure-pay/omnipay-allsecureexchange/issues),
or better yet, fork the library and submit a pull request.
