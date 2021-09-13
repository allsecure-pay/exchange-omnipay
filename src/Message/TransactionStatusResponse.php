<?php
/**
 * Allsecure Exchange Response
 */

namespace Omnipay\AllsecureExchange\Message;

/**
 * Allsecure Exchange Response
 *
 * This is the response class for all Allsecure Exchange requests.
 */
class TransactionStatusResponse extends Response
{

    /**
     * Check if the transaction was successful
     *
     * @return bool
     */
    public function isTransactionSuccessful()
    {
        return isset($this->data['transactionStatus']) && $this->data['transactionStatus'] === 'SUCCESS';
    }

    /**
     * Get the transactionType of the transaction
     *
     * @return string|null
     */
    public function getTransactionType()
    {
        return isset($this->data['transactionType']) ? (string) $this->data['transactionType'] : null;
    }

    /**
     * Get the amount of the transaction
     *
     * @return string|null
     */
    public function getAmount()
    {
        return isset($this->data['amount']) ? (string) $this->data['amount'] : null;
    }

    /**
     * Get the currency of the transaction
     * 
     * @return string|null
     */
    public function getCurrency()
    {
        return isset($this->data['currency']) ? (string) $this->data['currency'] : null;
    }

}
