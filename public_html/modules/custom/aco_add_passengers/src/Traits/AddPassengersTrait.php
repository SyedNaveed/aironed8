<?php

namespace Drupal\aco_add_passengers\Traits;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\NestedArray;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Utility\Defaults;

/**
 * An add passengers trait.
 */
trait AddPassengersTrait {

  /**
   * The wizard route.
   *
   * @var string
   */
  protected $route = 'aco_add_passengers.form_wizard';

  /**
   * The add passengers wizard steps.
   *
   * @var array
   */
  protected $steps = [
    'select',
    'contact-information',
    'additional-services',
    'purchase',
    'confirm',
  ];

  /**
   * The cached selected travel options.
   *
   * @var array
   */
  protected $selectedTravelOptions = [];

  /**
   * Fill values.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  protected function fillValues(FormStateInterface $form_state) {
    $values = $form_state->getTemporaryValue('wizard');

    // Get defaults.
    $defaults = Defaults::addPassengers();
    if (is_array($values)) {
      $this->values = NestedArray::mergeDeepArray([$defaults, $values], TRUE);
    }
    else {
      $this->values = $defaults;
    }

    // Get passenger count.
    $this->passengerCount = $this->values['adultCount'] + $this->values['childCount'];

    // Get travel options.
    if ($this->values['adultCount'] > 0) {
      $this->travelOptions = $this->getTravelOptions();

      if (method_exists($this, 'getQuote')) {
        $this->selectedTravelOptions = $this->getSelectedTravelOptions();
        $quote = $this->getQuote();

        $total_per_passenger = 0;
        foreach ($quote['charges'] as $charge) {
          if (empty($charge['timestamp'])) {
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                $total_per_passenger += $amount['totalAmount'];
              }
            }
          }
        }

        $this->subtotal = $total_per_passenger * $this->passengerCount;
        $this->balance = $this->getTotalCharges() - $this->getTotalPayments();
        $this->total = $this->balance + $this->subtotal;
      }
    }
  }

  /**
   * Helper function to get selected travel options.
   *
   * @return array
   *   The travel options.
   */
  protected function getSelectedTravelOptions() {
    static $travel_options;

    if (empty($travel_options)) {
      $travel_options = $this->getTravelOptions();

      // Remove unselected travel options.
      foreach ($this->reservation['journeys'] as $journey_key => &$journey) {
        if ($this->isJourneyActive($journey)) {
          $journey_string_key = 'journey_' . $journey_key;
          foreach ($travel_options as $travel_key => &$travel_option) {
            // Check that the travel option is the same as the journey.
            if ($travel_option['flights'][0]['key'] == $journey['segments'][0]['flight']['key']) {
              foreach ($travel_option['fareOptions'] as $fare_option_index => &$fare_option) {
                if ($fare_option_index != $this->values[$journey_string_key]) {
                  unset($travel_options[$travel_key]['fareOptions'][$fare_option_index]);
                }
              }
              break;
            }
          }
        }
      }
    }

    return $travel_options;
  }

  /**
   * Helper function to get travel options.
   *
   * @return array
   *   The travel options.
   */
  protected function getTravelOptions() {
    static $travel_options;

    if (empty($travel_options)) {
      $travel_options = $this->callEndpoint('getReservationTravelOptions', [
        'reservation' => $this->reservation['key'],
        'adultCount' => $this->values['adultCount'],
        'childCount' => $this->values['childCount'],
        'infantCount' => 0,
        'cabinClass' => INTELIYSYS_ECONOMY_CLASS,
      ]);
    }

    return $travel_options;
  }

  /**
   * Charges tables.
   *
   * @param array $form
   *   The form to add the fields to.
   */
  protected function getChargeTables(array &$form) {
    // Build 'New Passenger Charges' tables.
    $rows = [];
    foreach ($this->reservation['journeys'] as $journey_key => &$journey) {
      if ($this->isJourneyActive($journey)) {
        $rows[] = [
          'fares' => $this->getFareOptions($journey, $this->selectedTravelOptions, 'table'),
          'fare_fees' => $this->getFareFees($journey, $this->selectedTravelOptions),
        ];
      }
    }

    $form['new_passenger_charges'] = [
      '#theme' => 'table',
      '#caption' => $this->t('New Passenger Charges'),
      '#rows' => [
        [
          'new_passegner_charges' => [
            'data' => $rows,
          ],
        ],
      ],
    ];

    // Build 'Charges Summary' table.
    $form['charges_summary'] = [
      '#theme' => 'table',
      '#caption' => $this->t('Charges Summary'),
      '#header' => [
        'description' => $this->t('Description'),
        'amount' => $this->t('Amount'),
      ],
      '#rows' => [
        [
          'description' => $this->t('Additional Passenger(s) Charge'),
          'amount' => Currency::toPrice($this->subtotal, Currency::US_CURRENCY_CODE),
        ],
        [
          'description' => $this->t('Reservation Balance'),
          'amount' => Currency::toPrice($this->balance, Currency::US_CURRENCY_CODE),
        ],
        [
          'description' => $this->t('Total to be applied to Credit Card'),
          'amount' => Currency::toPrice($this->total, Currency::US_CURRENCY_CODE),
        ],
      ],
    ];
  }

}
