<?php
/**
 * Allsecure Open Response
 */

namespace Omnipay\AllsecureExchange\Message\V1;

/**
 * Allsecure Open Response
 *
 * This is the response class for all Allsecure Open requests.
 */
class TransactionStatusResponse extends Response
{
    /**
     * Check if the returned response is a successful one
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $this->getCode()) === 1;
    }
}
