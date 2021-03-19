<?php

namespace Drupal\aco_edit_leg\Form;

use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Form\PaymentFormBase;

/**
 * Provides a base class for the edit leg payment forms.
 */
abstract class EditLegFormBase extends PaymentFormBase {

  /**
   * Get the passenger journey details.
   *
   * @return array
   *   The passenger journey details.
   */
  public function getPassengerJourneyDetails() {
    $passengers = $this->reservation['journeys'][$this->editedLegIndex]['passengerJourneyDetails'];
    $booking_key = $this->getBookingKey($this->values['departure_flight']);
    foreach ($passengers as &$passenger) {
      $passenger['bookingKey'] = $booking_key;
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
    $journeys[$this->editedLegIndex] = [
      'key' => $journeys[$this->editedLegIndex]['key'],
      'passengerJourneyDetails' => $this->getPassengerJourneyDetails(),
      'reservationStatus' => [
        'cancelled' => FALSE,
        'open' => FALSE,
        'finalized' => FALSE,
        'external' => FALSE,
      ],
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
      'httpMethod' => 'PUT',
      'requestUri' => "/reservations/{$this->reservation['key']}/journeys/{$this->reservation['journeys'][$this->editedLegIndex]['key']}",
      'journeys' => $this->getJourneys(),
      'ancillaryPurchases' => $this->values['ancillaryPurchases'],
      // @todo Add seat selections.
      // 'seatSelections' => $this->reservation['seatSelections'],
      'paymentTransactions' => Defaults::paymentTransactions(),
    ]);
  }

}
