<?php

namespace Drupal\aco_core\Traits;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\intelisys\Utility\Charges;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * A legs trait.
 */
trait LegsTrait {

  /**
   * Get select leg form.
   *
   * @param array $form
   *   The form to add the fields to.
   */
  protected function getSelectLegForm(array &$form) {
    $header = [
      'leg_number' => $this->t('Leg'),
      'description' => $this->t('Description'),
      'status' => $this->t('Status'),
    ];

    $options = [];
    foreach ($this->reservation['journeys'] as $leg_index => &$journey) {
      end($journey['segments']);
      $last_key = key($journey['segments']);

      // Only used for sorting. Timezone alteration is not needed here.
      $actual_departure_time = strtotime($journey['segments'][0]['departure']['scheduledTime']);
      $actual_arrival_time = strtotime($journey['segments'][0]['arrival']['scheduledTime']);

      $options[] = [
        'leg_index' => $leg_index,
        'canceled' => $journey['reservationStatus']['cancelled'],
        'actual_departure' => $actual_departure_time,
        'actual_arrival' => $actual_arrival_time,
        'leg_number' => '',
        'description' => [
          'data' => [
            'title' => [
              '#markup' => $this->t('From: @from, To: @to', [
                '@from' => $journey['segments'][0]['departure']['airport']['name'],
                '@to' => $journey['segments'][$last_key]['arrival']['airport']['name'],
              ]),
            ],
            'flight_summary' => $this->getFlightSummary($journey),
            'pasenger_summary' => $this->getPassengerSummary($journey),
          ],
        ],
        'status' => $this->getJourneyStatus($journey),
      ];
    }

    // Sort legs.
    usort($options, '_aco_core_sort_flights');

    // Prepare rows for output.
    $keys = [];
    foreach ($options as $key => &$option) {
      $option['leg_number'] = $this->t('@leg_number', [
        '@leg_number' => $key + 1,
      ]);

      $keys[] = 'index-' . $option['leg_index'];

      // Remove sorting columns and leg index.
      unset($option['leg_index']);
      unset($option['canceled']);
      unset($option['actual_departure']);
      unset($option['actual_arrival']);
    }

    // Use original array index as input value.
    $options = array_combine($keys, $options);

    $form['leg_index'] = [
      '#type' => 'tableselect',
      '#attributes' => ['class' => ['leg-selection']],
      '#header' => $header,
      '#options' => $options,
      '#default_value' => $keys[0],
      '#multiple' => FALSE,
      '#required' => TRUE,
    ];
  }

  /**
   * Get flight summary table.
   *
   * @param array $journey
   *   The journey to use.
   *
   * @return array
   *   The render array.
   */
  protected function getFlightSummary(array &$journey) {
    static $time_format, $date_format;

    if (!isset($time_format)) {
      $time_format = DateFormat::load('short_time')->getPattern();
      $date_format = DateFormat::load('medium_date')->getPattern();
    }

    $flight_summary_header = [
      'date' => $this->t('Flight Date'),
      'flight' => $this->t('Flight'),
      'departure' => $this->t('Departure'),
      'arrival' => $this->t('Arrival'),
    ];

    // Get flight summary.
    $flight_summary_rows = [];
    foreach ($journey['segments'] as &$segment) {
      $flight_number = $segment['flight']['airlineCode']['code'] . $segment['flight']['flightNumber'];
      foreach ($segment['legs'] as &$leg) {
        $flight_summary_rows[] = [
          TimeHelper::getLocalTime($leg['departure'], $date_format),
          $flight_number,
          TimeHelper::getLocalTime($leg['departure'], $time_format) . ' ' . $leg['departure']['airport']['code'],
          TimeHelper::getLocalTime($leg['arrival'], $time_format) . ' ' . $leg['arrival']['airport']['code'],
        ];
      }
    }

    return [
      '#theme' => 'table',
      '#attributes' => ['class' => ['table-detail']],
      '#header' => $flight_summary_header,
      '#rows' => $flight_summary_rows,
    ];
  }

