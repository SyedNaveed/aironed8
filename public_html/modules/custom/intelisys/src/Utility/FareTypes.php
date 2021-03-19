<?php

namespace Drupal\intelisys\Utility;

/**
 * Provides helper methods for fare types.
 */
class FareTypes {

  /**
   * The 'Business' identifier.
   */
  const BUSINESS = 'Business';

  /**
   * The 'Everyday' identifier.
   */
  const EVERYDAY = 'Everyday';

  /**
   * The 'Go Your Way' identifier.
   */
  const GO_YOUR_WAY = 'GoYourWay';

  /**
   * Get the allowed fare types.
   *
   * @return array
   *   The valid fare types.
   */
  public static function getValidTypes() {
    return [
      self::BUSINESS,
      self::EVERYDAY,
      self::GO_YOUR_WAY,
    ];
  }

}
