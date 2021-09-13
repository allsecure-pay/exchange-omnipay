<?php
/**
 * Allsecure Exchange Abstract Request
 */

namespace Omnipay\AllsecureExchange\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Helper;
use Omnipay\AllsecureExchange\Customer;
use Omnipay\AllsecureExchange\InvalidParameterException;
use Omnipay\AllsecureExchange\Schedule;
use Omnipay\AllsecureExchange\ThreeDSecureData;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Allsecure Exchange Abstract Request
 *
 * This class forms the base class for all transaction requests
 *
 * @link https://asxgw.com/documentation/apiv3
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const TRANSACTION_INDICATOR_SINGLE = 'SINGLE';
    const TRANSACTION_INDICATOR_INITIAL = 'INITIAL';
    const TRANSACTION_INDICATOR_RECURRING = 'RECURRING';
    const TRANSACTION_INDICATOR_CARDONFILE = 'CARDONFILE';
    const TRANSACTION_INDICATOR_CARDONFILE_MERCHANT_INITIATED = 'CARDONFILE-MERCHANT-INITIATED';
    const TRANSACTION_INDICATOR_MOTO = 'MOTO';

    /**
     * @var string
     */
    protected $liveEndpoint = 'https://asxgw.com/api/v3/';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://asxgw.paymentsandbox.cloud/api/v3/';

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     * @throws RuntimeException
     */
    public function initialize(array $parameters = array())
    {
        parent::initialize($parameters);

        $this->setDefaultParameters();

        return $this;
    }

    /**
     * Set default parameters after initializing
     */
    protected function setDefaultParameters()
    {

    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get the base endpoint
     *
     * @return string
     */
    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
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

}
