<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements an additional services and items form.
 */
class AdditionalServicesForm extends BookingFormBase {
  use IntelisysTrait;
  use BookingTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_additional_services_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'additional-services')) {
      return $form;
    }

    // $form['#theme'] = 'form__book_flight_additional_services';

    $form['title'] = ['#markup' => $this->t('Additional Services and Items')];

    $form['note'] = [
      '#markup' => $this->t('<p>All prices are in United States Dollar.</p>'),
    ];

    $header = [
      'item' => $this->t('Item'),
      'details' => $this->t('Details'),
      'total' => $this->t('Total'),
    ];

    $amounts = $this->getAmounts();
    $form['#attributes']['data-count'] = $this->passengerCount;
    $form['#attributes']['data-cost'] = $amounts['cost'] * 100;
    $form['#attributes']['data-total'] = $amounts['total'] * 100;

    $add_ons_exist = FALSE;
    foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
      $header_printed = FALSE;
      foreach (['departure_flight', 'arrival_flight'] as &$journey) {
        if (!empty($this->values[$journey])) {
          $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
            'bookingKey' => $this->getBookingKey($this->values[$journey]),
          ]);

          $options = [];
          if (!empty($ancillary_options)) {
            $add_ons_exist = TRUE;
            if (!$header_printed) {
              $header_printed = TRUE;
              $form['additional_services_header_' . $passenger_index] = [
                '#markup' => $this->t('<h4>@last, @first</h4>', [
                  '@first' => $passenger['firstName'],
                  '@last' => $passenger['lastName'],
                ]),
              ];
            }

            foreach ($ancillary_options as $ancillary_option_index => &$ancillary_option) {
              if ($ancillary_option['purchaseApplicability']['available']) {
                $price = 0;
                foreach ($ancillary_option['ancillaryCharges'] as &$charge) {
                  foreach ($charge['currencyAmounts'] as &$amount) {
                    if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                      $price += $amount['totalAmount'];
                    }
                  }
                }

                $options['index_' . $ancillary_option_index] = [
                  '#attributes' => [
                    'data-price' => $price * 100,
                  ],
                  'item' => $ancillary_option['ancillaryItem']['name'],
                  'details' => $ancillary_option['ancillaryItem']['description'],
                  'total' => Currency::toPrice($price, Currency::US_CURRENCY_CODE),
                ];
              }
            }

            $table = 'additional_services_' . $passenger_index . '_' . $journey;
            $form[$table] = [
              '#type' => 'tableselect',
              '#caption' => $this->getTableCaption($journey),
              '#header' => $header,
              '#options' => $options,
              '#multiple' => TRUE,
              '#empty' => $this->t('There are no additional services available.'),
              '#default_value' => isset($this->values[$table]) ? $this->values[$table] : [],
            ];
          }
        }
      }
    }

    if (!$add_ons_exist) {
      $form['none'] = [
        '#markup' => $this->t('<p>There are no additional services available.</p>'),
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $values['ancillaryPurchases'] = [];
    $values['ancillaryPurchasesTotal'] = 0;
    $flights = ['departure_flight', 'arrival_flight'];
    foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
      foreach ($flights as $journey_index => &$journey) {
        if (!empty($this->values[$journey])) {
          $booking_key = $this->getBookingKey($this->values[$journey]);
          $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
            'bookingKey' => $booking_key,
          ]);

          if (!empty($ancillary_options)) {
            foreach ($ancillary_options as $ancillary_option_index => &$ancillary_option) {
              $table = 'additional_services_' . $passenger_index . '_' . $journey;
              if (!empty($values[$table]['index_' . $ancillary_option_index])) {
                $price = 0;
                foreach ($ancillary_option['ancillaryCharges'] as &$charge) {
                  foreach ($charge['currencyAmounts'] as &$amount) {
                    if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                      $price += $amount['totalAmount'];
                    }
                  }
                }
                $values['ancillaryPurchasesTotal'] += $price;
                $values['ancillaryPurchases'][] = [
                  'purchaseKey' => $ancillary_option['purchaseKey'],
                  'passenger' => $this->getPassenger($passenger_index, $passenger),
                  'journey' => $this->getJourney($journey_index, $booking_key),
                ];
              }
            }
          }
        }
      }
    }
    $form_state->setValues($values);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
