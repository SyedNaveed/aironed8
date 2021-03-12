<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_passengers\Traits\AddPassengersTrait;

/**
 * Implements a new passengers additional services and items form.
 */
class AdditionalServicesForm extends AddPassengersFormBase {
  use IntelisysTrait;
  use ReservationTrait;
  use BookingTrait;
  use AddPassengersTrait;
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
    return 'aco_add_passengers_additional_services_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'additional-services')) {
      return $form;
    }

    $form['title'] = ['#markup' => $this->t('Additional Services and Items')];

    $form['note'] = [
      '#markup' => $this->t('<p>All prices are in United States Dollar.</p>'),
    ];

    $header = [
      'item' => $this->t('Item'),
      'details' => $this->t('Details'),
      'total' => $this->t('Total'),
    ];

    $add_ons_exist = FALSE;
    foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
      $header_printed = FALSE;
      foreach ($this->selectedTravelOptions as $travel_index => &$travel_option) {
        $journey_string_key = 'journey_' . $travel_index;
        $fare_option_index = $this->values[$journey_string_key];
        $booking_key = $travel_option['fareOptions'][$fare_option_index]['bookingKey'];
        $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
          'bookingKey' => $booking_key,
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
                'item' => $ancillary_option['ancillaryItem']['name'],
                'details' => $ancillary_option['ancillaryItem']['description'],
                'total' => Currency::toPrice($price, Currency::US_CURRENCY_CODE),
              ];
            }
          }

          end($travel_option['flights']);
          $last_key = key($travel_option['flights']);
          $table = 'additional_services_' . $passenger_index . '_' . $travel_index;
          $form[$table] = [
            '#type' => 'tableselect',
            '#caption' => $this->t('@airline@flight From @from To @to', [
              '@airline' => $travel_option['flights'][0]['airlineCode']['code'],
              '@flight' => $travel_option['flights'][0]['flightNumber'],
              '@from' => $travel_option['flights'][0]['departure']['airport']['name'],
              '@to' => $travel_option['flights'][$last_key]['arrival']['airport']['name'],
            ]),
            '#header' => $header,
            '#options' => $options,
            '#multiple' => TRUE,
            '#empty' => $this->t('There are no additional services available.'),
            '#default_value' => isset($this->values[$table]) ? $this->values[$table] : [],
          ];
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
    foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
      foreach ($this->selectedTravelOptions as $travel_index => &$travel_option) {
        $journey_string_key = 'journey_' . $travel_index;
        $fare_option_index = $this->values[$journey_string_key];
        $booking_key = $travel_option['fareOptions'][$fare_option_index]['bookingKey'];
        $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
          'bookingKey' => $booking_key,
        ]);

        if (!empty($ancillary_options)) {
          foreach ($ancillary_options as $ancillary_option_index => &$ancillary_option) {
            $table = 'additional_services_' . $passenger_index . '_' . $travel_index;
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
                'journey' => $this->getJourney($travel_index, $booking_key),
              ];
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
