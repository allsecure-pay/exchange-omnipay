<?php

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\Helper;
use Omnipay\AllsecureExchange\Traits\ParameterBagTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * PaymentData
 *
 * This class defines a single PaymentData in the Allsecure Exchange system.
 *
 * @see PaymentDataInterface
 */
class PaymentData implements PaymentDataInterface
{

    use ParameterBagTrait;

    /**
     * Create a new customer with the specified parameters
     *
     * @param array|null $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }
    /**
     * {@inheritDoc}
     */
    public function getIbanData()
    {
        return $this->getParameter('ibanData');
    }

    /**
     * Set the IBAN data
     * @param $value
     * @return PaymentData
     */
    public function setIbanData($value)
    {
        return $this->setParameter('ibanData', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getWalletData()
    {
        return $this->getParameter('walletData');
    }

    /**
     * Set the customer Wallet data
     * @param $value
     * @return PaymentData
     */
    public function setWalletData($value)
    {
        return $this->setParameter('walletData', $value);
    }

    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData()
    {
        $data = array();

        if($ibanData = $this->getIbanData()) {
            $data['ibanData'] = $ibanData;
        }

        if($walletData = $this->getWalletData()) {
            $data['walletData'] = $walletData;
        }

        return $data;
    }
}
