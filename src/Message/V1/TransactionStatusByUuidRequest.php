<?php

namespace Omnipay\AllsecureExchange\Message\V1;

use Omnipay\AllsecureExchange\Message\AbstractStatusRequest;

/**
 * Class TransactionStatusByUuidRequest
 *
 * @package Omnipay\AllsecureExchange\Message\V1
 */
class TransactionStatusByUuidRequest extends AbstractStatusRequest
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
        $this->validate('uuid');

        $data = $this->getBaseData();
        $data['uuid'] = $this->getUuid();

        return $data;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     * @throws \Exception
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request('GET', $this->getEndpoint(), $this->buildHeaders());
        return $this->response = new TransactionStatusResponse($this, json_decode($httpResponse->getBody()->getContents(), true));
    }

    /**
     * Generate additional headers that are used when sending Allsecure Open
     *
     * @return array
     * @throws \Exception
     */
    protected function buildHeaders()
    {
        $contentType = 'application/json';

        $headers = array(
            'Content-Type' => $contentType,
            'Accept' => $contentType,
            'Authorization' => "Bearer " . $this->getBearer(),
        );

        return $headers;
    }

    /**
     * Get endpoint url
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getEndpointBase() . 'payments/' . $this->getUuid() . '?entityId=' . $this->getEntityId();
    }

}
