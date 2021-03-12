<?php

namespace Drupal\aco_book_flight\Traits;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Utility\NestedArray;
use Drupal\intelisys\Utility\Charges;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\Locations;
use Drupal\aco_core\Utility\Defaults;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * A book flight trait.
 */
trait BookFlightTrait {

  /**
   * The tempstore ID.
   *
   * @var string
   */
  protected $tempstoreId = 'aco_book_flight.wizard.book_flight';

  /**
   * The tempstore machine name.
   *
   * @var string
   */
  protected $tempstoreMachineName = 'BookFlightWizard';

  /**
   * The booking wizard steps.
   *
   * @var array
   */
  protected $steps = [
    'search',
    'flight-selection',
    'contact-information',
    'seat-selection',
    'additional-services',
    'purchase',
    'confirm',
  ];

  /**
   * The cached values.
   *
   * @var array
   */
  protected $values = [];

  /**
   * The passenger count.
   *
   * @var int
   */
  protected $passengerCount = 0;

  /**
   * Setup flight booking.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $step
   *   The current step.
   *
   * @return bool
   *   Success or failure in the setup process.
   */
  protected function setup(array &$form, FormStateInterface $form_state, $step) {
    $values = $form_state->getTemporaryValue('wizard');
    $form_state->set('step', $step);

    // Don't cache forms.
    $form['#cache'] = ['max-age' => 0];

    // Exit the booking wizard if there are no cached values.
    if (empty($values)) {
      if ($step != $this->steps[0]) {
        $response = new RedirectResponse(Url::fromRoute('<front>')->toString());
        $response->send();
        exit();
      }
    }
    // If the second to last step is not completed, then check if the user is
    // attempting to skip ahead. If so, redirect to the correct next step.
    elseif ($values['last_step'] != (count($this->steps) - 1)) {
      $next_step_index = $values['last_step'] + 1;
      if ($next_step_index < array_search($step, $this->steps)) {
        $response = new RedirectResponse(Url::fromRoute('aco_book_flight.book_flight.step', [
          'step' => $this->steps[$next_step_index],
        ])->toString());
        $response->send();
        exit();
      }
    }

    $this->fillValues($form_state);

    // Use the book flight template and create a ticket on all steps except the
    // first one.
    if ($step != $this->steps[0]) {
      $form['#theme'] = 'form__book_flight';
      $form['ticket'] = $this->getTicket();
    }

    return TRUE;
  }

  /**
   * Fill values.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  protected function fillValues(FormStateInterface $form_state) {
    $values = $form_state->getTemporaryValue('wizard');

    // Get defaults.
    $defaults = Defaults::booking();
    if (is_array($values)) {
      $this->values = NestedArray::mergeDeepArray([$defaults, $values], TRUE);
    }
    else {
      $this->values = $defaults;
    }

    // Get passenger count.
    $this->passengerCount = $this->values['adultCount'] + $this->values['childCount'];

    // Get the quote and the total.
    if (method_exists($this, 'getPaymentTransactions')) {
      $quote = $this->getQuote();
      $index = array_search(NULL, array_column($quote['paymentTransactions'], 'key'));
      $quote = $quote['paymentTransactions'][$index];
      $this->total = $quote['currencyAmounts'][0]['totalAmount'];
    }
  }

  /**
   * Get amounts.
   *
   * @return array
   *   The amounts.
   */
  protected function getAmounts() {
    // Calculate reservation costs.
    $amounts = [
      'cost' => 0,
      'fares' => 0,
      'fees' => 0,
      'taxes' => 0,
      'total' => 0,
    ];
    foreach (['departure_flight', 'arrival_flight'] as &$journey) {
      if (!empty($this->values[$journey])) {
        $booking_key_indexes = $this->getBookingKeyIndexes($this->values[$journey]);
        $this->updateAmounts($booking_key_indexes, $amounts);
      }
    }

    // Update fees and taxes amounts as they are per passenger.
    $amounts['fees'] = $amounts['fees'] * $this->passengerCount;
    $amounts['taxes'] = $amounts['taxes'] * $this->passengerCount;

    // Use the total from the quote.
    if (method_exists($this, 'getPaymentTransactions')) {
      $amounts['total'] = $this->total;
    }
    else {
      $amounts['total'] = $amounts['total'] * $this->passengerCount;

      // Update total with ancillary purchases.
      if ($this->values['ancillaryPurchasesTotal']) {
        $amounts['total'] += $this->values['ancillaryPurchasesTotal'];
      }

      // Update total with fuel charge for the number of infants included.
      if ($this->values['infantCount']) {
        $amounts['total'] += Charges::getFuelCharge() * $this->values['infantCount'];
      }
    }

    $amounts['cost'] = $amounts['total'] / $this->passengerCount;
    return $amounts;
  }

