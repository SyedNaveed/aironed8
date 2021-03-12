<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Render\Markup;
use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\IntelisysTrait;

/**
 * Implements a select reservation form.
 */
class SelectReservationForm extends FormBase {
  use IntelisysTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_manage_flight_select_reservation_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];

    $header = [
      'reservation_locator' => $this->t('Reservation Number'),
      'passenger_name' => $this->t('Passenger Name'),
      'flight_info' => $this->t('Flight Info'),
      'seats' => $this->t('Seats'),
    ];

    $options = [];
    $cached_values = $form_state->getTemporaryValue('wizard');
    if (!empty($cached_values['reservations'])) {
      foreach ($cached_values['reservations'] as &$reservation) {
        // Get the number of passengers.
        $passengers = $this->callEndpoint('getReservationPassengers', [
          'key' => $reservation['key'],
        ]);

        $options[] = [
          'reservation_locator' => $reservation['locator'],
          'passenger_name' => $this->t('@last, @first', [
            '@last' => $reservation['reservationSummary']['passenger']['reservationProfile']['lastName'],
            '@first' => $reservation['reservationSummary']['passenger']['reservationProfile']['firstName'],
          ]),
          'flight_info' => [
            'data' => [
              '#markup' => Markup::create(nl2br(Html::escape($reservation['reservationSummary']['itinerary']))),
            ],
          ],
          'seats' => count($passengers),
        ];
      }
    }

    $form['reservation_index'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#multiple' => FALSE,
      '#empty' => $this->t('No reservations found'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $reservation_index = (int) $form_state->getValue('reservation_index');
    $cached_values = $form_state->getTemporaryValue('wizard');

    // Save the reservation key to the user session.
    if (!empty($cached_values['reservations']) && isset($cached_values['reservations'][$reservation_index])) {
      $this->getRequest()->getSession()->set('reservation_key', $cached_values['reservations'][$reservation_index]['key']);

      // Redirect to the manage reservation page.
      $form_state->setRedirect('aco_manage_flight.reservation');
    }
  }

}
