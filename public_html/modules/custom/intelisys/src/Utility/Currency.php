<?php

namespace Drupal\intelisys\Utility;

/**
 * Provides helper methods for currency conversions.
 */
class Currency {

  /**
   * United States currency code.
   */
  const US_CURRENCY_CODE = 'USD';

  /**
   * Convert amount to price.
   *
   * @param float $amount
   *   The amount to convert.
   * @param string $currency
   *   The currency to use.
   *
   * @return string
   *   A converted price string.
   */
  public static function toPrice($amount, $currency = '') {
    switch ($currency) {
      case self::US_CURRENCY_CODE:
        return sprintf($amount < 0 ? '($%s)' : '$%s', number_format(abs($amount), 2));

      default:
        return number_format($amount, 2);
    }
  }

}
