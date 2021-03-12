<?php

namespace Drupal\intelisys\Utility;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * A time helper utility.
 */
class TimeHelper {

  /**
   * Life expectancy.
   */
  const LIFE_EXPECTANCY = 100;

  /**
   * The child age limit.
   */
  const CHILD_AGE_LIMIT = 16;

  /**
   * The infant age limit.
   */
  const INFANT_AGE_LIMIT = 2;

  /**
   * One UNIX year (365 * 86400).
   */
  const YEAR = 31536000;

  /**
   * Helper function to format date string.
   *
   * @param int|string $year
   *   The year.
   * @param int|string $month
   *   The month.
   * @param int|string $day
   *   The day.
   *
   * @return string
   *   The date as a "Y-m-d" string.
   */
  public static function getYmd($year, $month, $day) {
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    $day = str_pad($day, 2, '0', STR_PAD_LEFT);
    return $year . '-' . $month . '-' . $day;
  }

  /**
   * Determine if a birth date is an adult birth date.
   *
   * @param int $timestamp
   *   The birth date UNIX timestamp.
   *
   * @return bool
   *   Returns true if the timestamp is an adult.
   */
  public static function isAdult($timestamp) {
    return $timestamp < (REQUEST_TIME - (self::CHILD_AGE_LIMIT * self::YEAR));
  }

  /**
   * Get a local time from an Intelisys flight.
   *
   * @param array $array
   *   The Intelisys flight array structure.
   * @param string $time_format
   *   The date format to use.
   *
   * @return string
   *   The formatted local date.
   */
  public static function getLocalTime(array $array, $time_format) {
    if (isset($array['scheduledTime'])) {
      $time = strtotime($array['scheduledTime']);

      $settings = [];
      if (isset($array['airport']) && isset($array['airport']['utcOffset']) && isset($array['airport']['utcOffset']['iso'])) {
        $settings = ['timezone' => $array['airport']['utcOffset']['iso']];
      }

      return DrupalDateTime::createFromTimestamp($time)->format($time_format, $settings);
    }

    return '';
  }

}
