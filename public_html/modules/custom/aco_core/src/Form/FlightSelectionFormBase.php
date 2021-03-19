<?php

namespace Drupal\aco_core\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InsertCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\intelisys\Utility\Charges;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\FareTypes;
use Drupal\intelisys\Utility\Locations;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * Provides a base class for flight selection forms.
 */
abstract class FlightSelectionFormBase extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'flight-selection')) {
      return $form;
    }

    $all_airports = Locations::getAirportOptions();
    $title = $this->t('Flights from @from to @to', [
      '@from' => explode(' - ', $all_airports[$this->values['departure']])[0],
      '@to' => explode(' - ', $all_airports[$this->values['arrival']])[0],
    ]);
    $form['title'] = ['#markup' => $title];

    $form['description'] = [
      '#theme' => 'baggage_description',
    ];

    $flights = $this->getFlightFares();

    $form['from'] = $this->getDateChanger($form_state->getValue('from'), 'from');
    $form['departure'] = [
      '#theme' => 'flight_times_table',
      '#attributes' => ['id' => 'flight-fares-table--from'],
      '#flights' => $flights['from'],
    ];

    if ($this->values['isRoundtrip']) {
      $form['to'] = $this->getDateChanger($form_state->getValue('to'), 'to');
      $form['arrival'] = [
        '#theme' => 'flight_times_table',
        '#attributes' => ['id' => 'flight-fares-table--to'],
        '#flights' => $flights['to'],
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

    $this->fillValues($form_state);

    // @todo Remove '#theme' render arrays and use only '#type' so Drupal can
    // read these values properly.
    // Values are not properly set so doing it here manually.
    $params = \Drupal::request()->request->all();

    // Check departure selection.
    if (isset($params['departure_flight'])) {
      $form_state->setValue('departure_flight', $params['departure_flight']);
    }
    else {
      $form_state->setErrorByName('departure_flight', $this->t('Please select a departure fare.'));
    }

    // Check arrival selection.
    if ($this->values['isRoundtrip']) {
      if (isset($params['arrival_flight'])) {
        $form_state->setValue('arrival_flight', $params['arrival_flight']);
      }
      else {
        $form_state->setErrorByName('arrival_flight', $this->t('Please select a return fare.'));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Obliterate any seat selections or ancillary purchases that may exist.
    $form_state->setValue('seatSelections', []);
    $form_state->setValue('ancillaryPurchasesTotal', 0);
    $form_state->setValue('ancillaryPurchases', []);
  }

  /**
   * AJAX callback handler to change a flight date.
   */
  public function dateChange(array $form, FormStateInterface $form_state) {
    $el = $form_state->getTriggeringElement();
    $name = $el['#name'];
    $value = $el['#value'];
    $selection = $name == 'from' ? 'departure_flight' : 'arrival_flight';

    // Save value temporarily.
    $this->values[$name] = $value;
    $this->values[$selection] = '';

    // Save value permanently.
    $values = [
      $name => $value,
      // Clear the previous selection.
      $selection => '',
    ];
    $this->saveToTempstore($values);

    // Build the response.
    $response = new AjaxResponse();
    $renderer = \Drupal::service('renderer');

    // Replace date switcher field.
    $field = $renderer->renderRoot($form[$name]);
    $response->addCommand(new InsertCommand(NULL, $field));
    $response->setAttachments($form[$name]['#attached']);

    // Replace flight times table.
    $id = 'flight-fares-table--' . $name;
    $flights = $this->getFlightFares(TRUE);
    $table = [
      '#theme' => 'flight_times_table',
      '#attributes' => ['id' => $id],
      '#flights' => $flights[$name],
    ];
    $table = $renderer->renderRoot($table);
    $response->addCommand(new ReplaceCommand('#' . $id, $table));

    return $response;
  }

  /**
   * Helper function to get flight date changer options.
   *
   * @param string $value
   *   The date to use.
   * @param string $type
   *   Get either the 'from' or the 'to' date changer.
   * @param bool $disabled_only
   *   Get disabled values only.
   *
   * @return array
   *   The options array.
   */
  protected function getDateChangerOptions($value, $type, $disabled_only = FALSE) {
    $format = 'm/d/Y';
    $today = (new \DateTime('midnight'));
    $flight_date = DrupalDateTime::createFromTimestamp(strtotime($value));

    $start = (new \DateTime($flight_date->format('Y-m-d')))->modify('-3 days');
    $interval = \DateInterval::createFromDateString('1 day');
    $period = new \DatePeriod($start, $interval, 6);

    $options = [];

    // Create the first option for the previous week selection.
    $last_week = clone $start;
    $last_week->modify('-4 days');
    if ($disabled_only) {
      if ($today > $start->modify('-1 day')) {
        $options[$last_week->format($format)] = ['#disabled' => TRUE];
      }
    }
    else {
      $options[$last_week->format($format)] = '<span></span><i class="visually-hidden">' . $last_week->format($format) . '</i>';
    }

    foreach ($period as $date) {
      $last = $date;
      if ($disabled_only) {
        if ($today > $date) {
          $options[$date->format($format)] = ['#disabled' => TRUE];
        }
      }
      else {
        $formatted = $date->format($format);
        $options[$formatted] = $formatted;
      }
    }

    // Create the last option for the next week selection.
    $next_week = $last->modify('+4 days');
    // Never disable the next week selection.
    if (!$disabled_only) {
      $options[$next_week->format($format)] = '<span></span><i class="visually-hidden">' . $next_week->format($format) . '</i>';
    }

    return $options;
  }

  /**
   * Helper function to get flight date changer.
   *
   * @param string|null $value
   *   The form state value.
   * @param string $type
   *   Get either the 'from' or the 'to' date changer.
   *
   * @return array
   *   The field array.
   */
  protected function getDateChanger($value, $type) {
    $default_value = empty($value) ? $this->values[$type] : $value;
    return [
      '#type' => 'radios',
      '#title' => $type == 'from' ? $this->t('Departure date:') : $this->t('Return date:'),
      '#title_display' => 'before',
      '#default_value' => $default_value,
      '#required' => TRUE,
      '#validated' => TRUE,
      '#options' => $this->getDateChangerOptions($default_value, $type),
      '#prefix' => '<div class="book_page_date_select sh" id="flight-date-switcher--' . $type . '"><div class="date_select_date">',
      '#suffix' => '</div></div>',
      '#ajax' => [
        'event' => 'change',
        'callback' => [$this, 'dateChange'],
        'wrapper' => 'flight-date-switcher--' . $type,
        'progress' => [
          'type' => 'fullscreen',
        ],
      ],
    ] + $this->getDateChangerOptions($default_value, $type, TRUE);
  }

  /**
   * Helper function to get flight fares.
   *
   * @param bool $refresh
   *   Option to refresh the travel options.
   *
   * @return array
   *   The flight fares.
   */
  protected function getFlightFares($refresh = FALSE) {
    $travel_options = $this->getTravelOptions($refresh);
    $departure_city_pair = $this->values['departure'] . '-' . $this->values['arrival'];
    $flights = [
      'from' => [],
      'to' => [],
    ];
    $infant_cost = 0;
    $infant_total = 0;
    if ($this->values['infantCount']) {
      $infant_total = Charges::getFuelCharge() * $this->values['infantCount'];
      $infant_cost = $infant_total / $this->passengerCount;
    }
    $time_format = DateFormat::load('time')->getPattern();
    foreach ($travel_options as $travel_option_index => &$option) {
      $departures = $arrivals = [];
      foreach ($option['flights'] as $flight_index => &$flight) {
        $departures[] = [
          'time' => TimeHelper::getLocalTime($flight['departure'], $time_format),
          'code' => $flight['departure']['airport']['code'],
          'flight' => $flight['airlineCode']['code'] . $flight['flightNumber'],
        ];
        $arrivals[] = [
          'time' => TimeHelper::getLocalTime($flight['arrival'], $time_format),
          'code' => $flight['arrival']['airport']['code'],
        ];
      }

      // Get the airfares.
      $fares = [];
      $details = [];
      $is_departure_flight = $departure_city_pair == $option['cityPair']['identifier'];
      $field_name = $is_departure_flight ? 'departure_flight' : 'arrival_flight';
      foreach ($option['fareOptions'] as $fare_option_index => &$fare_option) {
        $fare_type = trim($fare_option['fareType']['identifier']);
        if (in_array($fare_type, FareTypes::getValidTypes())) {
          $fare_total = 0;
          $fees_total = 0;
          $taxes_total = 0;
          $cost = 0;
          foreach ($fare_option['fareCharges'] as &$charge) {
            foreach ($charge['currencyAmounts'] as &$amount) {
              if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                if ($charge['chargeType']['code'] == Charges::FARE_CODE) {
                  $fare_total += $amount['totalAmount'];
                }
                else {
                  $fees_total += $amount['totalAmount'];
                }
                $taxes_total += $amount['taxAmount'];
                $cost += $amount['totalAmount'];
              }
            }
          }
          if ($cost) {
            $value = $travel_option_index . '/' . $fare_option_index;
            $is_checked = (isset($this->values[$field_name]) && $this->values[$field_name] == $value);
            $fares[$fare_type] = [
              '#type' => 'radio',
              '#id' => 'option-' . $option['cityPair']['identifier'] . '-' . $travel_option_index . '-' . $fare_option_index,
              '#name' => $field_name,
              '#title' => Currency::toPrice($cost, Currency::US_CURRENCY_CODE),
              '#value' => $is_checked ? $value : FALSE,
              '#return_value' => $value,
              '#required' => TRUE,
              '#default_value' => $is_checked ? $value : NULL,
              '#attributes' => [
                'data-cost' => ($cost + $infant_cost) * 100,
                'data-fees' => $fees_total * $this->passengerCount * 100,
                'data-taxes' => $taxes_total * $this->passengerCount * 100,
                'data-total-price' => (($cost * $this->passengerCount) + $infant_total) * 100,
              ],
            ];
            $details[$fare_type] = [
              '#type' => 'link',
              '#title' => $this->t('Detail'),
              '#url' => Url::fromRoute('aco_book_flight.charge_summary', [
                'option_index' => $travel_option_index,
                'fare_index' => $fare_option_index,
              ], [
                'query' => $this->getDetailLinkQuery(),
              ]),
              '#attributes' => [
                'class' => ['use-ajax'],
                'data-dialog-type' => 'modal',
                'data-dialog-options' => Json::encode([
                  'width' => 700,
                ]),
              ],
            ];
          }
        }
      }

      $key = $is_departure_flight ? 'from' : 'to';
      $flights[$key][] = [
        '#theme' => 'flight_times_row',
        '#departures' => $departures,
        '#arrivals' => $arrivals,
        '#stops' => $option['numberOfStops'] - 1,
        '#business_price' => isset($fares[FareTypes::BUSINESS]) ? $fares[FareTypes::BUSINESS] : '',
        '#business_detail' => isset($details[FareTypes::BUSINESS]) ? $details[FareTypes::BUSINESS] : '',
        '#everyday_price' => isset($fares[FareTypes::EVERYDAY]) ? $fares[FareTypes::EVERYDAY] : '',
        '#everyday_detail' => isset($details[FareTypes::EVERYDAY]) ? $details[FareTypes::EVERYDAY] : '',
        '#go_your_way_price' => isset($fares[FareTypes::GO_YOUR_WAY]) ? $fares[FareTypes::GO_YOUR_WAY] : '',
        '#go_your_way_detail' => isset($details[FareTypes::GO_YOUR_WAY]) ? $details[FareTypes::GO_YOUR_WAY] : '',
      ];
    }

    return $flights;
  }

  /**
   * The detail link query to use.
   *
   * @return array
   *   The query.
   */
  abstract protected function getDetailLinkQuery();

}
