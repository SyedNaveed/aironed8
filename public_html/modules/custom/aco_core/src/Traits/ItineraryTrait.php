<?php

namespace Drupal\aco_core\Traits;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\intelisys\Utility\CommunicationChannels;
use Drupal\intelisys\Utility\TimeHelper;
use Drupal\intelisys\Utility\Currency;

/**
 * An itinerary trait.
 */
trait ItineraryTrait {

  /**
   * Returns a render-able array for the trip details.
   *
   * @param array $data
   *   The journeys to use.
   *
   * @return array
   *   The trip details.
   */
  protected function getTripDetails(array &$data) {
    $header = [
      $this->t('From'),
      $this->t('To'),
      $this->t('Departs'),
      $this->t('Arrives'),
      $this->t('Date'),
      $this->t('Flight Detail'),
    ];

    $journeys = [];
    $time_format = DateFormat::load('short_time')->getPattern();
    $date_format = DateFormat::load('medium_date')->getPattern();
    foreach ($data as &$journey) {
      // Only used for sorting. Timezone alteration is not needed here.
      $actual_departure_time = strtotime($journey['segments'][0]['departure']['scheduledTime']);
      $actual_arrival_time = strtotime($journey['segments'][0]['arrival']['scheduledTime']);

      $item = [
        'canceled' => $journey['reservationStatus']['cancelled'],
        'actual_departure' => $actual_departure_time,
        'actual_arrival' => $actual_arrival_time,
        'segments' => [],
      ];

      $count = count($journey['segments']);
      foreach ($journey['segments'] as $key => &$segment) {
        $flight_number = $segment['flight']['airlineCode']['code'] . $segment['flight']['flightNumber'];
        foreach ($segment['legs'] as &$leg) {
          if (isset($leg['flight'])) {
            $flight_number = $leg['flight']['airlineCode']['code'] . $leg['flight']['flightNumber'];
          }

          if (0 == $key) {
            $item['segments'][] = [
              [
                'data' => $leg['departure']['airport']['name'],
                'rowspan' => $count,
              ],
              [
                'data' => $leg['arrival']['airport']['name'],
                'rowspan' => $count,
              ],
              [
                'data' => $this->t('@time @code', [
                  '@time' => TimeHelper::getLocalTime($leg['departure'], $time_format),
                  '@code' => $leg['departure']['airport']['code'],
                ]),
              ],
              [
                'data' => $this->t('@time @code', [
                  '@time' => TimeHelper::getLocalTime($leg['arrival'], $time_format),
                  '@code' => $leg['arrival']['airport']['code'],
                ]),
              ],
              [
                'data' => TimeHelper::getLocalTime($leg['departure'], $date_format),
              ],
              ['data' => $flight_number],
            ];
          }
          else {
            $item['segments'][] = [
              [
                'data' => $this->t('@time @code', [
                  '@time' => TimeHelper::getLocalTime($leg['departure'], $time_format),
                  '@code' => $leg['departure']['airport']['code'],
                ]),
              ],
              [
                'data' => $this->t('@time @code', [
                  '@time' => TimeHelper::getLocalTime($leg['arrival'], $time_format),
                  '@code' => $leg['arrival']['airport']['code'],
                ]),
              ],
              [
                'data' => TimeHelper::getLocalTime($leg['departure'], $date_format),
              ],
              ['data' => $flight_number],
            ];
          }
        }
      }

      $journeys[] = $item;
    }

    // Sort journeys.
    usort($journeys, '_aco_core_sort_flights');

    // Prepare rows for output.
    $rows = [];
    foreach ($journeys as &$journey) {
      $rows = array_merge($rows, $journey['segments']);
    }

    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  /**
   * Returns a render-able array for a charge summary.
   *
   * @param array|null $charges
   *   The charges.
   *
   * @return array
   *   A render-able array.
   */
  protected function getChargeSummary(&$charges) {
    $rows = [];
    $total_cost = 0;
    if (is_array($charges) && !empty($charges)) {
      foreach ($charges as &$charge) {
        foreach ($charge['currencyAmounts'] as &$amount) {
          if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
            $total_cost += $amount['totalAmount'];
            $rows[] = [
              '#theme' => 'charges_row',
              '#description' => $charge['description'],
              '#amount' => Currency::toPrice($amount['baseAmount']),
              '#taxes' => Currency::toPrice($amount['taxAmount']),
              '#total' => Currency::toPrice($amount['totalAmount']),
            ];
          }
        }
      }
    }

    return [
      '#theme' => 'charges_table',
      '#charges' => $rows,
      '#total_cost' => Currency::toPrice($total_cost, Currency::US_CURRENCY_CODE),
    ];
  }