  /**
   * Get passenger summary table.
   *
   * @param array $journey
   *   The journey to use.
   *
   * @return array
   *   The render array.
   */
  protected function getPassengerSummary(array &$journey) {
    $passengers_header = [
      'passenger' => $this->t('Passenger'),
      'fare_class' => $this->t('Fare Class'),
      'base_fare' => $this->t('Base Fare'),
      'taxes' => $this->t('Taxes'),
      'total_fare' => $this->t('Total Fare'),
    ];

    // Get passenger summary.
    if (!$journey['reservationStatus']['cancelled']) {
      $pasenger_summary_rows = [];
      foreach ($this->reservation['charges'] as &$charge) {
        if ($charge['journey']['key'] == $journey['key'] && $charge['chargeType']['code'] == Charges::FARE_CODE) {
          $passenger_key = $charge['passenger']['key'];

          // Create a new row for the current passenger.
          if (!isset($pasenger_summary_rows[$passenger_key])) {
            $passenger_name = '';
            foreach ($this->reservation['passengers'] as &$passenger) {
              if ($passenger_key == $passenger['key']) {
                $passenger_name = $passenger['reservationProfile']['lastName'] . ', ' . $passenger['reservationProfile']['firstName'];
                break;
              }
            }
            $fare_class = '';
            foreach ($journey['passengerJourneyDetails'] as &$passengerJourneyDetails) {
              if ($passenger_key == $passengerJourneyDetails['passenger']['key']) {
                $fare_class = $passengerJourneyDetails['fareClass']['code'] . ' - ' . $passengerJourneyDetails['fareClass']['description'];
                break;
              }
            }
            $pasenger_summary_rows[$passenger_key] = [
              'passenger' => $passenger_name,
              'fare_class' => $fare_class,
              'base_fare' => 0,
              'taxes' => 0,
              'total_fare' => 0,
            ];
          }

          foreach ($charge['currencyAmounts'] as &$amount) {
            if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
              $pasenger_summary_rows[$passenger_key]['base_fare'] += $amount['baseAmount'];
              $pasenger_summary_rows[$passenger_key]['taxes'] += $amount['taxAmount'];
              $pasenger_summary_rows[$passenger_key]['total_fare'] += $amount['totalAmount'];
            }
          }
        }
      }

      foreach ($pasenger_summary_rows as &$row) {
        $row['base_fare'] = Currency::toPrice($row['base_fare'], Currency::US_CURRENCY_CODE);
        $row['taxes'] = Currency::toPrice($row['taxes'], Currency::US_CURRENCY_CODE);
        $row['total_fare'] = Currency::toPrice($row['total_fare'], Currency::US_CURRENCY_CODE);
      }

      return [
        '#theme' => 'table',
        '#attributes' => ['class' => ['table-detail']],
        '#header' => $passengers_header,
        '#rows' => $pasenger_summary_rows,
      ];
    }

