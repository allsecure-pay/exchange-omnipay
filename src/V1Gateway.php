<?php
/**
 * Allsecure Open Gateway
 */

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Helper;

/**
 * Allsecure Open Gateway for V1 APIs
 *
 * Description here
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Allsecure Open REST Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('AllsecureExchange_V1');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'apiKey' => 'your-api-key',
 *     'secretKey' => 'your-secret-key',
 *     'username' => 'your-username',
 *     'password' => 'your-password',
 *     'testMode'  => TRUE, // or FALSE when you are ready for live transactions
 *     'defaultMerchantTransactionIdPrefix'  => 'omnipay-', // prefix of the merchantTransactionId (optional)
 *      'bearer' => 'bearer token',
 *      'entityId' => 'entity ID',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 * 'amount'                => '12.00',
 * 'currency'              => 'EUR',
 * 'description'           => 'your order of widgets',
 * 'paymentBrand'          => 'VISA',
 * 'paymentType'           => 'PA',
 * 'bankAccountCountry'    => 'UK',
 * 'returnUrl'             => 'URL where you want to get redirected',
 * ));
 * $response = $transaction->send();

 *  if ($response->isPending()) {
 *      echo "Purchase transaction was successful!, Order is in Pending state";
 *      echo '<br>';
 *      $sale_id = $response->getTransactionReference();
 *      echo "Transaction reference = " . $sale_id . "\n";
 *      echo '<br>';
 *      if($response->isRedirect()) {
 *          echo "Redirecting to: <a target='_blank' href='{$response->getRedirectUrl()}'>" . $response->getRedirectUrl() . "</a>";
 *      }
 *  } else {
 *      echo "Transaction failed";
 *      echo '<br>';
 *      echo $response->getCode();
 *      echo '<br>';
 *      echo $response->getMessage();
 *  }
 * </code>
 *
 * ### Test modes
 *
 * The API has two endpoint host names:
 *
 * * https://eu-prod.oppwa.com/v1/payments/ (live)
 * * https://eu-test.oppwa.com/v1/payments/ (test)
 *
 * The live host is for processing live transactions, whereas the test
 * host can be used for integration testing and development.
 *
 * but you will need separate entityId and bearer Token for both
 *
 * #### Keys
 *
 * Your account has two types of keys (different for each environment):
 *
 * * entityId
 * * bearer TOken
 *
 * @see \Omnipay\Common\AbstractGateway
 * @link https://allsecure.docs.oppwa.com/
 */
class V1Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Allsecure Open V1';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'username' => '',
            'password' => '',
            'testMode' => false,
            'defaultMerchantTransactionIdPrefix' => 'omnipay-',
            'bearer' => '',
            'entityId' => '',
        );
    }

    /**
     * @return mixed
     */
    public function getBearer()
    {
        return $this->getParameter('bearer');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBearer($value)
    {
        return $this->setParameter('bearer', $value);
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->getParameter('entityId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setEntityId($value)
    {
        return $this->setParameter('entityId', $value);
    }

    /**
     * Get API key
     *
     * Calls to the Allsecure Open API must be authenticated using your API key
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
     * Calls to the Allsecure Open API must be authenticated using your API key
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
     * Calls to the Allsecure Open API must be authenticated using your Secret key
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
     * Calls to the Allsecure Open API must be authenticated using your Secret key
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
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\V1\PurchaseRequest', $parameters);
    }

    /**
     * Get transaction status by uuid via V1 API
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\V1\TransactionStatusByUuidRequest
     */
    public function getTransactionStatusByUuid(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AllsecureExchange\Message\V1\TransactionStatusByUuidRequest', $parameters);
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
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * Create a capture request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        throw new \BadMethodCallException('Not implemented');
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
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * Create a refund request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        throw new \BadMethodCallException('Not implemented');
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
        throw new \BadMethodCallException('Not implemented');
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
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * Create a payout request
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\PayoutRequest
     */
    public function payout(array $parameters = array())
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * Get transaction status by merchantTransactionId
     *
     * @param array $parameters
     * @return \Omnipay\AllsecureExchange\Message\TransactionStatusByMerchantTransactionIdRequest
     */
    public function getTransactionStatusByMerchantTransactionId(array $parameters = array())
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
