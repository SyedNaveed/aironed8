<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ItineraryTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a confirmation form.
 */
class ConfirmForm extends BookingFormBase {
  use BookingTrait;
  use IntelisysTrait;
  use ItineraryTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_confirm_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'confirm')) {
      return $form;
    }

    // Get Terms & Conditions page URL site setting.
    $site_settings = \Drupal::service('site_settings.loader');
    $general = $site_settings->loadByFieldset('general');

    $quote = $this->getQuote();
    $form['#theme'] = 'form__book_flight_confirm';
    $form['title'] = ['#markup' => $this->t('Confirm Reservation Information')];
    $form['trip_details'] = $this->getTripDetailsFromTravelOptions();
    $form['charge_summary'] = $this->getChargeSummary($quote['charges']);
    $form['contact_information'] = $this->getReservationOwnerContactInformation($this->values['passengers']);
    $form['payment_information'] = $this->getPaymentInformation();
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
    $reservation = $this->callEndpoint('postReservations', [
      'passengers' => $this->getPassengers(),
      'journeys' => $this->getJourneys(),
      'ancillaryPurchases' => $this->values['ancillaryPurchases'],
      'seatSelections' => $this->values['seatSelections'],
      'paymentTransactions' => $this->getPaymentTransactions(),
    ]);

    // Prevent the next step if the purchase failed.
    if (FALSE === $reservation || empty($reservation)) {
      $form_state->setError($form, $this->t('An error occurred while purchasing. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    else {
      // Email all passengers.
      $this->callEndpoint('postEmailItinerary', [
        'key' => $reservation['key'],
        'languageCode' => INTELIYSYS_ENGLISH_LANG_CODE,
        'itineraryTypeCode' => INTELIYSYS_DETAILED_ITINERARY,
        'includeAllPassengers' => TRUE,
      ], FALSE);

      // Save reservation key to session.
      $this->getRequest()->getSession()->set('reservation_key', $reservation['key']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your reservation has been confirmed.'));
    $form_state->setRedirect('aco_book_flight.confirmed_itinerary');
  }

  /**
   * Get trip details from travel options session variable.
   *
   * @return array
   *   The trip details.
   */
  private function getTripDetailsFromTravelOptions() {
    $travel_options = $this->getTravelOptions();

    $journeys = [];
    foreach (['departure_flight', 'arrival_flight'] as &$journey) {
      if (!empty($this->values[$journey])) {
        $booking_key_indexes = $this->getBookingKeyIndexes($this->values[$journey]);
        $legs = [];
        foreach ($travel_options[$booking_key_indexes[0]]['flights'] as &$flight) {
          $legs[] = [
            'flight' => [
              'flightNumber' => $flight['flightNumber'],
              'airlineCode' => $flight['airlineCode'],
            ],
            'departure' => $flight['departure'],
            'arrival' => $flight['arrival'],
          ];
        }
        end($legs);
        $last_key = key($legs);
        $journeys[] = [
          'reservationStatus' => ['cancelled' => FALSE],
          'segments' => [
            [
              'flight' => [
                'flightNumber' => $flight['flightNumber'],
                'airlineCode' => $flight['airlineCode'],
              ],
              'departure' => $legs[0]['departure'],
              'arrival' => $legs[$last_key]['arrival'],
              // We are assuming the flight is not canceled.
              'legs' => $legs,
            ],
          ],
        ];
      }
    }

    return $this->getTripDetails($journeys);
  }

}
