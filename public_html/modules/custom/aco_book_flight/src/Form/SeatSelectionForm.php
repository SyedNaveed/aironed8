<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Template\Attribute;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\Locations;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a select seats form.
 */
class SeatSelectionForm extends FormBase {
  use BookingTrait;
  use IntelisysTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_seat_selection_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'seat-selection')) {
      return $form;
    }

    $all_airports = Locations::getAirportOptions();
    $form['title'] = [
      '#markup' => $this->t('Flights from @from to @to', [
        '@from' => explode(' - ', $all_airports[$this->values['departure']])[0],
        '@to' => explode(' - ', $all_airports[$this->values['arrival']])[0],
      ]),
    ];

    // Get seat options.
    $count = 0;
    $keys = [];
    $prices = [];
    $titles = [];
    $flight_seats = [];
    $seat_selection_options = [];
    $flights = ['departure_flight', 'arrival_flight'];
    foreach ($flights as $journey_index => &$journey) {
      if (!empty($this->values[$journey])) {
        $seat_options = $this->callEndpoint('getSeatSelectionOptions', [
          'bookingKey' => $this->getBookingKey($this->values[$journey]),
        ]);

        if (FALSE === $seat_options) {
          if ('departure_flight' == $journey) {
            $this->messenger()->addError($this->t('There was an error retrieving the seat options for the departure flight.'));
          }
          else {
            $this->messenger()->addError($this->t('There was an error retrieving the seat options for the arrival flight.'));
          }
        }
        elseif (!empty($seat_options)) {
          foreach ($seat_options as $segment_index => &$seat_option) {
            end($seat_option['flightSegment']['flightLegs']);
            $last_flight_leg_key = key($seat_option['flightSegment']['flightLegs']);

            // Get seat options.
            $seats = [];
            foreach ($seat_option['seatOptions'] as $delta => &$option) {
              $classes = ['seat' . ($delta + 1)];
              // @todo Verify logic here.
              if ($option['selectionValidity']['reserved']) {
                $classes[] = 'is-reserved';
              }
              elseif ($option['selectionValidity']['saleBlock']) {
                $classes[] = 'is-sale-block';
              }
              elseif ($option['selectionValidity']['serviceBlock']) {
                $classes[] = 'is-service-block';
              }
              elseif (!$option['selectionValidity']['available']) {
                $classes[] = 'is-unavailable';
              }
              else {
                $classes[] = 'is-standard';
              }
              $price = 0;
              if ($option['seatCharges']) {
                foreach ($option['seatCharges'] as &$charge) {
                  foreach ($charge['currencyAmounts'] as &$amount) {
                    if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
                      $price += $amount['totalAmount'];
                    }
                  }
                }
              }
              $row = $option['seatMapCell']['rowIdentifier'];
              $seat = $option['seatMapCell']['seatIdentifier'];
              $keys[$journey_index][$segment_index][$row][$seat] = $option['selectionKey'];
              $seats[] = [
                '#theme' => 'seat',
                '#seat' => $row . $seat,
                '#attributes' => new Attribute([
                  'class' => $classes,
                  'data-row' => $row,
                  'data-seat' => $seat,
                  'data-journey' => $journey_index + 1,
                  'data-segment' => $segment_index + 1,
                  'data-price' => Currency::toPrice($price),
                ]),
              ];
              $prices[$journey_index][$segment_index][$row][$seat] = $price;
            }

            // Get passengers.
            $passengers = [];
            foreach ($this->values['passengers'] as $passenger_index => &$passenger) {
              // Passenger seat defaults.
              $selected_price = 0;
              $selected_seat = '&nbsp;';
              $selected_row = '';
              $selected_seat = '';
              $attributes = [
                'data-passenger' => $passenger_index + 1,
                'data-journey' => $journey_index + 1,
                'data-segment' => $segment_index + 1,
              ];

              // Get the selected seat and price.
              if (!empty($this->values['seatSelections'])) {
                $seat_selection_key = FALSE;
                foreach ($this->values['seatSelections'] as $seat_selection) {
                  if ($seat_selection['passenger']['index'] == ($passenger_index + 1)
                    && $seat_selection['journey']['index'] == ($journey_index + 1)
                    && $seat_selection['segment']['index'] == ($segment_index + 1)) {
                    $seat_selection_key = $seat_selection['selectionKey'];
                  }
                }
                if (FALSE !== $seat_selection_key) {
                  $seat_option_key = array_search($seat_selection_key, array_column($seat_option['seatOptions'], 'selectionKey'));
                  if (FALSE !== $seat_option_key) {
                    $selected_row = $seat_option['seatOptions'][$seat_option_key]['seatMapCell']['rowIdentifier'];
                    $selected_seat = $seat_option['seatOptions'][$seat_option_key]['seatMapCell']['seatIdentifier'];
                    $selected_price = $prices[$journey_index][$segment_index][$selected_row][$selected_seat];
                    $seat_key = array_search($selected_row . $selected_seat, array_column($seats, '#seat'));
                    $seats[$seat_key]['#attributes']['class'][] = 'is-selected';
                    $seats[$seat_key]['#attributes']['data-passenger'] = $passenger_index + 1;
                  }
                }
              }

              $form['seatSelections'][$count]['row'] = [
                '#type' => 'hidden',
                '#default_value' => $selected_row,
                '#attributes' => $attributes + ['class' => ['row']],
              ];
              $form['seatSelections'][$count]['seat'] = [
                '#type' => 'hidden',
                '#default_value' => $selected_seat,
                '#attributes' => $attributes + ['class' => ['seat']],
              ];
              $form['seatSelections'][$count]['passenger']['index'] = [
                '#type' => 'hidden',
                '#value' => $passenger_index + 1,
              ];
              $form['seatSelections'][$count]['journey']['index'] = [
                '#type' => 'hidden',
                '#value' => $journey_index + 1,
              ];
              $form['seatSelections'][$count]['segment']['index'] = [
                '#type' => 'hidden',
                '#value' => $segment_index + 1,
              ];

              $passenger_row = [
                'name' => [
                  '#type' => 'radio',
                  '#name' => 'passengerSeatSelections[' . $journey_index . '][' . $segment_index . '][]',
                  '#title' => $this->t('@last, @first', [
                    '@last' => $passenger['lastName'],
                    '@first' => $passenger['firstName'],
                  ]),
                  '#value' => $passenger_index == 0 ? 1 : 0,
                  '#return_value' => 1,
                  '#default_value' => $passenger_index == 0 ? 1 : NULL,
                  '#title_display' => 'after',
                  '#attributes' => $attributes,
                ],
                'price' => ['#markup' => $selected_price],
                'seat' => ['#markup' => $selected_row . $selected_seat],
                'attributes' => new Attribute($attributes),
              ];
              $count++;
              $passengers[] = $passenger_row;
            }
            $title = $this->t('@code@number @departure-@arrival', [
              '@code' => $seat_option['flightSegment']['flight']['airlineCode']['code'],
              '@number' => $seat_option['flightSegment']['flight']['flightNumber'],
              '@departure' => $seat_option['flightSegment']['flightLegs'][0]['departure']['airport']['code'],
              '@arrival' => $seat_option['flightSegment']['flightLegs'][$last_flight_leg_key]['arrival']['airport']['code'],
            ]);
            $titles[] = ['#markup' => $title];
            $flight_seats[] = [
              'seats' => $seats,
            ];
            $seat_selection_options[] = [
              'title' => ['#markup' => $title],
              'passengers' => $passengers,
            ];
          }
        }
      }
    }

    if (empty($seat_selection_options)) {
      $form['content'] = [
        '#type' => 'container',
        '#markup' => $this->t('<p>There are no seat options available.</p>'),
      ];
    }
    else {
      $form_state->set('seatSelectionKeys', $keys);
      $form['seatSelections']['#tree'] = TRUE;
      $form['#theme'] = 'form__book_flight_seat_selection';
      $form['tab_buttons'] = [
        '#theme' => 'tab_buttons',
        '#titles' => $titles,
      ];
      $form['seats'] = [
        '#theme' => 'seats',
        '#flights' => $flight_seats,
      ];
      $form['seat_selections'] = [
        '#theme' => 'seat_selections',
        '#flights' => $seat_selection_options,
      ];
    }

    return $form;
  }

  /**
   * This must be called after actions are added by the form wizard.
   */
  public function buildFormActions(array $form, FormStateInterface $form_state) {
    if (isset($form['seatSelections'])) {
      $form['actions']['skip'] = [
        '#type' => 'submit',
        '#value' => $this->t('No Thanks'),
        '#validate' => [
          [$this, 'clearValues'],
        ],
        '#submit' => $form['actions']['submit']['#submit'],
        '#weight' => -15,
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $keys = $form_state->get('seatSelectionKeys');
    $values = $form_state->getValues();
    unset($values['skip']);
    // Prepare seat selections array.
    foreach ($values['seatSelections'] as $key => &$selection) {
      $row = $selection['row'];
      $seat = $selection['seat'];
      unset($selection['row']);
      unset($selection['seat']);
      $selection['passenger']['index'] = intval($selection['passenger']['index']);
      $selection['journey']['index'] = intval($selection['journey']['index']);
      $selection['segment']['index'] = intval($selection['segment']['index']);
      if (!empty($row) && !empty($seat)) {
        $journey_index = $selection['journey']['index'] - 1;
        $segment_index = $selection['segment']['index'] - 1;
        $selection['selectionKey'] = $keys[$journey_index][$segment_index][$row][$seat];
      }
      else {
        unset($values['seatSelections'][$key]);
      }
    }
    $form_state->setValues($values);
  }

  /**
   * Clear form values (skip seat selection).
   */
  public function clearValues(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    unset($values['skip']);
    $values['op'] = $this->t('Next');
    $values['seatSelections'] = [];
    $form_state->setValues($values);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
