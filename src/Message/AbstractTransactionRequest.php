<?php
/**
 * Allsecure Exchange Abstract Request
 */

namespace Omnipay\AllsecureExchange\Message;

use Omnipay\Common\CreditCard;
use Omnipay\AllsecureExchange\Customer;
use Omnipay\AllsecureExchange\InvalidParameterException;
use Omnipay\AllsecureExchange\Schedule;
use Omnipay\AllsecureExchange\ThreeDSecureData;

/**
 * Allsecure Exchange Abstract Transaction Request
 *
 * This class forms the base class for all transaction requests
 *
 * @link https://asxgw.com/documentation/apiv3
 */
abstract class AbstractTransactionRequest extends AbstractRequest
{

    /**
     * Set default parameters after initializing
     */
    protected function setDefaultParameters()
    {
        if(!$this->getCustomer()) {
            $this->setCustomer(new Customer());
        }

        if(!$this->getMerchantTransactionId()) {
            $this->setMerchantTransactionId($this->getDefaultMerchantTransactionId());
        }
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setDefaultMerchantTransactionIdPrefix($value)
    {
        return $this->setParameter('defaultMerchantTransactionIdPrefix', $value);
    }

    /**
     * Get default merchantTransactionId
     *
     * @return string
     */
    public function getDefaultMerchantTransactionId()
    {
        $prefix = $this->getDefaultMerchantTransactionIdPrefix();

        return uniqid($prefix);
    }

    /**
     * @return mixed
     */
    public function getMerchantTransactionId()
    {
        return $this->getParameter('merchantTransactionId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantTransactionId($value)
    {
        return $this->setParameter('merchantTransactionId', $value);
    }

    /**
     * @return mixed
     */
    public function getAdditionalId1()
    {
        return $this->getParameter('additionalId1');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAdditionalId1($value)
    {
        return $this->setParameter('additionalId1', $value);
    }

    /**
     * @return mixed
     */
    public function getAdditionalId2()
    {
        return $this->getParameter('additionalId1');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAdditionalId2($value)
    {
        return $this->setParameter('additionalId1', $value);
    }

    /**
     * @return mixed
     */
    public function getExtraData()
    {
        return $this->getParameter('extraData');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setExtraData($value)
    {
        return $this->setParameter('extraData', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantMetaData()
    {
        return $this->getParameter('merchantMetaData');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantMetaData($value)
    {
        return $this->setParameter('merchantMetaData', $value);
    }

    /**
     * @return mixed
     */
    public function getReferenceUuid()
    {
        return $this->getParameter('referenceUuid');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReferenceUuid($value)
    {
        return $this->setParameter('referenceUuid', $value);
    }

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->getParameter('successUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSuccessUrl($value)
    {
        return $this->setParameter('successUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->getParameter('cancelUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCancelUrl($value)
    {
        return $this->setParameter('cancelUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getErrorUrl()
    {
        return $this->getParameter('errorUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setErrorUrl($value)
    {
        return $this->setParameter('errorUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getCallbackUrl()
    {
        return $this->getParameter('callbackUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCallbackUrl($value)
    {
        return $this->setParameter('callbackUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getTransactionToken()
    {
        return $this->getParameter('transactionToken');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTransactionToken($value)
    {
        return $this->setParameter('transactionToken', $value);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->getParameter('description');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     * @return mixed
     */
    public function getWithRegister()
    {
        return $this->getParameter('withRegister');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setWithRegister($value)
    {
        return $this->setParameter('withRegister', $value);
    }

    /**
     * @return mixed
     */
    public function getTransactionIndicator()
    {
        return $this->getParameter('transactionIndicator');
    }

    /**
     * Possible Values:
     * SINGLE, INITIAL, RECURRING, CARDONFILE, CARDONFILE-MERCHANT-INITIATED or MOTO
     *
     * @param $value
     * @return AbstractRequest
     * @throws InvalidParameterException
     */
    public function setTransactionIndicator($value)
    {
        $value = strtoupper($value);
        if(!in_array($value, [
            self::TRANSACTION_INDICATOR_SINGLE,
            self::TRANSACTION_INDICATOR_INITIAL,
            self::TRANSACTION_INDICATOR_RECURRING,
            self::TRANSACTION_INDICATOR_CARDONFILE,
            self::TRANSACTION_INDICATOR_CARDONFILE_MERCHANT_INITIATED,
            self::TRANSACTION_INDICATOR_MOTO,
        ])) {
            throw new InvalidParameterException('Invalid value on transaction indicator');
        }

        return $this->setParameter('transactionIndicator', $value);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLanguage($value)
    {
        $value = strtolower($value);
        if(strlen($value) > 2) {
            throw new InvalidParameterException('Invalid value on language. Maximum of 2 characters.');
        }

        return $this->setParameter('language', $value);
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCustomer($value)
    {
        if ($value && !$value instanceof Customer) {
            $value = new Customer($value);
        }

        return $this->setParameter('customer', $value);
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->getParameter('schedule');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSchedule($value)
    {
        if ($value && !$value instanceof Schedule) {
            $value = new Schedule($value);
        }

        return $this->setParameter('schedule', $value);
    }

    /**
     * @return mixed
     */
    public function getThreeDSecureData()
    {
        return $this->getParameter('threeDSecureData');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setThreeDSecureData($value)
    {
        if ($value && !$value instanceof ThreeDSecureData) {
            $value = new ThreeDSecureData($value);
        }

        return $this->setParameter('threeDSecureData', $value);
    }

    /**
     * This base data is always there on every transaction request payload
     *
     * @return array
     */
    protected function getBaseData()
    {
        $data = array();

        $data['merchantTransactionId'] = $this->getMerchantTransactionId();

        if($additionalId1 = $this->getAdditionalId1()) {
            $data['additionalId1'] = $additionalId1;
        }

        if($additionalId2 = $this->getAdditionalId2()) {
            $data['additionalId2'] = $additionalId2;
        }

        if($extraData = $this->getExtraData()) {
            $data['extraData'] = $extraData;
        }

        if($merchantMetaData = $this->getMerchantMetaData()) {
            $data['merchantMetaData'] = $merchantMetaData;
        }

        return $data;
    }

    /**
     * Get the customer data payload
     *
     * @return array|null
     */
    protected function getCustomerData()
    {
        $customer = $this->getCustomer();

        if($customer) {
            return $customer->getData();
        }

        return null;
    }

    /**
     * Get item data payload
     *
     * @return array
     */
    protected function getItemData()
    {
        $itemArray = array();
        $items = $this->getItems();
        if ($items) {
            foreach ($items as $item) {
                $data = array();
                $data['identification'] = strval($item->getIdentification());
                $data['name'] = strval($item->getName());
                $data['description'] = strval($item->getDescription());
                $data['quantity'] = strval($item->getQuantity());
                $data['price'] = strval($item->getPrice());
                $data['currency'] = strval($item->getCurrency());
                $data['extraData'] = $item->getExtraData();
                $itemArray[] = $data;
            }
        }

        return $itemArray;
    }

    /**
     * Get the schedule data payload
     *
     * @return array|null
     */
    protected function getScheduleData()
    {
        $schedule = $this->getSchedule();

        if($schedule) {
            return $schedule->getData();
        }

        return null;
    }

    /**
     * Get the customer data payload
     *
     * @return array|null
     */
    protected function getThreeDSecureDataData()
    {
        $threeDSecureDate = $this->getThreeDSecureData();

        if($threeDSecureDate) {
            return $threeDSecureDate->getData();
        }

        return null;
    }

    /**
     * Sets the card.
     * Override this method to use Customer object instead
     *
     * @param CreditCard $value
     * @return \Omnipay\Common\Message\AbstractRequest Provides a fluent interface
     */
    public function setCard($value)
    {
        if ($value) {
            if($value instanceof CreditCard) {
                $customer = new Customer();
                $customer->initializeFromCreditCard($value);
            } else {
                $customer = new Customer($value);
            }

            $this->setParameter('customer', $customer);
        }

        return $this->setParameter('card', $value);
    }

    /**
     * Sets the card reference (some kind of saved card mechanism)
     *
     * @param string $value
     * @return \Omnipay\Common\Message\AbstractRequest Provides a fluent interface
     */
    public function setCardReference($value)
    {
        // Allsecure Exchange uses referenceUuid of the previous transaction or the stored uui that has been "register"ed
        $this->setReferenceUuid($value);

        return $this->setParameter('cardReference', $value);
    }

    /**
     * Set the payment data of a customer
     *
     * @param mixed $value
     * @return \Omnipay\Common\Message\AbstractRequest Provides a fluent interface
     */
    public function setPaymentData($value)
    {
        return $this->getCustomer()->setPaymentData($value);
    }

    /**
     * Set the payment data of a customer
     *
     * @return PaymentData|null
     */
    public function getPaymentData()
    {
        return $this->getCustomer()->getPaymentData();
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     * @throws \Exception
     */
    public function sendData($data)
    {
        $jsonBody = json_encode($data);

        // This request uses the REST endpoint and requires the JSON content type header
        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), $this->buildHeaders($jsonBody), $jsonBody);

        return $this->response = new Response($this, json_decode($httpResponse->getBody()->getContents(), true));
    }

    /**
     * Generate additional headers that are used when sending Allsecure Exchange
     *
     * @param $jsonBody
     * @return array
     * @throws \Exception
     */
    protected function buildHeaders($jsonBody)
    {
        $url = $this->getEndpoint();

        $timestamp = (new \DateTime('now', new \DateTimeZone('UTC')))->format('D, d M Y H:i:s T');

        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        $anchor = parse_url($url, PHP_URL_FRAGMENT);

        $requestUri = $path . ($query ? '?' . $query : '') . ($anchor ? '#' . $anchor : '');

        $contentType = 'application/json';

        $hashedJsonBody = hash('sha512', $jsonBody);

        $parts = array('POST', $hashedJsonBody, $contentType, $timestamp, $requestUri);

        $str = join("\n", $parts);
        $digest = hash_hmac('sha512', $str, $this->getSecretKey(), true);
        $signature = base64_encode($digest);

        $headers = array(
            'Date' => $timestamp,
            'X-Date' => $timestamp,
            'X-Signature' => $signature,
            'Content-Type' => $contentType,
            'Accept' => $contentType,
            'Authorization' => "Basic " . base64_encode($this->getUsername() . ":" . $this->getPassword()),
        );

        return $headers;
    }

    /**
     * Get the base endpoint + API key
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointBase() . 'transaction/' . $this->getApiKey();
    }

}
