<?php

namespace Omnipay\AllsecureExchange;

use Omnipay\Common\Helper;
use Omnipay\AllsecureExchange\Traits\ParameterBagTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Schedule
 *
 * This class defines a single schedule in the Allsecure Exchange system.
 *
 * @see ScheduleInterface
 */
class Schedule implements ScheduleInterface
{

    const PERIOD_UNIT_DAY = 'DAY';
    const PERIOD_UNIT_WEEK = 'WEEK';
    const PERIOD_UNIT_MONTH = 'MONTH';
    const PERIOD_UNIT_YEAR = 'YEAR';

    use ParameterBagTrait;

    /**
     * Create a new schedule with the specified parameters
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
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Set the schedule Amount
     * @param $value
     * @return Schedule
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    /**
     * Set the schedule Currency
     * @param $value
     * @return Schedule
     */
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPeriodLength()
    {
        return $this->getParameter('periodLength');
    }

    /**
     * Set the schedule PeriodLength
     * @param $value
     * @return Schedule
     */
    public function setPeriodLength($value)
    {
        return $this->setParameter('periodLength', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getPeriodUnit()
    {
        return $this->getParameter('periodUnit');
    }

    /**
     * Set the schedule PeriodUnit
     * @param $value
     * @return Schedule
     */
    public function setPeriodUnit($value)
    {
        $value = strtoupper($value);
        if(!in_array($value, [
            self::PERIOD_UNIT_DAY,
            self::PERIOD_UNIT_WEEK,
            self::PERIOD_UNIT_MONTH,
            self::PERIOD_UNIT_YEAR
        ])) {
            throw new InvalidParameterException('Invalid value on period unit');
        }

        return $this->setParameter('periodUnit', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDateTime()
    {
        return $this->getParameter('startDateTime');
    }

    /**
     * Set the schedule StartDateTime
     * @param $value
     * @return Schedule
     */
    public function setStartDateTime($value)
    {
        return $this->setParameter('startDateTime', $value);
    }

    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('amount', 'currency', 'periodLength', 'periodUnit');

        $data = array();

        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['periodLength'] = $this->getPeriodLength();
        $data['periodUnit'] = $this->getPeriodUnit();

        if($startDateTime = $this->getStartDateTime()) {
            $data['startDateTime'] = $startDateTime;
        }

        return $data;
    }
}
