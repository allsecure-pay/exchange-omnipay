<?php
/**
 * Allsecure Exchange Abstract Response
 */

namespace Omnipay\AllsecureExchange\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Allsecure Exchange Abstract Response
 *
 * This is the base response class for all Allsecure Exchange requests.
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse implements RedirectResponseInterface
{

    /**
     * Check if the returned response is a successful one
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['success']) && $this->data['success'];
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['uuid']) ? (string) $this->data['uuid'] : null;
    }

    /**
     * Get a card / payment reference for createCard requests.
     * This can be used on next payment by assigning this reference into 'referenceUuid' on the next transaction payload
     *
     * @return string|null
     */
    public function getCardReference()
    {
        return $this->getTransactionReference();
    }

    /**
     * @return string|null
     */
    public function getPurchaseReference()
    {
        return isset($this->data['purchaseId']) ? (string) $this->data['purchaseId'] : null;
    }

    /**
     * @return string|null
     */
    public function getReturnType()
    {
        return isset($this->data['returnType']) ? (string) $this->data['returnType'] : null;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return $this->getReturnType() === 'REDIRECT';
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return isset($this->data['redirectUrl']) ? (string) $this->data['redirectUrl'] : null;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array|null
     */
    public function getRedirectData()
    {
        return null;
    }

    /**
     * Get the error message from Allsecure Exchange
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (isset($this->data['errors'])) {
            foreach ($this->data['errors'] as $error) {
                if(isset($error['errorMessage'])) {
                    return $error['errorMessage'];
                }
            }
        } else if(isset($this->data['errorMessage'])) {
            return $this->data['errorMessage'];
        }

        return null;
    }

    /**
     * Get the error code from Allsecure Exchange
     *
     * @return string|null
     */
    public function getCode()
    {
        if (isset($this->data['errors'])) {
            foreach ($this->data['errors'] as $error) {
                if(isset($error['errorCode'])) {
                    return $error['errorCode'];
                }
            }
        } else if(isset($this->data['errorCode'])) {
            return $this->data['errorCode'];
        }

        return null;
    }

    /**
     * Get the error message from the implemented adapter of Allsecure Exchange
     *
     * @return string|null
     */
    public function getAdapterMessage()
    {
        if (isset($this->data['errors'])) {
            foreach ($this->data['errors'] as $error) {
                if(isset($error['adapterMessage'])) {
                    return $error['adapterMessage'];
                }
            }
        }

        return null;
    }

    /**
     * Get the error code from the implemented adapter of Allsecure Exchange
     *
     * @return string|null
     */
    public function getAdapterCode()
    {
        if (isset($this->data['errors'])) {
            foreach ($this->data['errors'] as $error) {
                if(isset($error['adapterCode'])) {
                    return $error['adapterCode'];
                }
            }
        }

        return null;
    }
}
