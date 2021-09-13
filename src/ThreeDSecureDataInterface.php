<?php
/**
 * Customer interface
 */

namespace Omnipay\AllsecureExchange;

/**
 * ThreeDSecureData / 3D Secure Data interface
 *
 * This interface defines the functionality that all 3D Secure Data in
 * the Allsecure Exchange system are to have.
 */
interface ThreeDSecureDataInterface
{

    /**
     * 3dsecure of the 3D Secure Data
     */
    public function get3dsecure();

    /**
     * Channel of the 3D Secure Data
     */
    public function getChannel();

    /**
     * AuthenticationIndicator of the 3D Secure Data
     */
    public function getAuthenticationIndicator();

    /**
     * CardholderAuthenticationMethod of the 3D Secure Data
     */
    public function getCardholderAuthenticationMethod();

    /**
     * CardholderAuthenticationDateTime of the 3D Secure Data
     */
    public function getCardholderAuthenticationDateTime();

    /**
     * CardHolderAuthenticationData of the 3D Secure Data
     */
    public function getCardHolderAuthenticationData();

    /**
     * ChallengeIndicator of the 3D Secure Data
     */
    public function getChallengeIndicator();

    /**
     * PriorReference of the 3D Secure Data
     */
    public function getPriorReference();

    /**
     * PriorAuthenticationMethod of the 3D Secure Data
     */
    public function getPriorAuthenticationMethod();

    /**
     * PriorAuthenticationDateTime of the 3D Secure Data
     */
    public function getPriorAuthenticationDateTime();

    /**
     * PriorAuthenticationData of the 3D Secure Data
     */
    public function getPriorAuthenticationData();

    /**
     * CardholderAccountType of the 3D Secure Data
     */
    public function getCardholderAccountType();

    /**
     * 3ds:cardholderAccountAgeIndicator of the 3D Secure Data
     */
    public function get3dsCardholderAccountAgeIndicator();

    /**
     * CardholderAccountDate of the 3D Secure Data
     */
    public function getCardholderAccountDate();

    /**
     * CardholderAccountChangeIndicator of the 3D Secure Data
     */
    public function getCardholderAccountChangeIndicator();

    /**
     * CardholderAccountLastChange of the 3D Secure Data
     */
    public function getCardholderAccountLastChange();

    /**
     * CardholderAccountPasswordChangeIndicator of the 3D Secure Data
     */
    public function getCardholderAccountPasswordChangeIndicator();

    /**
     * CardholderAccountLastPasswordChange of the 3D Secure Data
     */
    public function getCardholderAccountLastPasswordChange();

    /**
     * ShippingAddressUsageIndicator of the 3D Secure Data
     */
    public function getShippingAddressUsageIndicator();

    /**
     * ShippingAddressFirstUsage of the 3D Secure Data
     */
    public function getShippingAddressFirstUsage();

    /**
     * TransactionActivityDay of the 3D Secure Data
     */
    public function getTransactionActivityDay();

    /**
     * TransactionActivityYear of the 3D Secure Data
     */
    public function getTransactionActivityYear();

    /**
     * AddCardAttemptsDay of the 3D Secure Data
     */
    public function getAddCardAttemptsDay();

    /**
     * PurchaseCountSixMonths of the 3D Secure Data
     */
    public function getPurchaseCountSixMonths();

    /**
     * SuspiciousAccountActivityIndicator of the 3D Secure Data
     */
    public function getSuspiciousAccountActivityIndicator();

    /**
     * ShippingNameEqualIndicator of the 3D Secure Data
     */
    public function getShippingNameEqualIndicator();

    /**
     * PaymentAccountAgeIndicator of the 3D Secure Data
     */
    public function getPaymentAccountAgeIndicator();

    /**
     * PaymentAccountAgeDate of the 3D Secure Data
     */
    public function getPaymentAccountAgeDate();

    /**
     * BillingAddressLine3 of the 3D Secure Data
     */
    public function getBillingAddressLine3();

    /**
     * ShippingAddressLine3 of the 3D Secure Data
     */
    public function getShippingAddressLine3();

    /**
     * BillingShippingAddressMatch of the 3D Secure Data
     */
    public function getBillingShippingAddressMatch();

    /**
     * HomePhoneCountryPrefix of the 3D Secure Data
     */
    public function getHomePhoneCountryPrefix();

    /**
     * HomePhoneNumber of the 3D Secure Data
     */
    public function getHomePhoneNumber();

    /**
     * MobilePhoneCountryPrefix of the 3D Secure Data
     */
    public function getMobilePhoneCountryPrefix();

    /**
     * MobilePhoneNumber of the 3D Secure Data
     */
    public function getMobilePhoneNumber();

    /**
     * WorkPhoneCountryPrefix of the 3D Secure Data
     */
    public function getWorkPhoneCountryPrefix();

    /**
     * WorkPhoneNumber of the 3D Secure Data
     */
    public function getWorkPhoneNumber();

    /**
     * PurchaseInstalData of the 3D Secure Data
     */
    public function getPurchaseInstalData();

    /**
     * ShipIndicator of the 3D Secure Data
     */
    public function getShipIndicator();

    /**
     * DeliveryTimeframe of the 3D Secure Data
     */
    public function getDeliveryTimeframe();

    /**
     * DeliveryEmailAddress of the 3D Secure Data
     */
    public function getDeliveryEmailAddress();

    /**
     * ReorderItemsIndicator of the 3D Secure Data
     */
    public function getReorderItemsIndicator();

    /**
     * PreOrderPurchaseIndicator of the 3D Secure Data
     */
    public function getPreOrderPurchaseIndicator();

    /**
     * PreOrderDate of the 3D Secure Data
     */
    public function getPreOrderDate();

    /**
     * GiftCardAmount of the 3D Secure Data
     */
    public function getGiftCardAmount();

    /**
     * GiftCardCurrency of the 3D Secure Data
     */
    public function getGiftCardCurrency();

    /**
     * GiftCardCount of the 3D Secure Data
     */
    public function getGiftCardCount();

    /**
     * PurchaseDate of the 3D Secure Data
     */
    public function getPurchaseDate();

    /**
     * RecurringExpiry of the 3D Secure Data
     */
    public function getRecurringExpiry();

    /**
     * RecurringFrequency of the 3D Secure Data
     */
    public function getRecurringFrequency();

    /**
     * TransType of the 3D Secure Data
     */
    public function getTransType();

    /**
     * ExemptionIndicator of the 3D Secure Data
     */
    public function getExemptionIndicator();

    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData();
}
