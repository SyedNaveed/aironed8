<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements a cancel reservation confirmation form.
 */
class CancelReservationForm extends FormBase {
  use IntelisysTrait;
  use ReservationTrait;

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
    return 'aco_manage_flight_cancel_reservation_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $form['actions'] = ['#type' => 'actions'];

    // Build the form.
    if ($this->hasActiveLegs()) {
      $form['description'] = [
        '#type' => 'container',
        '#markup' => $this->t('This will cancel all legs, or all remaining legs of this reservation. Please confirm your cancellation. Please note: cancellation charges may apply.'),
      ];

      $form['contact_us'] = [
        '#type' => 'container',
        '#markup' => $this->t('If your reservation is for multiple passengers and you would like to cancel for only one, please call us to complete this request. If you have questions about cancellation charges or would like to modify your reservation instead of canceling, please call Customer Service at <a href="tel:+18664359847">866.435.9847</a>.'),
      ];

      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit Reservation Cancellation'),
      ];
    }
    else {
      $form['description'] = [
        '#type' => 'container',
        '#markup' => $this->t('All legs in this reservation have been previously canceled.'),
      ];
    }

    $form['actions']['cancel'] = [
      '#type' => 'link',
      '#title' => $this->t('Cancel'),
      '#url' => Url::fromRoute('aco_manage_flight.reservation'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Cancel the legs.
    foreach ($this->reservation['journeys'] as $key => &$journey) {
      if ($this->isJourneyActive($journey)) {
        $result = $this->callEndpoint('putReservationJourney', [
          'reservationKey' => $this->reservation['key'],
          'journeyKey' => $journey['key'],
          'index' => $key + 1,
          'reservationStatus' => [
            'cancelled' => TRUE,
            'open' => FALSE,
            'finalized' => FALSE,
            'external' => FALSE,
          ],
        ]);
        if (FALSE === $result) {
          $form_state->setError($form, $this->t('An error occurred while attempting to cancel your reservation. @help', [
            '@help' => _aco_core_get_default_help_message(),
          ]));
          break;
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your reservation has been canceled.'));
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

  /**
   * Helper function to check the reservation is not already canceled.
   */
  private function hasActiveLegs() {
    $has_active_legs = FALSE;
    foreach ($this->reservation['journeys'] as $key => &$journey) {
      if ($this->isJourneyActive($journey)) {
        $has_active_legs = TRUE;
      }
    }
    return $has_active_legs;
  }

}