  /**
   * Get themed ticket.
   *
   * @return array
   *   Render array.
   */
  protected function getTicket() {
    // Prepare data.
    $defaults = Defaults::ticket();
    $values = array_merge($defaults, $this->values);
    $values = array_intersect_key($values, $defaults);
    $amounts = $this->getAmounts();

    return [
      '#theme' => 'ticket',
      '#flights' => $this->getFlights($values),
      '#guests' => $this->getGuests($values['adultCount'], $values['childCount'], $values['infantCount']),
      '#cost' => Currency::toPrice($amounts['cost'], Currency::US_CURRENCY_CODE),
      '#fees' => Currency::toPrice($amounts['fees'], Currency::US_CURRENCY_CODE),
      '#taxes' => Currency::toPrice($amounts['taxes'], Currency::US_CURRENCY_CODE),
      '#total' => Currency::toPrice($amounts['total'], Currency::US_CURRENCY_CODE),
    ];
  }

  /**
   * Update amounts.
   *
   * @param array $indexes
   *   The booking key indexes to use.
   * @param array $amounts
   *   The amounts to update.
   */
  protected function updateAmounts(array $indexes, array &$amounts) {
    $travel_options = $this->getTravelOptions();
    $fare_option = &$travel_options[$indexes[0]]['fareOptions'][$indexes[1]];
    if (isset($fare_option['fareCharges']) && !empty($fare_option['fareCharges'])) {
      foreach ($fare_option['fareCharges'] as &$charge) {
        foreach ($charge['currencyAmounts'] as &$amount) {
          if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
            if ($charge['chargeType']['code'] == Charges::FARE_CODE) {
              $amounts['fares'] += $amount['totalAmount'];
            }
            else {
              $amounts['fees'] += $amount['totalAmount'];
            }
            $amounts['taxes'] += $amount['taxAmount'];
            $amounts['total'] += $amount['totalAmount'];
          }
        }
      }
    }
  }

  /**
   * Get themed flights.
   *
   * @param array $values
   *   An array of values to populate the ticket with.
   *
   * @return array
   *   Render array.
   */
  protected function getFlights(array $values) {
    $build = [];
    $build[] = $this->getFlight($this->t('Departure'), $values['from'], $values['departure'], $values['arrival']);
    if ($values['isRoundtrip']) {
      $build[] = $this->getFlight($this->t('Return'), $values['to'], $values['arrival'], $values['departure']);
    }

    return $build;
  }

  /**
   * Get travel options.
   *
   * @param bool $refresh
   *   Option to refresh the travel options.
   *
   * @return array
   *   The travel options.
   */
  protected function getTravelOptions($refresh = FALSE) {
    static $travel_options;

    if (empty($travel_options) || $refresh) {
      $travel_options = $this->callEndpoint('getTravelOptions', [
        'cityPair' => $this->values['departure'] . '-' . $this->values['arrival'],
        'departure' => $this->values['from'],
        'return' => ($this->values['isRoundtrip'] && isset($this->values['to'])) ? $this->values['to'] : NULL,
        'cabinClass' => INTELIYSYS_ECONOMY_CLASS,
        'currency' => Currency::US_CURRENCY_CODE,
        'adultCount' => $this->values['adultCount'],
        'childCount' => $this->values['childCount'],
        'infantCount' => $this->values['infantCount'],
        'promoCode' => $this->values['promoCode'],
      ]);
    }

    return $travel_options;
  }

  /**
   * Get themed flight.
   *
   * @param string $title
   *   The section title.
   * @param string $date
   *   The flight date.
   * @param string $departure
   *   The departure airport.
   * @param string $arrival
   *   The arrival airport.
   *
   * @return array
   *   Render array.
   */
  protected function getFlight($title, $date, $departure, $arrival) {
    $all_airports = Locations::getAirportOptions();
    return [
      '#theme' => 'flight',
      '#title' => $title,
      '#date' => $date,
      '#from' => $all_airports[$departure],
      '#to' => $all_airports[$arrival],
    ];
  }

  /**
   * Get themed guests.
   *
   * @param int $adults
   *   The number of adults.
   * @param int $children
   *   The number of children.
   * @param int $infants
   *   The number of infants.
   *
   * @return array
   *   Render array.
   */
  protected function getGuests($adults, $children, $infants) {
    $items = [];

    if ($adults) {
      $items[] = $this->formatPlural($adults, '@count adult', '@count adults');
    }
    if ($children) {
      $items[] = $this->formatPlural($children, '@count child', '@count children');
    }
    if ($infants) {
      $items[] = $this->formatPlural($infants, '@count infant', '@count infants');
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
    ];
  }

}
