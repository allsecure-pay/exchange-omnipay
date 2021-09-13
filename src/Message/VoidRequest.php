<?php

namespace Omnipay\AllsecureExchange\Message;

/**
 * Class VoidRequest
 *
 * @package Omnipay\AllsecureExchange\Message
 */
class VoidRequest extends AbstractTransactionRequest
{

    /**
     * Get data for request payload
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('merchantTransactionId', 'referenceUuid');

        $data = $this->getBaseData();

        $data['referenceUuid'] = $this->getReferenceUuid();

        return $data;
    }

    /**
     * Get endpoint url
     *
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint().'/void';
    }

}