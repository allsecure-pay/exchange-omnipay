<?php
/**
 * Allsecure Exchange Response
 */

namespace Omnipay\AllsecureExchange\Message\V1;

use Omnipay\Common\Http\Client;
use Omnipay\Common\Http\Exception;
use Omnipay\AllsecureExchange\Message\AbstractResponse;

/**
 * Allsecure Open Response
 *
 * This is the response class for all Allsecure Open requests.
 */
class Response extends AbstractResponse
{
    /**
     * Check if the returned response is a successful one
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $this->getCode()) === 1 || preg_match('/^(000\.200)/', $this->getCode()) === 1;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['id']) ? (string) $this->data['id'] : null;
    }

    /**
     * Get the error message from Allsecure Open
     *
     * @return string|null
     */
    public function getMessage()
    {
        try {
            $httpClient = new Client();
            $response = $httpClient->request('GET', 'https://eu-test.oppwa.com/v1/resultcodes')->getBody()->getContents();
            $response = json_decode($response, true);
            foreach ($response['resultCodes'] as $item) {
                if ($item['code'] == $this->getCode()) {
                    return $item['description'];
                }
            }
        } catch (\Exception $ex) {

        }
        return null;
    }

    /**
     * Get the error code from Allsecure Open
     *
     * @return string|null
     */
    public function getCode()
    {
        try {
            return $this->data['result']['code'];
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['redirect']);
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return isset($this->data['redirect'], $this->data['redirect']['url']) ? (string) $this->data['redirect']['url'] : null;
    }

    /**
     * Get the error message from the implemented adapter of Allsecure Open
     *
     * @return string|null
     */
    public function getAdapterMessage()
    {
        return $this->getMessage();
    }

    /**
     * Get the error code from the implemented adapter of Allsecure Open
     *
     * @return string|null
     */
    public function getAdapterCode()
    {
        return $this->getCode();
    }
}
