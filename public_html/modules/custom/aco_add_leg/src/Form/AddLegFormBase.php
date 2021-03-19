<?php

namespace Drupal\aco_add_leg\Form;

use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Form\PaymentFormBase;

/**
 * Provides a base class for add leg payment forms.
 */
abstract class AddLegFormBase extends PaymentFormBase {

  /**
   * Get the passenger journey details.
   *
   * @return array
   *   The passenger journey details.
   */
  public function getPassengerJourneyDetails() {
    $passengers = [];
    $booking_key = $this->getBookingKey($this->values['departure_flight']);
    foreach ($this->reservation['passengers'] as $passenger) {
      $passengers[] = [
        'passenger' => [
          'href' => $passenger['href'],
          'key' => $passenger['key'],
        ],
        'bookingKey' => $booking_key,
        'reservationStatus' => Defaults::confirmedReservationStatus(),
      ];
    }
    return $passengers;
  }

  /**
   * Get journeys.
   *
   * @return array
   *   The journeys.
   */
  public function getJourneys() {
    $journeys = $this->reservation['journeys'];
    $journeys[] = [
      'index' => 1,
      'passengerJourneyDetails' => $this->getPassengerJourneyDetails(),
    ];
    return $journeys;
  }

  /**
   * Get the quote.
   *
   * @return array|bool
   *   The quote or false on failure.
   */
  public function getQuote() {
    return $this->callEndpoint('putQuotations', [
      'httpMethod' => 'POST',
      'requestUri' => "/reservations/{$this->reservation['key']}/journeys",
      'passengers' => $this->reservation['passengers'],
      'journeys' => $this->getJourneys(),
      'ancillaryPurchases' => $this->values['ancillaryPurchases'],
      // @todo Add seat selections.
      'seatSelections' => $this->reservation['seatSelections'],
      'paymentTransactions' => Defaults::paymentTransactions(),
    ]);
  }

}
