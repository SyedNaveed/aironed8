<?php

namespace Drupal\aco_core\Utility;

use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\Locations;

/**
 * Default data structures.
 */
class Defaults {

  /**
   * Get booking defaults.
   *
   * @return array
   *   The booking defaults.
   */
  public static function booking() {
    return [
      'last_step' => 0,
      'departure' => '',
      'arrival' => '',
      'from' => '',
      'to' => '',
      'adultCount' => 0,
      'childCount' => 0,
      'infantCount' => 0,
      'promoCode' => '',
      'isRoundtrip' => 1,
      'departure_flight' => '',
      'arrival_flight' => '',
      'passengers' => [],
      'seatSelections' => [],
      'ancillaryPurchases' => [],
      'ancillaryPurchasesTotal' => 0,
    ] + self::billing();
  }

  /**
   * Get add passengers defaults.
   *
   * @return array
   *   The add passengers defaults.
   */
  public static function addPassengers() {
    return [
      'last_step' => 0,
      'adultCount' => 0,
      'childCount' => 0,
      'leg_index' => 0,
      'passengers' => [],
      'ancillaryPurchases' => [],
      'ancillaryPurchasesTotal' => 0,
    ] + self::billing();
  }

  /**
   * Get billing defaults.
   *
   * @return array
   *   The billing defaults.
   */
  public static function billing() {
    return [
      'paymentMethod' => [
        'identifier' => '',
      ],
      'billing' => [
        'creditCard' => [
          'number' => '',
          'expiry' => '',
          'verificationNumber' => '',
          'billing' => [
            'contactInformation' => [
              'name' => '',
            ],
            'address' => [
              'address1' => '',
              'address2' => '',
              'city' => '',
              'location' => [
                'country' => [
                  'code' => Locations::DEFAULT_COUNTRY_CODE,
                ],
                'province' => [
                  'code' => '',
                ],
              ],
              'postalCode' => '',
            ],
            'phoneNumber' => '',
          ],
        ],
      ],
    ];
  }

  /**
   * Get payment transactions defaults.
   *
   * @param bool $all_passengers
   *   Add the 'allPassengers' flag.
   *
   * @return array
   *   The payment transactions defaults.
   */
  public static function paymentTransactions($all_passengers = TRUE) {
    $defaults = [
      [
        'paymentMethod' => self::visa(),
        'paymentMethodCriteria' => NULL,
        'currencyAmounts' => [
          [
            'totalAmount' => 0,
            'currency' => [
              'code' => Currency::US_CURRENCY_CODE,
              'baseCurrency' => TRUE,
            ],
            'exchangeRate' => 1.0,
          ],
        ],
      ],
    ];

    if ($all_passengers) {
      $defaults[0]['allPassengers'] = TRUE;
    }

    return $defaults;
  }

  /**
   * Get contact information defaults.
   *
   * @return array
   *   The contact information defaults.
   */
  public static function contactInformation() {
    return [
      'title' => '',
      'firstName' => '',
      'middleName' => '',
      'lastName' => '',
      'address' => [
        'address1' => '',
        'address2' => '',
        'city' => '',
        'location' => [
          'country' => [
            'code' => Locations::DEFAULT_COUNTRY_CODE,
          ],
          'province' => [
            'code' => '',
          ],
        ],
        'postalCode' => '',
      ],
      'birthDate' => '',
      'advancePassengerInformation' => [
        'redressNumber' => '',
        'knownPassengerNumber' => '',
      ],
      'personalContactInformation' => [
        'email' => '',
        'phoneNumber' => '',
        'mobileNumber' => '',
        'notificationPreferences' => [],
      ],
      'loyaltyProgram' => [
        'number' => '',
      ],
      'withInfant' => 0,
      'infant' => [
        'firstName' => '',
        'lastName' => '',
        'birthDate' => '',
      ],
    ];
  }

  /**
   * Get confirmed reservation status.
   *
   * @return array
   *   The confirmed reservation status.
   */
  public static function confirmedReservationStatus() {
    return [
      'confirmed' => TRUE,
      'waitlist' => FALSE,
      'standby' => FALSE,
      'cancelled' => FALSE,
      'open' => FALSE,
      'finalized' => FALSE,
      'external' => FALSE,
    ];
  }

  /**
   * Get ticket defaults.
   *
   * @return array
   *   The ticket defaults.
   */
  public static function ticket() {
    return [
      'isRoundtrip' => '',
      'departure' => '',
      'arrival' => '',
      'from' => '',
      'to' => '',
      'adultCount' => 1,
      'childCount' => 0,
      'infantCount' => 0,
      'fees' => 0,
      'taxes' => 0,
      'total' => 0,
    ];
  }

  /**
   * Get American Express payment method.
   *
   * @return array
   *   The payment method.
   */
  public static function amex() {
    return [
      'key' => 'tfCeB5¥mircWvs2C4HkDdOXNJfƒNFOopDW2yQCBh2p2CWI6uHhJCxgKQnaB4BNas0Bl2j8aZYBc0sYJEEgkjVg==',
      'identifier' => 'AX',
    ];
  }

  /**
   * Get VISA payment method.
   *
   * @return array
   *   The payment method.
   */
  public static function visa() {
    return [
      'key' => 'tfCeB5¥mircWvs2C4HkDdOXNJfƒNFOopDW2yQCBh2p1vS93Us9cXxYƒw94khSgGf2ea¥ExvYF1274KsvbV3paw==',
      'identifier' => 'VI',
    ];
  }

  /**
   * Get Discover payment method.
   *
   * @return array
   *   The payment method.
   */
  public static function discover() {
    return [
      'key' => 'tfCeB5¥mircWvs2C4HkDdOXNJfƒNFOopDW2yQCBh2p1rOTwFA5LN6VUgknLR¥uSR¥eMvX9GDje1StY7wbQ3n2A==',
      'identifier' => 'DC',
    ];
  }

  /**
   * Get MasterCard payment method.
   *
   * @return array
   *   The payment method.
   */
  public static function mastercard() {
    return [
      'key' => 'tfCeB5¥mircWvs2C4HkDdOXNJfƒNFOopDW2yQCBh2p1AuSbxTJj2UqzUc4Ck91xspsOlecpL5aqwqwENWdei2A==',
      'identifier' => 'MC',
    ];
  }

  /**
   * Get voucher payment method.
   *
   * @return array
   *   The payment method.
   */
  public static function voucher() {
    return [
      'key' => 'tfCeB5¥mircWvs2C4HkDdOXNJfƒNFOopDW2yQCBh2p2SQ5¥kk8PQ7XFƒ¥HBWKcNVlqkZqU8SRI0E86wxDmuxrA==',
      'identifier' => 'VCHR',
    ];
  }

}
