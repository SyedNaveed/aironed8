<?php

namespace Drupal\aco_book_flight\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\intelisys\Utility\Charges;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Symfony\Component\HttpFoundation\Request;

/**
 * A controller to display a charges summary.
 */
class ChargesController extends ControllerBase {
  use IntelisysTrait;
  use ReservationTrait;

  /**
   * Returns a render-able array for a charges summary page.
   */
  public function build($option_index, $fare_index, Request $request) {
    $caption = $this->t('The Fares and Charges on this page reflect the charges per individual passenger. The “Total to be applied” is the total amount for all passengers.');

    $header = [
      'description' => $this->t('Description'),
      'amount' => $this->t('Amount'),
    ];

    $return = $request->query->get('return');
    $adult_count = intval($request->query->get('adultCount'));
    $child_count = intval($request->query->get('childCount'));
    $infant_count = intval($request->query->get('infantCount'));
    $options = [
      'cityPair' => $request->query->get('cityPair'),
      'departure' => $request->query->get('departure'),
      'return' => empty($return) ? NULL : $return,
      'cabinClass' => INTELIYSYS_ECONOMY_CLASS,
      'currency' => Currency::US_CURRENCY_CODE,
    ];

    // Count GET parameters indicate this is a book flight request.
    if ($adult_count || $child_count) {
      $options['adultCount'] = $adult_count;
      $options['childCount'] = $child_count;
      $options['infantCount'] = $infant_count;
      $options['promoCode'] = $request->query->get('promoCode');
    }
    // No count parameters indicate the request is part of a reservation (either
    // edit or add leg).
    else {
      $this->reservation = $this->getReservation();
      if ($this->reservation) {
        $counts = $this->getPassengerCounts();
        $adult_count = $counts['adultCount'];
        $child_count = $counts['childCount'];
        $infant_count = $counts['infantCount'];
        $options['reservation'] = $this->reservation['key'];
        if ($request->query->has('journeyIndex')) {
          $journey_index = $request->query->get('journeyIndex');
          $options['journey'] = $this->reservation['journeys'][$journey_index]['key'];
        }
      }
    }

    $travel_options = $this->callEndpoint('getTravelOptions', $options);

    $rows = [];
    $total = 0;
    if ($travel_options && isset($travel_options[$option_index]) && isset($travel_options[$option_index]['fareOptions'][$fare_index])) {
      foreach ($travel_options[$option_index]['fareOptions'][$fare_index]['fareCharges'] as &$charge) {
        foreach ($charge['currencyAmounts'] as &$amount) {
          if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
            // If this is the fare then include the FET Tax as a new row.
            if ($charge['chargeType']['code'] == Charges::FARE_CODE && $amount['taxAmount']) {
              $rows[] = [
                $charge['description'],
                Currency::toPrice($amount['baseAmount']),
              ];
              $rows[] = [
                $this->t('FET :percentage%', [
                  ':percentage' => Charges::FET_TAX_PERCENTAGE * 100,
                ]),
                Currency::toPrice($amount['taxAmount']),
              ];
            }
            else {
              $rows[] = [
                $charge['description'],
                Currency::toPrice($amount['totalAmount']),
              ];
            }

            $total += $amount['totalAmount'];
          }
        }
      }
    }

    // Update total by the number of passengers.
    $total = $total * ($adult_count + $child_count);

    // Update total with fuel charge for the number of infants included.
    if ($infant_count) {
      $total += Charges::getFuelCharge() * $infant_count;
    }

    $totals = [
      $this->t('Total to be applied to Credit Card:'),
      Currency::toPrice($total),
    ];

    return [
      '#cache' => ['max-age' => 0],
      '#theme' => 'table',
      '#attributes' => ['class' => ['charges-summary-table']],
      '#caption' => $caption,
      '#header' => $header,
      '#rows' => $rows,
      '#footer' => [$totals],
    ];
  }

}
