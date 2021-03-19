<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\LegsTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_passengers\Traits\AddPassengersTrait;

/**
 * Implements a new passengers confirm form.
 */
class ConfirmForm extends AddPassengersFormBase {
  use IntelisysTrait;
  use ReservationTrait;
  use BookingTrait;
  use AddPassengersTrait;
  use AddServiceTrait;
  use LegsTrait;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_add_passengers_confirm_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'confirm');

    // Get Terms & Conditions page URL site setting.
    $site_settings = \Drupal::service('site_settings.loader');
    $general = $site_settings->loadByFieldset('general');

    $this->getChargeTables($form);
    $form['confirm'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I agree to be bound by the applicable <a href=":terms_url" target="_blank">Terms and Conditions</a> and <a href=":contract_url" target="_blank">Contract of Carriage</a>.', [
        ':terms_url' => $general['terms_conditions_page']['url']->toString(),
        ':contract_url' => $general['contract_carriage_page']['url']->toString(),
      ]),
      '#required' => TRUE,
    ];
    $form['instructions'] = [
      '#type' => 'container',
      '#markup' => $this->t('<p>Please Note: Do not refresh this page or submit this form more than once.</p>'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $this->fillValues($form_state);
    $payment_transactions = $this->total > 0 ? $this->getPaymentTransactions() : NULL;

    $success = TRUE;
    $passengers = [];
    foreach ($this->values['passengers'] as $passenger_index => $passenger) {
      $reservation_passenger = $this->getPassenger(0, $passenger);
      $reservation_passenger['journeys'] = $this->getPassengerJourneys($passenger_index);
      $result = $this->callEndpoint('postReservationPassengers', [
        'key' => $this->reservation['key'],
        'paymentTransactions' => $payment_transactions,
      ] + $reservation_passenger);

      // Keep track of progress.
      if (is_array($result) && isset($result['reservationStatus']) && $result['reservationStatus']['confirmed']) {
        $passengers[] = $this->t('@first @last', [
          '@first' => $result['reservationProfile']['firstName'],
          '@last' => $result['reservationProfile']['lastName'],
        ]);
      }
      else {
        $success = FALSE;
      }
    }

    // Prevent the next step if the purchases failed.
    if (FALSE === $success || empty($passengers)) {
      $form_state->setError($form, $this->t('An error occurred while purchasing. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    else {
      $passengers_text = array_pop($passengers);
      if (!empty($passengers)) {
        $passengers_text = $this->formatPlural(count($passengers), '@rest and @last', '@rest, and @last', [
          '@rest' => implode(', ', $passengers),
          '@last' => $passengers_text,
        ]);
      }
      $this->messenger()->addStatus($this->t('The following passenger(s) have been added to the reservation: @passengers', [
        '@passengers' => $passengers_text,
      ]));
      $this->messenger()->addStatus($this->t('Transaction completed, the credit card was charged: @price', [
        '@price' => Currency::toPrice($this->total, Currency::US_CURRENCY_CODE),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
