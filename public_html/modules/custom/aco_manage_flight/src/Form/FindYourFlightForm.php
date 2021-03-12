<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\IntelisysTrait;

/**
 * Implements a find your flight form.
 */
class FindYourFlightForm extends FormBase {
  use IntelisysTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_manage_flight_find_your_flight_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['reservationLocator'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reservation Number'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Reservation Number'),
      '#required' => TRUE,
    ];
    $form['passengerLastName'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Last Name'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Get applicable reservations.
    $reservations = $this->callEndpoint('getReservations', [
      'reservationLocator' => $values['reservationLocator'],
      'passengerLastName' => $values['passengerLastName'],
    ]);

    if (FALSE === $reservations) {
      $form_state->setError($form, $this->t('An error occurred while retrieving your reservation. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    // Quit if no reservations are found or save reservations for the next step.
    elseif (empty($reservations)) {
      $form_state->setErrorByName('reservationLocator', $this->t('Reservation not found.'));
    }
    else {
      $cached_values = $form_state->getTemporaryValue('wizard');
      $cached_values['reservations'] = $reservations;
      $form_state->setTemporaryValue('wizard', $cached_values);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
