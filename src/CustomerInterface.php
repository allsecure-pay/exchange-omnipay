<?php
/**
 * Customer interface
 */

namespace Omnipay\AllsecureExchange;

/**
 * Customer interface
 *
 * This interface defines the functionality that all customers in
 * the Allsecure Exchange system are to have.
 */
interface CustomerInterface
{
    /**
     * Identification of the customer
     */
    public function getIdentification();

    /**
     * First Name of the customer
     */
    public function getFirstName();

    /**
     * Last Name of the customer
     */
    public function getLastName();

    /**
     * Birth date of the customer
     * Format: YYYY-MM-DD
     */
    public function getBirthDate();

    /**
     * Gender of the customer
     * Format: M-F
     */
    public function getGender();

    /**
     * Billing Address 1 of the customer
     */
    public function getBillingAddress1();

    /**
     * Billing Address 2 of the customer
     */
    public function getBillingAddress2();

    /**
     * Billing City of the customer
     */
    public function getBillingCity();

    /**
     * Billing Postcode of the customer
     */
    public function getBillingPostcode();

    /**
     * Billing State of the customer
     */
    public function getBillingState();

    /**
     * Billing Country of the customer
     */
    public function getBillingCountry();

    /**
     * Billing Phone of the customer
     */
    public function getBillingPhone();

    /**
     * Shipping First Name of the customer
     */
    public function getShippingFirstName();

    /**
     * Shipping Last Name of the customer
     */
    public function getShippingLastName();

    /**
     * Shipping Company of the customer
     */
    public function getShippingCompany();

    /**
     * Shipping Address 1 of the customer
     */
    public function getShippingAddress1();

    /**
     * Shipping Address 2 of the customer
     */
    public function getShippingAddress2();

    /**
     * Shipping City of the customer
     */
    public function getShippingCity();

    /**
     * Shipping Postcode of the customer
     */
    public function getShippingPostcode();

    /**
     * Shipping State of the customer
     */
    public function getShippingState();

    /**
     * Shipping Country of the customer
     */
    public function getShippingCountry();

    /**
     * Shipping Phone of the customer
     */
    public function getShippingPhone();

    /**
     * Company of the customer
     */
    public function getCompany();

    /**
     * Email of the customer
     */
    public function getEmail();

    /**
     * Email Verified of the customer
     */
    public function getEmailVerified();

    /**
     * Ip Address of the customer
     */
    public function getIpAddress();

    /**
     * National Id of the customer
     */
    public function getNationalId();

    /**
     * Extra Data of the customer
     */
    public function getExtraData();

    /**
     * Payment Data of the customer
     */
    public function getPaymentData();

    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData();
}
