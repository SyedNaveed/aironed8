<?php

namespace Drupal\aco_add_services\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_services\Traits\AddServicesTrait;

/**
 * Implements a new leg confirm form.
 */
class ConfirmForm extends AddServicesFormBase {
  use BookingTrait;
  use IntelisysTrait;
  use ReservationTrait;
  use AddServicesTrait;
  use AddServiceTrait;

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
    return 'aco_add_services_confirm_form';
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
    $result = TRUE;
    $this->fillValues($form_state);
    $payment_transactions = $this->total > 0 ? $this->getPaymentTransactions() : NULL;

    // Perform refunds.
    if (!empty($this->reservation['ancillaryPurchases']) && !empty($this->values['ancillaryRefunds'])) {
      foreach ($this->reservation['passengers'] as $passenger_index => &$passenger) {
        foreach ($this->reservation['journeys'] as $journey_index => &$journey) {
          foreach ($this->reservation['ancillaryPurchases'] as &$ancillary_purchase) {
            $is_passenger_match = $passenger['key'] == $ancillary_purchase['passenger']['key'];
            $is_journey_match = $journey['key'] == $ancillary_purchase['journey']['key'];
            if ($is_passenger_match && $is_journey_match) {
              // Find the refund.
              foreach ($this->values['ancillaryRefunds'] as &$ancillary_refund) {
                $is_refund_passenger_match = $passenger['key'] == $ancillary_refund['passenger']['key'];
                $is_refund_journey_match = $journey['key'] == $ancillary_refund['journey']['key'];
                $is_item_match = $ancillary_purchase['ancillaryItem']['key'] == $ancillary_refund['itemKey'];
                if ($is_refund_passenger_match && $is_refund_journey_match && $is_item_match) {
                  $result &= $this->callEndpoint('deleteReservationAncillaryPurchase', [
                    'key' => $this->reservation['key'],
                    'ancillaryPurchaseKey' => $ancillary_purchase['key'],
                  ], FALSE);
                }
              }
            }
          }
        }
      }
    }

    // Perform purchases.
    foreach ($this->values['ancillaryPurchases'] as &$ancillary_purchase) {
      $purchases = $this->callEndpoint('postReservationAncillaryPurchase', [
        'key' => $this->reservation['key'],
        'paymentTransactions' => $payment_transactions,
      ] + $ancillary_purchase);
      $result &= is_array($purchases) && !empty($purchases);
    }

    // Prevent the next step if the purchasing failed.
    if (FALSE === $result || empty($result)) {
      $form_state->setError($form, $this->t('An error occurred while purchasing. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    elseif ($this->total < 0) {
      $this->messenger()->addStatus($this->t('Transaction completed, the credit card was refunded: @price', [
        '@price' => Currency::toPrice($this->total, Currency::US_CURRENCY_CODE),
      ]));
    }
    else {
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
