<?php

namespace Drupal\aco_edit_leg\Traits;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\NestedArray;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Utility\Defaults;

/**
 * An edit leg trait.
 */
trait EditLegTrait {

  /**
   * The tempstore ID.
   *
   * @var string
   */
  protected $tempstoreId = 'aco_edit_leg.form_wizard';

  /**
   * The tempstore machine name.
   *
   * @var string
   */
  protected $tempstoreMachineName = 'EditLegWizard';

  /**
   * The wizard route.
   *
   * @var string
   */
  protected $route = 'aco_edit_leg.form_wizard';

  /**
   * The add leg wizard steps.
   *
   * @var array
   */
  protected $steps = [
    'select',
    'flight-selection',
    'additional-services',
    'purchase',
    'confirm',
  ];

  /**
   * The edited leg index.
   *
   * @var int
   */
  protected $editedLegIndex = 0;

  /**
   * Fill values.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  protected function fillValues(FormStateInterface $form_state) {
    $values = $form_state->getTemporaryValue('wizard');
    $values['isRoundtrip'] = 0;

    // Get defaults.
    $defaults = Defaults::booking();
    if (is_array($values)) {
      $this->values = NestedArray::mergeDeepArray([$defaults, $values], TRUE);
    }
    else {
      $this->values = $defaults;
    }

    // Get selected leg index.
    $this->editedLegIndex = $this->getRequest()->getSession()->get('leg_index');

    // Get passenger count.
    $this->passengerCount = count($this->reservation['passengers']);

    // Get infant count.
    foreach ($this->reservation['passengers'] as &$passenger) {
      if (!empty($passenger['infants'])) {
        $this->values['infantCount']++;
      }
    }

    // Get travel options.
    if (!empty($this->values['departure']) && !empty($this->values['arrival']) && !empty($this->values['from'])) {
      $this->travelOptions = $this->getTravelOptions();

      if (method_exists($this, 'getQuote')) {
        $quote = $this->getQuote();

        $subtotal = 0;
        foreach ($quote['charges'] as $charge) {
          if (empty($charge['timestamp'])) {
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                $subtotal += $amount['totalAmount'];
              }
            }
          }
        }

        $this->subtotal = $subtotal;
        $this->balance = $this->getTotalCharges() - $this->getTotalPayments();
        $this->total = $this->balance + $this->subtotal;
      }
    }
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
      $journey = &$this->reservation['journeys'][$this->editedLegIndex];
      $travel_options = $this->callEndpoint('getTravelOptions', [
        'cityPair' => $this->values['departure'] . '-' . $this->values['arrival'],
        'departure' => $this->values['from'],
        'return' => NULL,
        'cabinClass' => INTELIYSYS_ECONOMY_CLASS,
        'currency' => Currency::US_CURRENCY_CODE,
        'reservation' => $this->reservation['key'],
        'journey' => $journey['key'],
      ] + $this->getPassengerCounts());
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
          'description' => $this->t('Edit Leg Charge'),
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
