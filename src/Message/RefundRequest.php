<?php

namespace Omnipay\AllsecureExchange\Message;

/**
 * Class RefundRequest
 *
 * @package Omnipay\AllsecureExchange\Message
 */
class RefundRequest extends AbstractTransactionRequest
{

    /**
     * Get data for request payload
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('merchantTransactionId', 'amount', 'currency', 'referenceUuid');

        $data = $this->getBaseData();

        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['referenceUuid'] = $this->getReferenceUuid();


        if($callbackUrl = $this->getCallbackUrl()) {
            $data['callbackUrl'] = $callbackUrl;
        }


        if($transactionToken = $this->getTransactionToken()) {
            $data['transactionToken'] = $transactionToken;
        }

        if($description = $this->getDescription()) {
            $data['description'] = $description;
        }


        if($items = $this->getItemData()) {
            $data['items'] = $items;
        }

        return $data;
    }

    /**
     * Get endpoint url
     *
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint().'/refund';
    }

}
