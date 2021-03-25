<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\TempstoreTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a book flight search form.
 */
class SearchForm extends FormBase {
  use BookingTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use TempstoreTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_search_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'search');
    $this->getBookingFields($form, $form_state, $this->values);
    
    $form['#theme'] = 'find-a-flight-dashboard-form';
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Don't do validation on AJAX calls.
    if (!$form_state->isSubmitted()) {
      return;
    }

    $values = $form_state->getValues();

    // Save counts as integers.
    $values['adultCount'] = intval($values['adultCount']);
    $values['childCount'] = intval($values['childCount']);
    $values['infantCount'] = intval($values['infantCount']);
    $form_state->setValues($values);

    // Validate dates.
    $dates = [];
    $date_fields = ['from'];
    $date_pattern = DateFormat::load('short_date')->getPattern();
    $is_roundtrip = isset($values['isRoundtrip']) && $values['isRoundtrip'];
    if ($is_roundtrip) {
      $date_fields[] = 'to';
    }
    foreach ($date_fields as $date_field) {
      try {
        $date = DrupalDateTime::createFromTimestamp(strtotime($values[$date_field]));
        if (!$date instanceof DrupalDateTime || $date->hasErrors()) {
          $form_state->setErrorByName($date_field, $this->t('The date selected is not a valid date.'));
        }
        $form_state->setValue($date_field, $date->format($date_pattern));
        $dates[] = $date;
      }
      catch (\Exception $e) {
        $form_state->setErrorByName($date_field, $this->t('The date selected is not a valid date.'));
      }
    }

    // Check if the from date is before the to date.
    if (count($dates) > 1 && $dates[0] > $dates[1]) {
      $form_state->setErrorByName('to', $this->t('The arrival date must be after the departure date.'));
    }

    // Check that there are enough adults for the number of infants.
    if ($values['adultCount'] < $values['infantCount']) {
      $form_state->setErrorByName('infantCount', $this->t('Reservations must contain at least one adult for every infant.'));
    }

    if (!$form_state->getErrors()) {
      $travel_options = $this->callEndpoint('getTravelOptions', [
        'cityPair' => $values['departure'] . '-' . $values['arrival'],
        'departure' => $values['from'],
        'return' => ($is_roundtrip && isset($values['to'])) ? $values['to'] : NULL,
        'cabinClass' => INTELIYSYS_ECONOMY_CLASS,
        'currency' => Currency::US_CURRENCY_CODE,
        'adultCount' => $values['adultCount'],
        'childCount' => $values['childCount'],
        'infantCount' => $values['infantCount'],
        'promoCode' => $values['promoCode'],
      ]);

      if (FALSE === $travel_options) {
        $form_state->setError($form, $this->t('An error occurred while retrieving your travel options. @help', [
          '@help' => _aco_core_get_default_help_message(),
        ]));
      }
      // Prevent the next step if there are no available travel options.
      elseif (empty($travel_options)) {
        $form_state->setError($form, $this->t('Sorry, there are no available flights for your search criteria. Please try again.'));
      }
      else {
        // Clear cached values on a new search.
        $form_state->setTemporaryValue('wizard', []);
        $this->clearTempstore();
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Jump start the BookFlightWizard if submitting from outside of it.
    $current_route_name = \Drupal::service('current_route_match')->getRouteName();
    $routes = [
      'aco_book_flight.book_flight',
      'aco_book_flight.book_flight.step',
    ];
    if (!in_array($current_route_name, $routes)) {
      // Reproduce the critical BookFlightWizard functionality here. There is no
      // need to restore the original values here.
      $values = $form_state->cleanValues()->getValues();
      $values['last_step'] = 0;
      $this->saveToTempstore($values);
      $form_state->setRedirect('aco_book_flight.book_flight.step', [
        'step' => 'flight-selection',
      ]);
    }
  }

}
