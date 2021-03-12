<?php

namespace Drupal\aco_core\Traits;

use Drupal\Core\Url;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\TimeHelper;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * A reservation trait.
 */
trait ReservationTrait {

  /**
   * The current reservation.
   *
   * @var array
   */
  protected $reservation;

  /**
   * A canceled reservation flag.
   *
   * @var bool
   */
  protected $canceled;

  /**
   * An expired reservation flag.
   *
   * @var bool
   */
  protected $expired = FALSE;

  /**
   * Initialize the reservation.
   */
  protected function initReservation() {
    $this->reservation = $this->getReservation();

    // Redirect user to search for their reservation if one was not found.
    if (FALSE === $this->reservation) {
      $response = new RedirectResponse(Url::fromRoute('aco_manage_flight.manage_flight')->toString());
      $response->send();
      exit();
    }
    // @todo Verify logic here.
    // Check if the reservation is canceled.
    else {
      foreach ($this->reservation['journeys'] as &$journey) {
        // If any journey is 'open', then the reservation is not canceled.
        if (!$journey['reservationStatus']['cancelled'] && !$journey['reservationStatus']['finalized']) {
          $this->canceled = FALSE;
        }

        // If one or more journeys are canceled then this reservation should be
        // considered canceled granted there are no 'open' journeys.
        if ($this->canceled !== FALSE && $journey['reservationStatus']['cancelled']) {
          $this->canceled = TRUE;
        }

        // Check if the reservation is expired.
        if ($this->hasExpiredLegs($journey)) {
          $this->expired = TRUE;
        }
      }
      if ($this->canceled === NULL) {
        $this->canceled = FALSE;
      }
    }
  }

  /**
   * Get current reservation.
   *
   * @return bool|array
   *   The reservation array or false if there was an error.
   */
  protected function getReservation() {
    static $reservation;

    if (!empty($reservation)) {
      return $reservation;
    }

    $reservation = FALSE;
    $session = \Drupal::request()->getSession();
    if ($key = $session->get('reservation_key')) {
      $reservation = $this->callEndpoint('getReservation', [
        'key' => $key,
      ]);
    }

    return $reservation;
  }

  /**
   * Get journey status.
   *
   * @param array $journey
   *   The journey to check.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The journey status.
   */
  protected function getJourneyStatus(array &$journey) {
    // @todo Verify logic here.
    if ($journey['reservationStatus']['cancelled']) {
      return $this->t('Canceled');
    }
    if ($journey['reservationStatus']['finalized'] || $this->hasExpiredLegs($journey)) {
      return $this->t('Finalized');
    }
    return $this->t('Active');
  }

  /**
   * Check if journey is active.
   *
   * @param array $journey
   *   The journey to check.
   *
   * @return bool
   *   Whether the journey is active or not.
   */
  protected function isJourneyActive(array &$journey) {
    $status = &$journey['reservationStatus'];
    return !$status['cancelled'] && !$status['finalized'] && !$this->hasExpiredLegs($journey);
  }

  /**
   * Check for expired legs.
   *
   * @param array $journey
   *   The journey to check.
   *
   * @return bool
   *   Flag for whether or not the journey has expired legs.
   */
  protected function hasExpiredLegs(array &$journey) {
    end($journey['segments']);
    $key = key($journey['segments']);
    $arrival_time = strtotime($journey['segments'][$key]['arrival']['scheduledTime']);
    return REQUEST_TIME > $arrival_time;
  }

  /**
   * Get passenger counts.
   *
   * @return array
   *   The counts.
   */
  protected function getPassengerCounts() {
    $counts = [
      'adultCount' => 0,
      'childCount' => 0,
      'infantCount' => 0,
    ];

    foreach ($this->reservation['passengers'] as $passenger_index => &$passenger) {
      $birth = strtotime($passenger['reservationProfile']['birthDate']);
      if (TimeHelper::isAdult($birth)) {
        $counts['adultCount']++;
      }
      else {
        $counts['childCount']++;
      }

      if (!empty($passenger['infants'])) {
        $counts['infantCount']++;
      }
    }

    return $counts;
  }

  /**
   * Get total charges.
   *
   * @return int|float
   *   The total charges.
   */
  protected function getTotalCharges() {
    return $this->getTotal('charges');
  }

  /**
   * Get total payments.
   *
   * @return int|float
   *   The total payments.
   */
  protected function getTotalPayments() {
    return $this->getTotal('paymentTransactions');
  }

  /**
   * Get total.
   *
   * @param string $key
   *   The total to get.
   *
   * @return int|float
   *   The total.
   */
  private function getTotal($key) {
    $total = 0;
    foreach ($this->reservation[$key] as &$item) {
      foreach ($item['currencyAmounts'] as &$amount) {
        if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
          $total += $amount['totalAmount'];
        }
      }
    }
    return $total;
  }

}
