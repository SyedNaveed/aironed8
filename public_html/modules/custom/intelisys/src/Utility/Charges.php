<?php

namespace Drupal\intelisys\Utility;

use GuzzleHttp\Command\Exception\CommandException;

/**
 * Provides helper methods for charges.
 */
class Charges {

  /**
   * Cancellation charge code.
   */
  const CANCELLATION_CODE = 'CX';

  /**
   * Fare charge code.
   */
  const FARE_CODE = 'FA';

  /**
   * Fuel charge code.
   */
  const FUEL_CODE = 'FUEL';

  /**
   * FET Tax percentage.
   */
  const FET_TAX_PERCENTAGE = 0.075;

  /**
   * Get the fuel charge.
   *
   * @return float
   *   The fuel charge.
   */
  public static function getFuelCharge() {
    static $amount;

    if (isset($amount)) {
      return $amount;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');

      $surcharges = $intelisys->getSurcharges()->toArray();
      $key = array_search(self::FUEL_CODE, array_column($surcharges, 'identifier'));
      if ($key !== FALSE) {
        $args = ['key' => $surcharges[$key]['key']];
        $charge = $intelisys->getSurcharge($args)->toArray();
        $amount = $charge['chargeAmount']['baseAmount'];
      }
      else {
        return 0;
      }
    }
    catch (CommandException $e) {
      return 0;
    }

    return $amount;
  }

}
