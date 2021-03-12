<?php

namespace Drupal\aco_add_services\Traits;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\NestedArray;
use Drupal\intelisys\Utility\Currency;

/**
 * An add leg trait.
 */
trait AddServicesTrait {

  /**
   * The wizard route.
   *
   * @var string
   */
  protected $route = 'aco_add_services.form_wizard';

  /**
   * The add leg wizard steps.
   *
   * @var array
   */
  protected $steps = [
    'select',
    'purchase',
    'confirm',
  ];

  /**
   * Fill values.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  protected function fillValues(FormStateInterface $form_state) {
    $values = $form_state->getTemporaryValue('wizard');

    $defaults = [
      'ancillaryPurchases' => [],
      'ancillaryRefunds' => [],
    ];
    if (is_array($values)) {
      $this->values = NestedArray::mergeDeepArray([$defaults, $values], TRUE);
    }
    else {
      $this->values = $defaults;
    }

    // Get passenger count.
    $this->passengerCount = count($this->reservation['passengers']);

    // Update totals.
    if (method_exists($this, 'getQuote')) {
      $quotes = $this->getQuote();

      $subtotal = 0;
      foreach ($quotes as &$quote) {
        foreach ($quote['charges'] as $charge) {
          if (empty($charge['timestamp'])) {
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                $subtotal += $amount['totalAmount'];
              }
            }
          }
        }
      }

      $this->subtotal = $subtotal;
      $this->balance = $this->getTotalCharges() - $this->getTotalPayments();
      $this->total = $this->balance + $this->subtotal;
    }
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
          'description' => $this->t('Additional Services & Items Charge'),
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
