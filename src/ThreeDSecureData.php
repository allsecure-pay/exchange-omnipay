<?php

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\Helper;
use Omnipay\AllsecureExchange\Traits\ParameterBagTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * ThreeDSecureData / 3D Secure Data interface
 *
 * This class defines a 3d secure data in the Allsecure Exchange system.
 *
 * @see ThreeDSecureDataInterface
 */
class ThreeDSecureData implements ThreeDSecureDataInterface
{

    use ParameterBagTrait;

    const THREED_SECURE_OFF = 'OFF';
    const THREED_SECURE_OPTIONAL = 'OPTIONAL';
    const THREED_SECURE_MANDATORY = 'MANDATORY';

    /**
     * Create a new 3D Secure Data with the specified parameters
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
    public function get3dsecure()
    {
        return $this->getParameter('3dsecure');
    }

    /**
     * Set the 3D Secure Data 3dsecure
     * @param $value
     * @return Schedule
     */
    public function set3dsecure($value)
    {
        if(!in_array($value, [
            self::THREED_SECURE_OFF,
            self::THREED_SECURE_MANDATORY,
            self::THREED_SECURE_OPTIONAL
        ])) {
            throw new InvalidParameterException('Invalid value on 3dsecure');
        }

        return $this->setParameter('3dsecure', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    /**
     * Set the 3D Secure Data Channel
     * @param $value
     * @return Schedule
     */
    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthenticationIndicator()
    {
        return $this->getParameter('authenticationIndicator');
    }

    /**
     * Set the 3D Secure Data AuthenticationIndicator
     * @param $value
     * @return Schedule
     */
    public function setAuthenticationIndicator($value)
    {
        return $this->setParameter('authenticationIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAuthenticationMethod()
    {
        return $this->getParameter('cardholderAuthenticationMethod');
    }

    /**
     * Set the 3D Secure Data CardholderAuthenticationMethod
     * @param $value
     * @return Schedule
     */
    public function setCardholderAuthenticationMethod($value)
    {
        return $this->setParameter('cardholderAuthenticationMethod', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAuthenticationDateTime()
    {
        return $this->getParameter('cardholderAuthenticationDateTime');
    }

    /**
     * Set the 3D Secure Data CardholderAuthenticationDateTime
     * @param $value
     * @return Schedule
     */
    public function setCardholderAuthenticationDateTime($value)
    {
        return $this->setParameter('cardholderAuthenticationDateTime', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardHolderAuthenticationData()
    {
        return $this->getParameter('cardHolderAuthenticationData');
    }

    /**
     * Set the 3D Secure Data CardHolderAuthenticationData
     * @param $value
     * @return Schedule
     */
    public function setCardHolderAuthenticationData($value)
    {
        return $this->setParameter('cardHolderAuthenticationData', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getChallengeIndicator()
    {
        return $this->getParameter('challengeIndicator');
    }

    /**
     * Set the 3D Secure Data ChallengeIndicator
     * @param $value
     * @return Schedule
     */
    public function setChallengeIndicator($value)
    {
        return $this->setParameter('challengeIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPriorReference()
    {
        return $this->getParameter('priorReference');
    }

    /**
     * Set the 3D Secure Data PriorReference
     * @param $value
     * @return Schedule
     */
    public function setPriorReference($value)
    {
        return $this->setParameter('priorReference', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPriorAuthenticationMethod()
    {
        return $this->getParameter('priorAuthenticationMethod');
    }

    /**
     * Set the 3D Secure Data PriorAuthenticationMethod
     * @param $value
     * @return Schedule
     */
    public function setPriorAuthenticationMethod($value)
    {
        return $this->setParameter('priorAuthenticationMethod', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPriorAuthenticationDateTime()
    {
        return $this->getParameter('priorAuthenticationDateTime');
    }

    /**
     * Set the 3D Secure Data PriorAuthenticationDateTime
     * @param $value
     * @return Schedule
     */
    public function setPriorAuthenticationDateTime($value)
    {
        return $this->setParameter('priorAuthenticationDateTime', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPriorAuthenticationData()
    {
        return $this->getParameter('priorAuthenticationData');
    }

    /**
     * Set the 3D Secure Data PriorAuthenticationData
     * @param $value
     * @return Schedule
     */
    public function setPriorAuthenticationData($value)
    {
        return $this->setParameter('priorAuthenticationData', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountType()
    {
        return $this->getParameter('cardholderAccountType');
    }

    /**
     * Set the 3D Secure Data CardholderAccountType
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountType($value)
    {
        return $this->setParameter('cardholderAccountType', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function get3dsCardholderAccountAgeIndicator()
    {
        return $this->getParameter('3dsCardholderAccountAgeIndicator');
    }

    /**
     * Set the 3D Secure Data 3dsCardholderAccountAgeIndicator
     * @param $value
     * @return Schedule
     */
    public function set3dsCardholderAccountAgeIndicator($value)
    {
        return $this->setParameter('3dsCardholderAccountAgeIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountDate()
    {
        return $this->getParameter('cardholderAccountDate');
    }

    /**
     * Set the 3D Secure Data CardholderAccountDate
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountDate($value)
    {
        return $this->setParameter('cardholderAccountDate', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountChangeIndicator()
    {
        return $this->getParameter('cardholderAccountChangeIndicator');
    }

    /**
     * Set the 3D Secure Data CardholderAccountChangeIndicator
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountChangeIndicator($value)
    {
        return $this->setParameter('cardholderAccountChangeIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountLastChange()
    {
        return $this->getParameter('cardholderAccountLastChange');
    }

    /**
     * Set the 3D Secure Data CardholderAccountLastChange
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountLastChange($value)
    {
        return $this->setParameter('cardholderAccountLastChange', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountPasswordChangeIndicator()
    {
        return $this->getParameter('cardholderAccountPasswordChangeIndicator');
    }

    /**
     * Set the 3D Secure Data CardholderAccountPasswordChangeIndicator
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountPasswordChangeIndicator($value)
    {
        return $this->setParameter('cardholderAccountPasswordChangeIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCardholderAccountLastPasswordChange()
    {
        return $this->getParameter('cardholderAccountLastPasswordChange');
    }

    /**
     * Set the 3D Secure Data CardholderAccountLastPasswordChange
     * @param $value
     * @return Schedule
     */
    public function setCardholderAccountLastPasswordChange($value)
    {
        return $this->setParameter('cardholderAccountLastPasswordChange', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingAddressUsageIndicator()
    {
        return $this->getParameter('shippingAddressUsageIndicator');
    }

    /**
     * Set the 3D Secure Data ShippingAddressUsageIndicator
     * @param $value
     * @return Schedule
     */
    public function setShippingAddressUsageIndicator($value)
    {
        return $this->setParameter('shippingAddressUsageIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingAddressFirstUsage()
    {
        return $this->getParameter('shippingAddressFirstUsage');
    }

    /**
     * Set the 3D Secure Data ShippingAddressFirstUsage
     * @param $value
     * @return Schedule
     */
    public function setShippingAddressFirstUsage($value)
    {
        return $this->setParameter('shippingAddressFirstUsage', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransactionActivityDay()
    {
        return $this->getParameter('transactionActivityDay');
    }

    /**
     * Set the 3D Secure Data TransactionActivityDay
     * @param $value
     * @return Schedule
     */
    public function setTransactionActivityDay($value)
    {
        return $this->setParameter('transactionActivityDay', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransactionActivityYear()
    {
        return $this->getParameter('transactionActivityYear');
    }

    /**
     * Set the 3D Secure Data TransactionActivityYear
     * @param $value
     * @return Schedule
     */
    public function setTransactionActivityYear($value)
    {
        return $this->setParameter('transactionActivityYear', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddCardAttemptsDay()
    {
        return $this->getParameter('addCardAttemptsDay');
    }

    /**
     * Set the 3D Secure Data AddCardAttemptsDay
     * @param $value
     * @return Schedule
     */
    public function setAddCardAttemptsDay($value)
    {
        return $this->setParameter('addCardAttemptsDay', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPurchaseCountSixMonths()
    {
        return $this->getParameter('purchaseCountSixMonths');
    }

    /**
     * Set the 3D Secure Data PurchaseCountSixMonths
     * @param $value
     * @return Schedule
     */
    public function setPurchaseCountSixMonths($value)
    {
        return $this->setParameter('purchaseCountSixMonths', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getSuspiciousAccountActivityIndicator()
    {
        return $this->getParameter('suspiciousAccountActivityIndicator');
    }

    /**
     * Set the 3D Secure Data SuspiciousAccountActivityIndicator
     * @param $value
     * @return Schedule
     */
    public function setSuspiciousAccountActivityIndicator($value)
    {
        return $this->setParameter('suspiciousAccountActivityIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingNameEqualIndicator()
    {
        return $this->getParameter('shippingNameEqualIndicator');
    }

    /**
     * Set the 3D Secure Data ShippingNameEqualIndicator
     * @param $value
     * @return Schedule
     */
    public function setShippingNameEqualIndicator($value)
    {
        return $this->setParameter('shippingNameEqualIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentAccountAgeIndicator()
    {
        return $this->getParameter('paymentAccountAgeIndicator');
    }

    /**
     * Set the 3D Secure Data PaymentAccountAgeIndicator
     * @param $value
     * @return Schedule
     */
    public function setPaymentAccountAgeIndicator($value)
    {
        return $this->setParameter('paymentAccountAgeIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentAccountAgeDate()
    {
        return $this->getParameter('paymentAccountAgeDate');
    }

    /**
     * Set the 3D Secure Data PaymentAccountAgeDate
     * @param $value
     * @return Schedule
     */
    public function setPaymentAccountAgeDate($value)
    {
        return $this->setParameter('paymentAccountAgeDate', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingAddressLine3()
    {
        return $this->getParameter('billingAddressLine3');
    }

    /**
     * Set the 3D Secure Data BillingAddressLine3
     * @param $value
     * @return Schedule
     */
    public function setBillingAddressLine3($value)
    {
        return $this->setParameter('billingAddressLine3', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShippingAddressLine3()
    {
        return $this->getParameter('shippingAddressLine3');
    }

    /**
     * Set the 3D Secure Data ShippingAddressLine3
     * @param $value
     * @return Schedule
     */
    public function setShippingAddressLine3($value)
    {
        return $this->setParameter('shippingAddressLine3', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBillingShippingAddressMatch()
    {
        return $this->getParameter('billingShippingAddressMatch');
    }

    /**
     * Set the 3D Secure Data BillingShippingAddressMatch
     * @param $value
     * @return Schedule
     */
    public function setBillingShippingAddressMatch($value)
    {
        return $this->setParameter('billingShippingAddressMatch', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomePhoneCountryPrefix()
    {
        return $this->getParameter('homePhoneCountryPrefix');
    }

    /**
     * Set the 3D Secure Data HomePhoneCountryPrefix
     * @param $value
     * @return Schedule
     */
    public function setHomePhoneCountryPrefix($value)
    {
        return $this->setParameter('homePhoneCountryPrefix', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomePhoneNumber()
    {
        return $this->getParameter('homePhoneNumber');
    }

    /**
     * Set the 3D Secure Data HomePhoneNumber
     * @param $value
     * @return Schedule
     */
    public function setHomePhoneNumber($value)
    {
        return $this->setParameter('homePhoneNumber', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getMobilePhoneCountryPrefix()
    {
        return $this->getParameter('mobilePhoneCountryPrefix');
    }

    /**
     * Set the 3D Secure Data MobilePhoneCountryPrefix
     * @param $value
     * @return Schedule
     */
    public function setMobilePhoneCountryPrefix($value)
    {
        return $this->setParameter('mobilePhoneCountryPrefix', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getMobilePhoneNumber()
    {
        return $this->getParameter('mobilePhoneNumber');
    }

    /**
     * Set the 3D Secure Data MobilePhoneNumber
     * @param $value
     * @return Schedule
     */
    public function setMobilePhoneNumber($value)
    {
        return $this->setParameter('mobilePhoneNumber', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getWorkPhoneCountryPrefix()
    {
        return $this->getParameter('workPhoneCountryPrefix');
    }

    /**
     * Set the 3D Secure Data WorkPhoneCountryPrefix
     * @param $value
     * @return Schedule
     */
    public function setWorkPhoneCountryPrefix($value)
    {
        return $this->setParameter('workPhoneCountryPrefix', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getWorkPhoneNumber()
    {
        return $this->getParameter('workPhoneNumber');
    }

    /**
     * Set the 3D Secure Data WorkPhoneNumber
     * @param $value
     * @return Schedule
     */
    public function setWorkPhoneNumber($value)
    {
        return $this->setParameter('workPhoneNumber', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPurchaseInstalData()
    {
        return $this->getParameter('purchaseInstalData');
    }

    /**
     * Set the 3D Secure Data PurchaseInstalData
     * @param $value
     * @return Schedule
     */
    public function setPurchaseInstalData($value)
    {
        return $this->setParameter('purchaseInstalData', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getShipIndicator()
    {
        return $this->getParameter('shipIndicator');
    }

    /**
     * Set the 3D Secure Data ShipIndicator
     * @param $value
     * @return Schedule
     */
    public function setShipIndicator($value)
    {
        return $this->setParameter('shipIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeliveryTimeframe()
    {
        return $this->getParameter('deliveryTimeframe');
    }

    /**
     * Set the 3D Secure Data DeliveryTimeframe
     * @param $value
     * @return Schedule
     */
    public function setDeliveryTimeframe($value)
    {
        return $this->setParameter('deliveryTimeframe', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeliveryEmailAddress()
    {
        return $this->getParameter('deliveryEmailAddress');
    }

    /**
     * Set the 3D Secure Data DeliveryEmailAddress
     * @param $value
     * @return Schedule
     */
    public function setDeliveryEmailAddress($value)
    {
        return $this->setParameter('deliveryEmailAddress', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getReorderItemsIndicator()
    {
        return $this->getParameter('reorderItemsIndicator');
    }

    /**
     * Set the 3D Secure Data ReorderItemsIndicator
     * @param $value
     * @return Schedule
     */
    public function setReorderItemsIndicator($value)
    {
        return $this->setParameter('reorderItemsIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreOrderPurchaseIndicator()
    {
        return $this->getParameter('preOrderPurchaseIndicator');
    }

    /**
     * Set the 3D Secure Data PreOrderPurchaseIndicator
     * @param $value
     * @return Schedule
     */
    public function setPreOrderPurchaseIndicator($value)
    {
        return $this->setParameter('preOrderPurchaseIndicator', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreOrderDate()
    {
        return $this->getParameter('preOrderDate');
    }

    /**
     * Set the 3D Secure Data PreOrderDate
     * @param $value
     * @return Schedule
     */
    public function setPreOrderDate($value)
    {
        return $this->setParameter('preOrderDate', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getGiftCardAmount()
    {
        return $this->getParameter('giftCardAmount');
    }

    /**
     * Set the 3D Secure Data GiftCardAmount
     * @param $value
     * @return Schedule
     */
    public function setGiftCardAmount($value)
    {
        return $this->setParameter('giftCardAmount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getGiftCardCurrency()
    {
        return $this->getParameter('giftCardCurrency');
    }

    /**
     * Set the 3D Secure Data GiftCardCurrency
     * @param $value
     * @return Schedule
     */
    public function setGiftCardCurrency($value)
    {
        return $this->setParameter('giftCardCurrency', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getGiftCardCount()
    {
        return $this->getParameter('giftCardCount');
    }

    /**
     * Set the 3D Secure Data GiftCardCount
     * @param $value
     * @return Schedule
     */
    public function setGiftCardCount($value)
    {
        return $this->setParameter('giftCardCount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPurchaseDate()
    {
        return $this->getParameter('purchaseDate');
    }

    /**
     * Set the 3D Secure Data PurchaseDate
     * @param $value
     * @return Schedule
     */
    public function setPurchaseDate($value)
    {
        return $this->setParameter('purchaseDate', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecurringExpiry()
    {
        return $this->getParameter('recurringExpiry');
    }

    /**
     * Set the 3D Secure Data RecurringExpiry
     * @param $value
     * @return Schedule
     */
    public function setRecurringExpiry($value)
    {
        return $this->setParameter('recurringExpiry', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecurringFrequency()
    {
        return $this->getParameter('recurringFrequency');
    }

    /**
     * Set the 3D Secure Data RecurringFrequency
     * @param $value
     * @return Schedule
     */
    public function setRecurringFrequency($value)
    {
        return $this->setParameter('recurringFrequency', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransType()
    {
        return $this->getParameter('transType');
    }

    /**
     * Set the 3D Secure Data TransType
     * @param $value
     * @return Schedule
     */
    public function setTransType($value)
    {
        return $this->setParameter('transType', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getExemptionIndicator()
    {
        return $this->getParameter('exemptionIndicator');
    }

    /**
     * Set the 3D Secure Data ExemptionIndicator
     * @param $value
     * @return Schedule
     */
    public function setExemptionIndicator($value)
    {
        return $this->setParameter('exemptionIndicator', $value);
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
            '3dsecure',
            'channel',
            'authenticationIndicator',
            'cardholderAuthenticationMethod',
            'cardholderAuthenticationDateTime',
            'cardHolderAuthenticationData',
            'challengeIndicator',
            'priorReference',
            'priorAuthenticationMethod',
            'priorAuthenticationDateTime',
            'priorAuthenticationData',
            'cardholderAccountType',
            '3dsCardholderAccountAgeIndicator',
            'cardholderAccountDate',
            'cardholderAccountChangeIndicator',
            'cardholderAccountLastChange',
            'cardholderAccountPasswordChangeIndicator',
            'cardholderAccountLastPasswordChange',
            'shippingAddressUsageIndicator',
            'shippingAddressFirstUsage',
            'transactionActivityDay',
            'transactionActivityYear',
            'addCardAttemptsDay',
            'purchaseCountSixMonths',
            'suspiciousAccountActivityIndicator',
            'shippingNameEqualIndicator',
            'paymentAccountAgeIndicator',
            'paymentAccountAgeDate',
            'billingAddressLine3',
            'shippingAddressLine3',
            'billingShippingAddressMatch',
            'homePhoneCountryPrefix',
            'homePhoneNumber',
            'mobilePhoneCountryPrefix',
            'mobilePhoneNumber',
            'workPhoneCountryPrefix',
            'workPhoneNumber',
            'purchaseInstalData',
            'shipIndicator',
            'deliveryTimeframe',
            'deliveryEmailAddress',
            'reorderItemsIndicator',
            'preOrderPurchaseIndicator',
            'preOrderDate',
            'giftCardAmount',
            'giftCardCurrency',
            'giftCardCount',
            'purchaseDate',
            'recurringExpiry',
            'recurringFrequency',
            'transType',
            'exemptionIndicator',
        ];

        foreach($optionalAttributes as $attribute) {
            $value = $this->parameters->get($attribute);
            if (!isset($value)) {
                $data[$attribute] = $value;
            }
        }

        if(isset($data['3dsCardholderAccountAgeIndicator'])) {
            $data['3dsCardholderAccountAgeIndicator'] = $data['3ds:cardholderAccountAgeIndicator'];
            unset($data['3dsCardholderAccountAgeIndicator']);
        }

        return $data;
    }
}
