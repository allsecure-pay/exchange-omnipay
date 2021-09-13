<?php

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Helper;
use Omnipay\AllsecureExchange\Traits\ParameterBagTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Customer.
 *
 * This class defines a single customer in the Allsecure Exchange system.
 *
 * @see CustomerInterface
 */
class Customer implements CustomerInterface
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
     * Initialize the parameters from CreditCard object
     *
     * @param CreditCard $card
     * @return Customer $this
     */
    public function initializeFromCreditCard(CreditCard $card)
    {
        // Get from the following available getters
        // Customer attribute getter X CreditCard attribute getter
        $attributeMapping = [
            'firstName' => 'billingFirstName',
            'lastName' => 'billingLastName',
            'birthDate' => 'birthday',
            'gender' => 'gender',

            'billingAddress1' => 'billingAddress1',
            'billingAddress2' => 'billingAddress2',
            'billingCity' => 'billingCity',
            'billingPostcode' => 'billingPostcode',
            'billingState' => 'billingState',
            'billingCountry' => 'billingCountry',
            'billingPhone' => 'billingPhone',

            'shippingFirstName' => 'shippingFirstName',
            'shippingLastName' => 'shippingLastName',
            'shippingCompany' => 'shippingCompany',

            'shippingAddress1' => 'shippingAddress1',
            'shippingAddress2' => 'shippingAddress2',
            'shippingCity' => 'shippingCity',
            'shippingPostcode' => 'shippingPostcode',
            'shippingState' => 'shippingState',
            'shippingCountry' => 'shippingCountry',
            'shippingPhone' => 'shippingPhone',

            'company' => 'company',
            'email' => 'email',
        ];

        foreach($attributeMapping as $customerAttribute => $cardAttribute) {
            $customerMethod = 'set' . ucfirst($customerAttribute);
            $cardMethod = 'get' . ucfirst($cardAttribute);

            if ($customerMethod && $cardAttribute && method_exists($this, $customerMethod) && method_exists($card, $cardMethod)) {
                // Get value
                $value = $card->{$cardMethod}();

                // Set it to customer
                if($value) {
                    $this->{$customerMethod}($value);
                }
            }
        }

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function getIdentification()
    {
        return $this->getParameter('identification');
    }

    /**
     * Set the customer Identification
     */
    public function setIdentification($value)
    {
        return $this->setParameter('identification', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {
        return $this->getParameter('firstName');
    }

    /**
     * Set the customer FirstName
     */
    public function setFirstName($value)
    {
        return $this->setParameter('firstName', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    /**
     * Set the customer LastName
     */
    public function setLastName($value)
    {
        return $this->setParameter('lastName', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthDate()
    {
        return $this->getParameter('birthDate');
    }

    /**
     * Set the customer BirthDate
     */
    public function setBirthDate($value)
    {
        return $this->setParameter('birthDate', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getGender()
    {
        return $this->getParameter('gender');
    }

    /**
     * Set the customer Gender
     *
     * @param $value
     * @return $this
     * @throws InvalidParameterException
     */
    public function setGender($value)
    {
        if($value == 'm' || $value == 'f') {
            $value = strtoupper($value);
        }

        if(!$value != 'M' && $value != 'F') {
            throw new InvalidParameterException('Invalid value on gender');
        }

        return $this->setParameter('gender', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingAddress1()
    {
        return $this->getParameter('billingAddress1');
    }

    /**
     * Set the customer Billing Address 1
     */
    public function setBillingAddress1($value)
    {
        return $this->setParameter('billingAddress1', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingAddress2()
    {
        return $this->getParameter('billingAddress2');
    }

    /**
     * Set the customer Billing Address 2
     */
    public function setBillingAddress2($value)
    {
        return $this->setParameter('billingAddress2', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingCity()
    {
        return $this->getParameter('billingCity');
    }

    /**
     * Set the customer Billing City
     */
    public function setBillingCity($value)
    {
        return $this->setParameter('billingCity', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingPostcode()
    {
        return $this->getParameter('billingPostcode');
    }

    /**
     * Set the customer Billing Postcode
     */
    public function setBillingPostcode($value)
    {
        return $this->setParameter('billingPostcode', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingState()
    {
        return $this->getParameter('billingState');
    }

    /**
     * Set the customer Billing State
     */
    public function setBillingState($value)
    {
        return $this->setParameter('billingState', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingCountry()
    {
        return $this->getParameter('billingCountry');
    }

    /**
     * Set the customer Billing Country
     *
     * @param $value
     * @return $this
     * @throws InvalidParameterException
     */
    public function setBillingCountry($value)
    {
        if(is_string($value) && strlen($value) > 2) {
            throw new InvalidParameterException('billingCountry needs to be 2-letter country code');
        }

        return $this->setParameter('billingCountry', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingPhone()
    {
        return $this->getParameter('billingPhone');
    }

    /**
     * Set the customer Billing Phone
     */
    public function setBillingPhone($value)
    {
        return $this->setParameter('billingPhone', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingFirstName()
    {
        return $this->getParameter('shippingFirstName');
    }

    /**
     * Set the customer Shipping First Name
     */
    public function setShippingFirstName($value)
    {
        return $this->setParameter('shippingFirstName', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingLastName()
    {
        return $this->getParameter('shippingLastName');
    }

    /**
     * Set the customer Shipping Last Name
     */
    public function setShippingLastName($value)
    {
        return $this->setParameter('shippingLastName', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingCompany()
    {
        return $this->getParameter('shippingCompany');
    }

    /**
     * Set the customer Shipping Company
     */
    public function setShippingCompany($value)
    {
        return $this->setParameter('shippingCompany', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingAddress1()
    {
        return $this->getParameter('shippingAddress1');
    }

    /**
     * Set the customer Shipping Address 1
     */
    public function setShippingAddress1($value)
    {
        return $this->setParameter('shippingAddress1', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingAddress2()
    {
        return $this->getParameter('shippingAddress2');
    }

    /**
     * Set the customer Shipping Address 2
     */
    public function setShippingAddress2($value)
    {
        return $this->setParameter('shippingAddress2', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingCity()
    {
        return $this->getParameter('shippingCity');
    }

    /**
     * Set the customer Shipping City
     */
    public function setShippingCity($value)
    {
        return $this->setParameter('shippingCity', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingPostcode()
    {
        return $this->getParameter('shippingPostcode');
    }

    /**
     * Set the customer Shipping Postcode
     */
    public function setShippingPostcode($value)
    {
        return $this->setParameter('shippingPostcode', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingState()
    {
        return $this->getParameter('shippingState');
    }

    /**
     * Set the customer Shipping State
     */
    public function setShippingState($value)
    {
        return $this->setParameter('shippingState', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingCountry()
    {
        return $this->getParameter('shippingCountry');
    }

    /**
     * Set the customer Shipping Country
     *
     * @param $value
     * @return $this
     * @throws InvalidParameterException
     */
    public function setShippingCountry($value)
    {
        if(is_string($value) && strlen($value) > 2) {
            throw new InvalidParameterException('shippingCountry needs to be 2-letter country code');
        }

        return $this->setParameter('shippingCountry', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingPhone()
    {
        return $this->getParameter('shippingPhone');
    }

    /**
     * Set the customer Shipping Phone
     */
    public function setShippingPhone($value)
    {
        return $this->setParameter('shippingPhone', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompany()
    {
        return $this->getParameter('company');
    }

    /**
     * Set the customer Company
     */
    public function setCompany($value)
    {
        return $this->setParameter('company', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * Set the customer Email
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailVerified()
    {
        return $this->getParameter('emailVerified');
    }

    /**
     * Set the customer Email Verified
     */
    public function setEmailVerified($value)
    {
        return $this->setParameter('emailVerified', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getIpAddress()
    {
        return $this->getParameter('ipAddress');
    }

    /**
     * Set the customer Ip Address
     */
    public function setIpAddress($value)
    {
        return $this->setParameter('ipAddress', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getNationalId()
    {
        return $this->getParameter('nationalId');
    }

    /**
     * Set the customer National Id
     *$
     * @param $value
     * @return $this
     * @throws InvalidParameterException
     */
    public function setNationalId($value)
    {
        if(is_string($value) && strlen($value) > 14) {
            throw new InvalidParameterException('nationalId exceeds 14 characters');
        }

        return $this->setParameter('nationalId', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getExtraData()
    {
        return $this->getParameter('extraData');
    }

    /**
     * Set the customer Extra Data
     */
    public function setExtraData($value)
    {
        return $this->setParameter('extraData', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentData()
    {
        return $this->getParameter('paymentData');
    }

    /**
     * Set the customer Payment Data
     */
    public function setPaymentData($value)
    {
        if ($value && !$value instanceof PaymentData) {
            $value = new PaymentData($value);
        }

        return $this->setParameter('paymentData', $value);
    }

    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData()
    {
        $data = array();

        $optionalAttributes = [
            'identification',
            'firstName',
            'lastName',
            'birthDate',
            'gender',

            'billingAddress1',
            'billingAddress2',
            'billingCity',
            'billingPostcode',
            'billingState',
            'billingCountry',
            'billingPhone',

            'shippingFirstName',
            'shippingLastName',
            'shippingCompany',

            'shippingAddress1',
            'shippingAddress2',
            'shippingCity',
            'shippingPostcode',
            'shippingState',
            'shippingCountry',
            'shippingPhone',

            'company',
            'email',
            'emailVerified',
            'ipAddress',
            'nationalId',

            'extraData',
            'paymentData',
        ];

        foreach($optionalAttributes as $attribute) {
            $method = 'get' . ucfirst($attribute);
            $value = $this->{$method}();
            if (isset($value) && $value) {
                $data[$attribute] = $value;
            }
        }

        // Payment
        if($paymentData = $this->getPaymentData()) {
            $data['paymentData'] = $paymentData->getData();
        }

        return $data;
    }
}
