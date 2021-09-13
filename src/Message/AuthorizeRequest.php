<?php

namespace Omnipay\AllsecureExchange\Message;

/**
 * Class AuthorizeRequest
 *
 * @package Omnipay\AllsecureExchange\Message
 */
class AuthorizeRequest extends AbstractTransactionRequest
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

        if($referenceUuid = $this->getReferenceUuid()) {
            $data['referenceUuid'] = $referenceUuid;
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


        if($transactionToken = $this->getTransactionToken()) {
            $data['transactionToken'] = $transactionToken;
        }

        if($description = $this->getDescription()) {
            $data['description'] = $description;
        }


        if($withRegister = $this->getWithRegister()) {
            $data['withRegister'] = $withRegister;
        }

        if($transactionIndicator = $this->getTransactionIndicator()) {
            $data['transactionIndicator'] = $transactionIndicator;
        }


        if($customer = $this->getCustomerData()) {
            $data['customer'] = $customer;
        }

        if($items = $this->getItemData()) {
            $data['items'] = $items;
        }

        if($schedule = $this->getScheduleData()) {
            $data['schedule'] = $schedule;
        }

//        $data['customerProfileData'] = null; // TODO

        if($threeDSecureData = $this->getThreeDSecureDataData()) {
            $data['threeDSecureData'] = $threeDSecureData;
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
        return parent::getEndpoint().'/preauthorize';
    }

}
