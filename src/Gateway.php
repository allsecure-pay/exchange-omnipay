<?php
/**
 * Allsecure Exchange Gateway
 */

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Helper;

/**
 * Allsecure Exchange Payments Gateway
 *
 * Description here
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Allsecure Exchange REST Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('AllsecureExchange');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'apiKey' => 'your-api-key',
 *     'secretKey' => 'your-secret-key',
 *     'username' => 'your-username',
 *     'password' => 'your-password',
 *     'testMode'  => TRUE, // or FALSE when you are ready for live transactions
 *     'defaultMerchantTransactionIdPrefix'  => 'omnipay-', // prefix of the merchantTransactionId (optional)
 * ));
 *
 * // Create a credit card object
 * // This card can be used for testing.
 * // See https://pin.net.au/docs/api/test-cards for a list of card
 * // numbers that can be used for testing.
 * $card = new CreditCard(array(
 *     'firstName'       => 'Example',
 *     'lastName'        => 'Customer',
 *     'company'         => 'Visualr',
 *     'email'           => 'customer@example.com',
 *     'billingAddress1' => '1 Scrubby Creek Road',
 *     'billingCity'     => 'Scrubby Creek',
 *     'billingState'    => 'QLD',
 *     'billingPostcode' => '4999',
 *     'billingCountry'  => 'AU',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'description'              => 'Your order for widgets',
 *     'amount'                   => '10.00',
 *     'currency'                 => 'AUD',
 *     'card'                     => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * ### Test modes
 *
 * The API has two endpoint host names:
 *
 * * https://asxgw.com/api/v3/transaction/ (live)
 * * https://asxgw.paymentsandbox.cloud/api/v3/transaction/ (test)
 *
 * The live host is for processing live transactions, whereas the test
 * host can be used for integration testing and development.
 *
 * Each endpoint requires a different set of API keys, which can be
 * found in your account settings.
 *
 * ### Authentication
 *
 * Calls to the Allsecure Exchange API must be authenticated using HTTP
 * basic authentication, with your username and password.
 *
 * #### Keys
 *
 * Your account has two types of keys:
 *
 * * apiKey (different for each payment connector)
 * * secretKey
 *
 * Your apiKey will be different for each payment connector. You will
 * need to ask Allsecure Exchange for a new API key when you are integrating
 * a new payment connector.
 *
 * @see \Omnipay\Common\AbstractGateway
 * @link https://asxgw.com/documentation/apiv3
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Allsecure Exchange';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'username' => '',
            'password' => '',
            'testMode' => false,
            'defaultMerchantTransactionIdPrefix' => 'omnipay-',
        );
    }

    /**
     * Get API key
     *
     * Calls to the Allsecure Exchange API must be authenticated using your API key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set API key
     *
     * Calls to the Allsecure Exchange API must be authenticated using your API key
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get Secret Key
     *
     * Calls to the Allsecure Exchange API must be authenticated using your Secret key
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Set Secret Key
     *
     * Calls to the Allsecure Exchange API must be authenticated using your Secret key
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * @param $value
     * @return Gateway
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param $value
     * @return Gateway
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getDefaultMerchantTransactionIdPrefix()
    {
        return $this->getParameter('defaultMerchantTransactionIdPrefix');
    }

    /**
     * @param $value
     * @return Gateway
     */
    public function setDefaultMerchantTransactionIdPrefix($value)
    {
        return $this->setParameter('defaultMerchantTransactionIdPrefix', $value);
    }

    /**
     * @param string $password
     *
     * @return string
     */
    private function hashPassword($password) {
        for ($i = 0; $i < 10; $i++) {
            $password = sha1($password);
        }
        return $password;
    }

    /**
     * Create a purchase request
     * (which is called debit in their API)
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\PurchaseRequest', $parameters);
    }

    /**
     * Create an authorize request
     * (which is called preauthorize in their API)
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\AuthorizeRequest', $parameters);
    }

    /**
     * Create a capture request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\CaptureRequest', $parameters);
    }

    /**
     * Create a void request
     * This voids the authorized payment
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\VoidRequest', $parameters);
    }

    /**
     * Create a refund request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\RefundRequest', $parameters);
    }

    /**
     * Create a createCard request
     * (which is called register in their API)
     * This registers the payment instrument token
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\RegisterRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\RegisterRequest', $parameters);
    }

    /**
     * Create a deleteCard request
     * (which is called deregister in their API)
     * This removes the registered payment instrument token
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\DeregisterRequest
     */
    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\DeregisterRequest', $parameters);
    }

    /**
     * Create a payout request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\PayoutRequest
     */
    public function payout(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\PayoutRequest', $parameters);
    }

    /**
     * Get transaction status by uuid
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\TransactionStatusByUuidRequest
     */
    public function getTransactionStatusByUuid(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\TransactionStatusByUuidRequest', $parameters);
    }

    /**
     * Get transaction status by merchantTransactionId
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\TransactionStatusByMerchantTransactionIdRequest
     */
    public function getTransactionStatusByMerchantTransactionId(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\TransactionStatusByMerchantTransactionIdRequest', $parameters);
    }
}
