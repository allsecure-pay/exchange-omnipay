<?php

namespace Omnipay\AllsecureExchange\Message;

/**
 * Class PayoutRequest
 *
 * @package Omnipay\AllsecureExchange\Message
 */
class PayoutRequest extends AbstractTransactionRequest
{

    /**
     * Get data for request payload
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('merchantTransactionId', 'amount', 'currency');

        $data = $this->getBaseData();

        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();

        // TODO: do validation for either `referenceUuid` or `transactionToken`

        if($referenceUuid = $this->getReferenceUuid()) {
            $data['referenceUuid'] = $referenceUuid;
        }

        if($transactionToken = $this->getTransactionToken()) {
            $data['transactionToken'] = $transactionToken;
        }


        if($successUrl = $this->getSuccessUrl()) {
            $data['successUrl'] = $successUrl;
        }

        if($cancelUrl = $this->getCancelUrl()) {
            $data['cancelUrl'] = $cancelUrl;
        }

        if($errorUrl = $this->getErrorUrl()) {
            $data['errorUrl'] = $errorUrl;
        }

        if($callbackUrl = $this->getCallbackUrl()) {
            $data['callbackUrl'] = $callbackUrl;
        }


        if($description = $this->getDescription()) {
            $data['description'] = $description;
        }


        if($customer = $this->getCustomerData()) {
            $data['customer'] = $customer;
        }

        if($items = $this->getItemData()) {
            $data['items'] = $items;
        }

        if($language = $this->getLanguage()) {
            $data['language'] = $language;
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
        return parent::getEndpoint().'/payout';
    }

}
