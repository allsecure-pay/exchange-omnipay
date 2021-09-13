<?php
/**
 * Customer interface
 */

namespace Omnipay\AllsecureExchange\Traits;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * ParameterBagTrait trait
 *
 * This trait defines the basic parameter usage of other classes
 */
trait ParameterBagTrait
{

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Initialize this customer with the specified parameters
     *
     * @param array|null $parameters An array of parameters to set on this object
     * @return $this Customer
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * Validate the data.
     *
     * This method is called internally when calling getData to avoid wasting time with an API call
     * when the request is clearly invalid.
     *
     * @param string ... a variable length list of required parameters
     * @throws InvalidRequestException
     */
    public function validate()
    {
        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (! isset($value)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }
}