  /**
   * Build a contact information table.
   *
   * @param array $passengers
   *   The passengers to create contact information tables for.
   *
   * @return array
   *   A render-able array.
   */
  protected function getReservationOwnerContactInformation(array &$passengers) {
    $passenger_index = 0;
    if (isset($passenger[0]['reservationOwner'])) {
      foreach ($passengers as $key => &$passenger) {
        if ($passenger['reservationOwner']) {
          $passenger_index = $key;
          break;
        }
      }
    }
    return $this->getContactInformation($passengers, $passenger_index);
  }

  /**
   * Build a contact information table.
   *
   * @param array $passengers
   *   The passengers to create contact information tables for.
   * @param int $passenger_index
   *   The passenger index to get.
   *
   * @return array
   *   A render-able array.
   */
  protected function getContactInformation(array &$passengers, $passenger_index = 0) {
    // Format Advance Passenger Information.
    $api = [];
    if (!empty($passengers[$passenger_index]['advancePassengerInformation'])) {
      $api = $passengers[$passenger_index]['advancePassengerInformation'];
    }

    $selections = [];
    // Check if this is an Intelisys modeled passenger.
    if (isset($passengers[$passenger_index]['reservationProfile'])) {
      $passenger = &$passengers[$passenger_index]['reservationProfile'];

      // Format Notification Preferences.
      if (!empty($passenger['personalContactInformation']['notificationPreferences'])) {
        foreach ($passenger['personalContactInformation']['notificationPreferences'] as &$channel) {
          $selections[] = $channel['name'];
        }
      }
    }
    else {
      $passenger = $passengers[$passenger_index];
      $passenger['birthDate'] = TimeHelper::getYmd($passenger['birthDateYear'], $passenger['birthDateMonth'], $passenger['birthDateDay']);

      // Format Notification Preferences.
      if (!empty($passenger['personalContactInformation']['notificationPreferences'])) {
        $preferences = &$passenger['personalContactInformation']['notificationPreferences'];
        $checked = array_intersect(array_keys($preferences), array_values($preferences));
        $communication_channels = CommunicationChannels::getCommunicationChannels();
        foreach ($communication_channels as &$channel) {
          if (in_array($channel['identifier'], $checked)) {
            $selections[] = $channel['name'];
          }
        }
      }
    }

    return [
      '#theme' => 'contact_information',
      '#honorific' => $passenger['title'],
      '#firstName' => $passenger['firstName'],
      '#middleName' => $passenger['middleName'],
      '#lastName' => $passenger['lastName'],
      '#address1' => $passenger['address']['address1'],
      '#address2' => $passenger['address']['address2'],
      '#city' => $passenger['address']['city'],
      '#country' => $passenger['address']['location']['country']['code'],
      '#province' => $passenger['address']['location']['province']['code'],
      '#postalCode' => $passenger['address']['postalCode'],
      '#birthDate' => $passenger['birthDate'],
      '#loyaltyProgram' => !empty($passenger['loyaltyProgram']) ? $passenger['loyaltyProgram']['number'] : NULL,
      '#redressNumber' => !empty($api['redressNumber']) ? $api['redressNumber'] : NULL,
      '#knownPassengerNumber' => !empty($api['knownPassengerNumber']) ? $api['knownPassengerNumber'] : NULL,
      '#email' => $passenger['personalContactInformation']['email'],
      '#phoneNumber' => $passenger['personalContactInformation']['phoneNumber'],
      '#mobileNumber' => $passenger['personalContactInformation']['mobileNumber'],
      '#notificationPreferences' => empty($selections) ? $this->t('None') : [
        '#markup' => implode(', ', $selections),
      ],
    ];
  }

  /**
   * Get payment information.
   *
   * @return array
   *   A render-able array.
   */
  protected function getPaymentInformation() {
    $types = [
      'amex' => $this->t('American Express'),
      'visa' => $this->t('Visa'),
      'discover' => $this->t('Discover'),
      'mastercard' => $this->t('MasterCard'),
    ];
    $cc = &$this->values['billing']['creditCard'];

    return [
      '#theme' => 'payment_information',
      '#payment_type' => $types[$this->values['paymentMethod']['identifier']],
      '#card_number' => str_repeat('X', strlen($cc['number']) - 4) . substr($cc['number'], -4),
      '#expiry' => $cc['expiry'],
      '#name' => $cc['billing']['contactInformation']['name'],
      '#address1' => $cc['billing']['address']['address1'],
      '#address2' => $cc['billing']['address']['address2'],
      '#city' => $cc['billing']['address']['city'],
      '#country' => $cc['billing']['address']['location']['country']['code'],
      '#province' => $cc['billing']['address']['location']['province']['code'],
      '#postalCode' => $cc['billing']['address']['postalCode'],
      '#phoneNumber' => $cc['billing']['phoneNumber'],
    ];
  }

}
