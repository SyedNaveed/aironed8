<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements a select passenger form.
 */
class SelectPassengerForm extends FormBase {
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
    return 'aco_manage_flight_select_passenger_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $form['#theme'] = 'form__section_actions';

    $header = [
      'name' => $this->t('Name'),
      'gender' => $this->t('Gender'),
      'infants' => $this->t('Infants'),
      'charges' => $this->t('Total Charges'),
      'payments' => $this->t('Total Payments'),
      'balance' => $this->t('Balance'),
    ];

    $options = [];
    foreach ($this->reservation['passengers'] as &$passenger) {
      $option = [
        'name' => sprintf('%s, %s', $passenger['reservationProfile']['lastName'], $passenger['reservationProfile']['firstName']),
        'gender' => $passenger['reservationProfile']['gender'][0],
        'infants' => count($passenger['infants']),
        'charges' => 0,
        'payments' => 0,
      ];
      foreach ($this->reservation['charges'] as &$charge) {
        if ($passenger['key'] == $charge['passenger']['key']) {
          foreach ($charge['currencyAmounts'] as &$amount) {
            if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
              $option['charges'] += $amount['totalAmount'];
            }
          }
        }
      }
      foreach ($this->reservation['paymentTransactions'] as &$transaction) {
        foreach ($transaction['payments'] as &$payment) {
          if ($passenger['key'] == $payment['passenger']['key']) {
            foreach ($payment['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                $option['payments'] += $amount['totalAmount'];
              }
            }
          }
        }
      }
      $option['balance'] = Currency::toPrice($option['charges'] - $option['payments'], Currency::US_CURRENCY_CODE);
      $option['charges'] = Currency::toPrice($option['charges'], Currency::US_CURRENCY_CODE);
      $option['payments'] = Currency::toPrice($option['payments'], Currency::US_CURRENCY_CODE);
      $options[] = $option;
    }

    $form['content'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#multiple' => FALSE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
      '#access' => !$this->canceled && !$this->expired,
    ];
    $form['actions']['button1'] = [
      '#type' => 'submit',
      '#name' => 'edit_passenger',
      '#value' => $this->t('Edit Passenger'),
    ];
    $form['actions']['button2'] = [
      '#type' => 'submit',
      '#name' => 'add_passenger',
      '#value' => $this->t('Add Passenger(s)'),
    ];
    /*
    $form['actions']['button3'] = [
    '#type' => 'submit',
    '#name' => 'change_passenger',
    '#value' => $this->t('Change Passenger'),
    ];
     */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $passenger_index = (int) $form_state->getValue('content');
    $this->getRequest()->getSession()->set('passenger_index', $passenger_index);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    switch ($form_state->getTriggeringElement()['#name']) {
      case 'edit_passenger':
        $form_state->setRedirect('aco_manage_flight.reservation.passengers.edit');
        break;

      case 'add_passenger':
        $form_state->setRedirect('aco_add_passengers.form_wizard', [
          'step' => 'select',
        ]);
        break;

      /*
      case 'change_passenger':
      $form_state->setRedirect('aco_manage_flight.reservation.passengers.change');
      break;
       */
    }
  }

}
