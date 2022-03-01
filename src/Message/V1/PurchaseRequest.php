<?php

namespace Omnipay\AllsecureExchange\Message\V1;

use Omnipay\AllsecureExchange\Message\AbstractTransactionRequest;
/**
 * Class PurchaseRequest
 *
 * @package Omnipay\AllsecureExchange\Message\V1
 */
class PurchaseRequest extends AbstractTransactionRequest
{

    protected $liveEndpoint = 'https://eu-prod.oppwa.com/v1/';

    protected $testEndpoint = 'https://eu-test.oppwa.com/v1/';

    /**
     * Get data for request payload
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('amount', 'currency', 'paymentBrand', 'paymentType', 'returnUrl');

        $data = $this->getBaseData();
        $data['entityId'] = $this->getEntityId();
        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['paymentBrand'] = $this->getPaymentBrand();
        $data['paymentType'] = $this->getPaymentType();
        $data['bankAccount.country'] = $this->getBankAccountCountry();
        $data['shopperResultUrl'] = urlencode($this->getReturnUrl());

        return $data;
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

        $contentType = 'application/x-www-form-urlencoded';

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
            'Authorization' => "Bearer " . $this->getBearer(),
        );

        return $headers;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     * @throws \Exception
     */
    public function sendData($data)
    {
        $jsonBody = json_encode($data);
        $body = '';
        foreach ($data as $key => $value) {
            if ($body !== '') {
                $body .= '&' . $key . '=' . $value;
            } else {
                $body .= $key . '=' . $value;
            }
        }
        // This request uses the REST endpoint and requires the JSON content type header
        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), $this->buildHeaders($jsonBody), $body);
        return $this->response = new Response($this, json_decode($httpResponse->getBody()->getContents(), true));
    }

    /**
     * Get the base endpoint + API key
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointBase() . 'payments';
    }

    /**
     * @return mixed
     */
    public function getPaymentBrand()
    {
        return $this->getParameter('paymentBrand');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPaymentBrand($value)
    {
        return $this->setParameter('paymentBrand', $value);
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->getParameter('paymentType');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPaymentType($value)
    {
        return $this->setParameter('paymentType', $value);
    }

    /**
     * @return mixed
     */
    public function getBankAccountCountry()
    {
        return $this->getParameter('bankAccountCountry');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBankAccountCountry($value)
    {
        return $this->setParameter('bankAccountCountry', $value);
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

}
