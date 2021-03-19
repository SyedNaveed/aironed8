<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\LegsTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_passengers\Traits\AddPassengersTrait;

/**
 * Implements an add passengers form.
 */
class SelectForm extends FormBase {
  use IntelisysTrait;
  use ReservationTrait;
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
    return 'aco_add_passengers_select_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'select');

    $form['adultCount'] = [
      '#type' => 'number',
      '#title' => $this->t('Adults'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Adults *'),
      '#default_value' => $this->values['adultCount'] == 0 ? 1 : $this->values['adultCount'],
      '#min' => 1,
      '#required' => TRUE,
    ];
    $form['childCount'] = [
      '#type' => 'number',
      '#title' => $this->t('Child'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Child'),
      '#default_value' => $this->values['childCount'] == 0 ? '' : $this->values['childCount'],
      '#min' => 0,
    ];

    if ($this->values['adultCount'] > 0) {
      $availability = TRUE;
      foreach ($this->travelOptions as &$travel_option) {
        $fare_available = FALSE;
        foreach ($travel_option['fareOptions'] as &$fare_option) {
          if ($this->passengerCount <= $fare_option['availability']) {
            $fare_available = TRUE;
          }
        }
        if (!$fare_available) {
          $availability = FALSE;
          break;
        }
      }

      if ($availability) {
        foreach ($this->reservation['journeys'] as $key => &$journey) {
          if ($this->isJourneyActive($journey)) {
            $form['journey_' . $key] = $this->getFareOptions($journey, $this->travelOptions);
          }
        }
      }
      else {
        $form['description'] = [
          '#type' => 'container',
          '#markup' => $this->t('<p>One or more legs on this reservation does not have sufficient seats available for the requested number of additional passengers. Unable to add passengers.</p>'),
        ];
      }
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Cast counts as integers.
    $values['adultCount'] = intval($values['adultCount']);
    $values['childCount'] = intval($values['childCount']);

    // Cast journey indexes as integers.
    $is_journey_selected = FALSE;
    foreach ($this->reservation['journeys'] as $index => &$journey) {
      $journey_key = 'journey_' . $index;
      if ($this->isJourneyActive($journey) && isset($values[$journey_key])) {
        $values[$journey_key] = intval($values[$journey_key]);
        $is_journey_selected = TRUE;
      }
    }

    // Re-save values.
    $form_state->setValues($values);

    $adult_changed = $values['adultCount'] != $this->values['adultCount'];
    $child_changed = $values['childCount'] != $this->values['childCount'];
    if (!$is_journey_selected || $adult_changed || $child_changed) {
      // Save values.
      $values['last_step'] = 0;
      $form_state->setTemporaryValue('wizard', $values);

      // Rebuild with leg options.
      $form_state->setRebuild();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
