<?php

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Cart Item.
 *
 * This class defines a single cart item in the Omnipay system.
 *
 * @see ItemInterface
 */
class Item extends \Omnipay\Common\Item
{
    /**
     * {@inheritdoc}
     */
    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    /**
     * Set the item currency.
     */
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentification()
    {
        return $this->getParameter('identification');
    }

    /**
     * Set the item identification.
     */
    public function setIdentification($value)
    {
        return $this->setParameter('identification', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtraData()
    {
        return $this->getParameter('extraData');
    }

    /**
     * Set the item extra data.
     */
    public function setExtraData($value)
    {
        return $this->setParameter('extraData', $value);
    }
}
