<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\aco_core\Form\PaymentFormBase;
use Drupal\aco_core\Utility\Defaults;

/**
 * Provides a base class for booking payment forms.
 */
abstract class BookingFormBase extends PaymentFormBase {

  /**
   * Get the quote.
   *
   * @return array|bool
   *   The quote or false on failure.
   */
  public function getQuote() {
    return $this->callEndpoint('putQuotations', [
      'httpMethod' => 'POST',
      'requestUri' => '/reservations',
      'passengers' => $this->getPassengers(),
      'journeys' => $this->getJourneys(),
      'ancillaryPurchases' => $this->values['ancillaryPurchases'],
      'seatSelections' => $this->values['seatSelections'],
      'paymentTransactions' => Defaults::paymentTransactions(),
    ]);
  }

  /**
   * Helper function to get prepared passengers.
   *
   * @return array
   *   The passengers.
   */
  public function getPassengers() {
    $passengers = [];
    foreach ($this->values['passengers'] as $passenger_index => $passenger) {
      $passengers[] = $this->getPassenger($passenger_index, $passenger);
    }
    return $passengers;
  }

  /**
   * Helper function to get journeys.
   *
   * @return array
   *   The journeys.
   */
  public function getJourneys() {
    $booking_keys = [$this->getBookingKey($this->values['departure_flight'])];

    if (!empty($this->values['arrival_flight'])) {
      $booking_keys[] = $this->getBookingKey($this->values['arrival_flight']);
    }

    $journeys = [];
    foreach ($booking_keys as $booking_key_index => $booking_key) {
      $journeys[] = $this->getJourney($booking_key_index, $booking_key);
    }

    return $journeys;
  }

}
