<?php
/**
 * Customer interface
 */

namespace Omnipay\AllsecureExchange;

/**
 * Schedule interface
 *
 * This interface defines the functionality that all schedules in
 * the Allsecure Exchange system are to have.
 */
interface ScheduleInterface
{
    /**
     * Amount of the schedule
     * Format: decimals separated by ., max. 3 decimals
     */
    public function getAmount();

    /**
     * Currency of the schedule
     * Format: 3 letter currency code
     */
    public function getCurrency();

    /**
     * Period Length of the schedule
     */
    public function getPeriodLength();

    /**
     * Period Unit of the schedule
     * Format: DAY, WEEK, MONTH, YEAR
     */
    public function getPeriodUnit();

    /**
     * Start Date Time of the schedule
     * Format: RFC8601 Date/Time YYYY-MM-DD\THH:MM:SS+00:00
     */
    public function getStartDateTime();


    /**
     * Get data in payload format
     *
     * @return array
     */
    public function getData();
}
