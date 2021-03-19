<?php

namespace Drupal\aco_add_services\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_services\Traits\AddServicesTrait;

/**
 * Implements a select new leg select form.
 */
class SelectForm extends FormBase {
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
    return 'aco_add_services_select_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'select');

    $form['title'] = ['#markup' => $this->t('Additional Services and Items')];

    $form['description'] = [
      '#markup' => $this->t('<p>All prices are in United States Dollar.</p>'),
    ];

    $header = [
      'item' => $this->t('Item'),
      'details' => $this->t('Details'),
      'total' => $this->t('Total'),
    ];

    $add_ons_exist = FALSE;
    foreach ($this->reservation['passengers'] as $passenger_index => &$passenger) {
      $is_header_printed = FALSE;
      foreach ($this->reservation['journeys'] as $journey_index => &$journey) {
        $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
          'bookingKey' => $journey['passengerJourneyDetails'][0]['bookingKey'],
        ]);

        $options = [];
        $default_value = [];
        if (!empty($ancillary_options)) {
          $add_ons_exist = TRUE;
          if (!$is_header_printed) {
            $is_header_printed = TRUE;
            $form['additional_services_header_' . $passenger_index] = [
              '#markup' => $this->t('<h4>@last, @first</h4>', [
                '@first' => $passenger['reservationProfile']['firstName'],
                '@last' => $passenger['reservationProfile']['lastName'],
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
              $default_value['index_' . $ancillary_option_index] = 0;

              // Should this option be checked? (Was it previously purchased?)
              foreach ($this->reservation['ancillaryPurchases'] as &$ancillary_purchase) {
                $is_passenger_match = $passenger['key'] == $ancillary_purchase['passenger']['key'];
                $is_journey_match = $journey['key'] == $ancillary_purchase['journey']['key'];
                $is_item_match = $ancillary_option['ancillaryItem']['key'] == $ancillary_purchase['ancillaryItem']['key'];
                if ($is_passenger_match && $is_journey_match && $is_item_match) {
                  $default_value['index_' . $ancillary_option_index] = 'index_' . $ancillary_option_index;
                  break;
                }
              }
            }
          }

          end($journey['segments']);
          $last_key = key($journey['segments']);
          $table = 'additional_services_' . $passenger_index . '_' . $journey_index;
          $form[$table] = [
            '#type' => 'tableselect',
            '#caption' => $this->t('@airline@flight From @from To @to', [
              '@airline' => $journey['segments'][0]['flight']['airlineCode']['code'],
              '@flight' => $journey['segments'][0]['flight']['flightNumber'],
              '@from' => $journey['segments'][0]['departure']['airport']['name'],
              '@to' => $journey['segments'][$last_key]['arrival']['airport']['name'],
            ]),
            '#header' => $header,
            '#options' => $options,
            '#multiple' => TRUE,
            '#empty' => $this->t('There are no additional services available.'),
            '#default_value' => $default_value,
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
    // Don't do validation on AJAX calls.
    if (!$form_state->isSubmitted()) {
      return;
    }

    $values = $form_state->getValues();
    $values['ancillaryPurchases'] = [];
    $values['ancillaryRefunds'] = [];
    foreach ($this->reservation['passengers'] as $passenger_index => &$passenger) {
      foreach ($this->reservation['journeys'] as $journey_index => &$journey) {
        $ancillary_options = $this->callEndpoint('getAncillaryOptions', [
          'bookingKey' => $journey['passengerJourneyDetails'][0]['bookingKey'],
        ]);

        if (!empty($ancillary_options)) {
          foreach ($ancillary_options as $ancillary_option_index => &$ancillary_option) {
            // Was this option previously checked?
            $was_checked = FALSE;
            foreach ($this->reservation['ancillaryPurchases'] as &$ancillary_purchase) {
              $is_passenger_match = $passenger['key'] == $ancillary_purchase['passenger']['key'];
              $is_journey_match = $journey['key'] == $ancillary_purchase['journey']['key'];
              $is_item_match = $ancillary_option['ancillaryItem']['key'] == $ancillary_purchase['ancillaryItem']['key'];
              if ($is_passenger_match && $is_journey_match && $is_item_match) {
                $was_checked = TRUE;
              }
            }

            $table = 'additional_services_' . $passenger_index . '_' . $journey_index;
            $is_checked = !empty($values[$table]['index_' . $ancillary_option_index]);
            if ($is_checked && !$was_checked) {
              $values['ancillaryPurchases'][] = [
                'purchaseKey' => $ancillary_option['purchaseKey'],
                'passenger' => [
                  'href' => $passenger['href'],
                  'key' => $passenger['key'],
                ],
                'journey' => [
                  'href' => $journey['href'],
                  'key' => $journey['key'],
                ],
              ];
            }
            elseif (!$is_checked && $was_checked) {
              $values['ancillaryRefunds'][] = [
                'itemKey' => $ancillary_option['ancillaryItem']['key'],
                'passenger' => [
                  'href' => $passenger['href'],
                  'key' => $passenger['key'],
                ],
                'journey' => [
                  'href' => $journey['href'],
                  'key' => $journey['key'],
                ],
              ];
            }
          }
        }
      }
    }
    if (empty($values['ancillaryPurchases']) && empty($values['ancillaryRefunds'])) {
      $form_state->setError($form, $this->t('Please make a selection before continuing.'));
    }
    $form_state->setValues($values);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
