<?php

namespace Drupal\aco_manage_flight\Controller;

use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Controller\ReservationController;

/**
 * A controller to display a charges summary.
 */
class ChargesController extends ReservationController {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * Returns a render-able array for a charges summary page.
   */
  public function build() {
    if ($output = parent::build()) {
      return $output;
    }

    $header = [
      'description' => $this->t('Description'),
      'amount' => $this->t('Amount'),
      'tax' => $this->t('Tax'),
      'total' => $this->t('Total'),
    ];

    $tables = [];
    foreach ($this->reservation['charges'] as &$charge) {
      $journey_key = $charge['journey']['key'];
      $passenger_key = $charge['passenger']['key'];
      if (!isset($tables[$journey_key])) {
        $tables[$journey_key] = [];
      }
      if (!isset($tables[$journey_key][$passenger_key])) {
        $tables[$journey_key][$passenger_key] = [
          'caption' => $this->getCaption($journey_key, $passenger_key),
          'rows' => [],
          'totals' => [
            'description' => $this->t('Totals:'),
            'amount' => 0,
            'tax' => 0,
            'total' => 0,
          ],
        ];
      }
      $totals = &$tables[$journey_key][$passenger_key]['totals'];
      foreach ($charge['currencyAmounts'] as &$amount) {
        if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
          $tables[$journey_key][$passenger_key]['rows'][] = [
            'description' => $charge['description'],
            'amount' => Currency::toPrice($amount['baseAmount']),
            'tax' => Currency::toPrice($amount['taxAmount']),
            'total' => Currency::toPrice($amount['totalAmount']),
          ];
          $totals['amount'] += $amount['baseAmount'];
          $totals['tax'] += $amount['taxAmount'];
          $totals['total'] += $amount['totalAmount'];
        }
      }
    }

    foreach ($tables as &$journey) {
      foreach ($journey as &$table) {
        $table['totals']['amount'] = Currency::toPrice($table['totals']['amount']);
        $table['totals']['tax'] = Currency::toPrice($table['totals']['tax']);
        $table['totals']['total'] = Currency::toPrice($table['totals']['total']);
        $build[] = [
          '#cache' => ['max-age' => 0],
          '#theme' => 'table',
          '#attributes' => ['class' => ['charges-summary-table']],
          '#caption' => $table['caption'],
          '#header' => $header,
          '#rows' => $table['rows'],
          '#footer' => [$table['totals']],
        ];
      }
    }

    return $build;
  }

  /**
   * Get caption.
   */
  private function getCaption($journey_key, $passenger_key) {
    $leg = '';
    $name = '';
    $from = '';
    $to = '';

    foreach ($this->reservation['journeys'] as $key => &$journey) {
      if ($journey_key == $journey['key']) {
        $leg = $key + 1;
        $from = $journey['segments'][0]['departure']['airport']['name'];
        end($journey['segments']);
        $last_key = key($journey['segments']);
        $to = $journey['segments'][$last_key]['arrival']['airport']['name'];
        break;
      }
    }

    foreach ($this->reservation['passengers'] as &$passenger) {
      if ($passenger_key == $passenger['key']) {
        $name = $this->t('@last, @first', [
          '@last' => $passenger['reservationProfile']['lastName'],
          '@first' => $passenger['reservationProfile']['firstName'],
        ]);
        break;
      }
    }

    return $this->t('@name (Leg: @leg, From: @from, To: @to)', [
      '@name' => $name,
      '@leg' => $leg,
      '@from' => $from,
      '@to' => $to,
    ]);
  }

}
