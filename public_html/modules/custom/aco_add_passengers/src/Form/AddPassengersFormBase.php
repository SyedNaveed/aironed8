<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Form\PaymentFormBase;

/**
 * Provides a base class for add passengers payment forms.
 */
abstract class AddPassengersFormBase extends PaymentFormBase {

  /**
   * Get passenger journeys.
   *
   * @param int $passenger_index
   *   The passenger index.
   *
   * @return array
   *   The passenger journeys.
   */
  protected function getPassengerJourneys($passenger_index) {
    $journeys = [];
    foreach ($this->reservation['journeys'] as $journey_key => &$journey) {
      if ($this->isJourneyActive($journey)) {
        foreach ($this->selectedTravelOptions as $travel_key => &$travel_option) {
          // Check that the travel option is the same as the journey.
          if ($travel_option['flights'][0]['key'] == $journey['segments'][0]['flight']['key']) {
            $journey_string_key = 'journey_' . $journey_key;
            $fare_option_index = $this->values[$journey_string_key];
            $booking_key = $travel_option['fareOptions'][$fare_option_index]['bookingKey'];
            $journey_index = count($journeys) + 1;
            $journeys[] = [
              'href' => $journey['href'],
              'key' => $journey['key'],
              'index' => $journey_index,
              'passengerJourneyDetails' => [
                [
                  'passenger' => [
                    'index' => 1,
                  ],
                  'segment' => NULL,
                  'bookingKey' => $booking_key,
                  'reservationStatus' => Defaults::confirmedReservationStatus(),
                ],
              ],
              'reservationStatus' => $journey['reservationStatus'],
              'ancillaryPurchases' => $this->getAncillaryPurchases($booking_key, $journey_index, $passenger_index + 1),
            ];
          }
        }
      }
    }

    return $journeys;
  }

  /**
   * Get ancillary purchases.
   *
   * @param string $booking_key
   *   The booking key.
   * @param int $journey_index
   *   The journey index.
   * @param int $passenger_index
   *   The passenger index.
   *
   * @return array
   *   The ancillary purchases.
   */
  public function getAncillaryPurchases($booking_key, $journey_index, $passenger_index) {
    $ancillary_purchases = [];
    $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
      'bookingKey' => $booking_key,
    ]);
    if (!empty($ancillary_options)) {
      foreach ($ancillary_options as &$ancillary_option) {
        foreach ($this->values['ancillaryPurchases'] as $ancillary_purchase) {
          if ($ancillary_purchase['journey']['index'] == $journey_index && $ancillary_purchase['passenger']['index'] == $passenger_index) {
            $ancillary_purchases[] = $ancillary_purchase;
          }
        }
      }
    }
    return $ancillary_purchases;
  }

  /**
   * Get the quote.
   *
   * @return array|bool
   *   The quote or false on failure.
   */
  public function getQuote() {
    $passenger = $this->getPassenger(0, $this->values['passengers'][0]);
    $passenger['journeys'] = $this->getPassengerJourneys(0);
    return $this->callEndpoint('putQuotations', [
      'httpMethod' => 'POST',
      'requestUri' => "/reservations/{$this->reservation['key']}/passengers",
      'passengers' => [$passenger],
      // @todo Add ancillary purchases.
      // 'ancillaryPurchases' => $this->values['ancillaryPurchases'],
      // @todo Add seat selections.
      // 'seatSelections' => $this->values['seatSelections'],
      'paymentTransactions' => Defaults::paymentTransactions(),
    ]);
  }

}
