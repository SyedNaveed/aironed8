<?php

namespace Drupal\aco_core\Traits;

use Drupal\intelisys\Utility\TimeHelper;
use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Utility\Prepare;

/**
 * A booking trait.
 */
trait BookingTrait {

  /**
   * Get booking key indexes.
   *
   * @param string $value
   *   The value to parse.
   *
   * @return array
   *   The booking key indexes.
   */
  protected function getBookingKeyIndexes($value) {
    list($travel_option_index, $fare_option_index) = explode('/', $value);
    return [intval($travel_option_index), intval($fare_option_index)];
  }

  /**
   * Get booking key.
   *
   * @param string $value
   *   The value to parse.
   *
   * @return string
   *   The booking key.
   */
  protected function getBookingKey($value) {
    if ($travel_options = $this->getTravelOptions()) {
      $indexes = $this->getBookingKeyIndexes($value);
      return $travel_options[$indexes[0]]['fareOptions'][$indexes[1]]['bookingKey'];
    }

    return '';
  }

  /**
   * Get table caption.
   *
   * @param string $journey
   *   The journey to use.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The caption.
   */
  protected function getTableCaption($journey) {
    $booking_key_indexes = $this->getBookingKeyIndexes($this->values[$journey]);
    $travel_options = $this->getTravelOptions();
    end($travel_options[$booking_key_indexes[0]]['flights']);
    $last_key = key($travel_options[$booking_key_indexes[0]]['flights']);
    return $this->t('@airline@flight From @from To @to', [
      '@airline' => $travel_options[$booking_key_indexes[0]]['flights'][0]['airlineCode']['code'],
      '@flight' => $travel_options[$booking_key_indexes[0]]['flights'][0]['flightNumber'],
      '@from' => $travel_options[$booking_key_indexes[0]]['flights'][0]['departure']['airport']['name'],
      '@to' => $travel_options[$booking_key_indexes[0]]['flights'][$last_key]['arrival']['airport']['name'],
    ]);
  }

  /**
   * Helper function to get a prepared passenger.
   *
   * @param int $passenger_index
   *   The passenger index.
   * @param array $passenger
   *   The passenger.
   *
   * @return array
   *   The passenger.
   */
  public function getPassenger($passenger_index, array $passenger) {
    Prepare::contactInformation($passenger);

    // Add static variables.
    $passenger['preBoard'] = FALSE;
    $passenger['status'] = [
      'active' => TRUE,
      'inactive' => FALSE,
      'denied' => FALSE,
    ];

    // Check fare applicability.
    $birth = strtotime($passenger['birthDate']);
    $is_adult = TimeHelper::isAdult($birth);

    // Add advance passenger information.
    $api = [];
    if (!empty($passenger['advancePassengerInformation'])) {
      $api = $passenger['advancePassengerInformation'];
      unset($passenger['advancePassengerInformation']);
      $api['firstName'] = $passenger['firstName'];
      $api['lastName'] = $passenger['lastName'];
    }

    // Add infants.
    $infants = [];
    if (!empty($passenger['infants'])) {
      $infants[] = [
        'index' => 1,
        'reservationProfile' => $passenger['infants'][0]['reservationProfile'],
      ];
    }

    return [
      'index' => $passenger_index + 1,
      'fareApplicability' => [
        'child' => !$is_adult,
        'adult' => $is_adult,
      ],
      'reservationProfile' => $passenger,
      'advancePassengerInformation' => $api,
      'infants' => $infants,
    ];
  }

  /**
   * Helper function to get journeys.
   *
   * @param int $booking_key_index
   *   The booking key index.
   * @param string $booking_key
   *   The booking key.
   *
   * @return array
   *   The journey.
   */
  public function getJourney($booking_key_index, $booking_key) {
    $journey = [
      'index' => $booking_key_index + 1,
      'passengerJourneyDetails' => [],
      'reservationStatus' => [
        'cancelled' => FALSE,
        'open' => FALSE,
        'finalized' => FALSE,
        'external' => FALSE,
      ],
    ];
    foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
      $journey['passengerJourneyDetails'][] = [
        'passenger' => [
          'index' => $passenger_index + 1,
        ],
        'segment' => NULL,
        'bookingKey' => $booking_key,
        'reservationStatus' => Defaults::confirmedReservationStatus(),
      ];
    }

    return $journey;
  }

}