    return [];
  }

  /**
   * Get fare options table.
   *
   * @param array $journey
   *   The journey to use.
   * @param array $travel_options
   *   The travel options to use.
   * @param string $type
   *   The type of table to return.
   *
   * @return array
   *   The render array.
   */
  protected function getFareOptions(array &$journey, array &$travel_options, $type = 'tableselect') {
    $header = [
      'fare_class' => $this->t('Fare Class'),
      'base_fare' => $this->t('Base Fare Per Passenger'),
      'taxes' => $this->t('Taxes Per Passenger'),
      'total' => $this->t('Total Per Passenger'),
      'grand_total' => $this->t('Total All Passengers'),
      'restrictions' => $this->t('Restrictions'),
    ];

    $options = [];
    foreach ($travel_options as &$travel_option) {
      if ($travel_option['flights'][0]['key'] == $journey['segments'][0]['flight']['key']) {
        foreach ($travel_option['fareOptions'] as &$fare_option) {
          $is_restricted = $fare_option['fareType']['identifier'] == 'Non Refundable';
          $base_fare = $taxes = $total = 0;
          foreach ($fare_option['fareCharges'] as &$charge) {
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                if ($charge['chargeType']['code'] == Charges::FARE_CODE) {
                  $base_fare += $amount['baseAmount'];
                  $total += $amount['baseAmount'];
                  $taxes += $amount['taxAmount'];
                  $total += $amount['taxAmount'];
                }
              }
            }
          }
          $grand_total = $total * $this->passengerCount;
          $options[] = [
            'fare_class' => $fare_option['fareClass']['code'],
            'base_fare' => Currency::toPrice($base_fare, Currency::US_CURRENCY_CODE),
            'taxes' => Currency::toPrice($taxes, Currency::US_CURRENCY_CODE),
            'total' => Currency::toPrice($total, Currency::US_CURRENCY_CODE),
            'grand_total' => Currency::toPrice($grand_total, Currency::US_CURRENCY_CODE),
            'restrictions' => $is_restricted ? $this->t('Yes') : $this->t('No'),
          ];
        }
      }
    }

    end($journey['segments']);
    $last_key = key($journey['segments']);
    $date_format = DateFormat::load('medium_date')->getPattern();

    if ($type == 'tableselect') {
      return [
        '#type' => 'tableselect',
        '#attributes' => ['class' => ['table-detail']],
        '#caption' => $this->t('From: @from, To: @to, Date: @date', [
          '@from' => $journey['segments'][0]['departure']['airport']['name'],
          '@to' => $journey['segments'][$last_key]['arrival']['airport']['name'],
          '@date' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], $date_format),
        ]),
        '#header' => $header,
        '#options' => $options,
        '#default_value' => 0,
        '#multiple' => FALSE,
      ];
    }
    else {
      return [
        '#type' => 'table',
        '#attributes' => ['class' => ['table-detail']],
        '#caption' => $this->t('From: @from, To: @to, Date: @date', [
          '@from' => $journey['segments'][0]['departure']['airport']['name'],
          '@to' => $journey['segments'][$last_key]['arrival']['airport']['name'],
          '@date' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], $date_format),
        ]),
        '#header' => $header,
        '#rows' => $options,
      ];
    }
  }

  /**
   * Get travel options table.
   *
   * @param array $journey
   *   The journey to use.
   * @param array $travel_options
   *   The travel options to use.
   *
   * @return array
   *   The render array.
   */
  protected function getFareFees(array &$journey, array $travel_options) {
    $header = [
      'description' => $this->t('Description'),
      'amount' => $this->t('Amount'),
      'taxes' => $this->t('Taxes Per Passenger'),
      'total' => $this->t('Total Per Passenger'),
      'grand_total' => $this->t('Total All Passengers'),
      'infant_charge' => $this->t('Infant Charge'),
    ];

    $rows = [];
    foreach ($travel_options as &$travel_option) {
      if ($travel_option['flights'][0]['key'] == $journey['segments'][0]['flight']['key']) {
        foreach ($travel_option['fareOptions'] as &$fare_option) {
          $is_restricted = $fare_option['fareType']['identifier'] == 'Non Refundable';
          $base_fare = $taxes = $total = 0;
          foreach ($fare_option['fareCharges'] as &$charge) {
            $applies_to_infants = $charge['passengerApplicability']['infant'];
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                if ($charge['chargeType']['code'] != Charges::FARE_CODE) {
                  $grand_total = $amount['totalAmount'] * $this->passengerCount;
                  $rows[] = [
                    'description' => $charge['description'],
                    'amount' => Currency::toPrice($amount['baseAmount'], Currency::US_CURRENCY_CODE),
                    'taxes' => Currency::toPrice($amount['taxAmount'], Currency::US_CURRENCY_CODE),
                    'total' => Currency::toPrice($amount['totalAmount'], Currency::US_CURRENCY_CODE),
                    'grand_total' => Currency::toPrice($grand_total, Currency::US_CURRENCY_CODE),
                    'infant_charge' => $applies_to_infants ? $this->t('Yes') : $this->t('No'),
                  ];
                }
              }
            }
          }
        }
      }
    }

    return [
      '#type' => 'table',
      '#attributes' => ['class' => ['table-detail']],
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
