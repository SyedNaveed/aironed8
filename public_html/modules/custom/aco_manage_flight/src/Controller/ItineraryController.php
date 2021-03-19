<?php

namespace Drupal\aco_manage_flight\Controller;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Template\Attribute;
use Drupal\Core\Url;
use Drupal\aco_core\Controller\ReservationController;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * A controller to display a reservation itinerary.
 */
class ItineraryController extends ReservationController {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * Returns a render-able array for a reservation itinerary page.
   */
  public function build() {
    if ($output = parent::build()) {
      return $output;
    }

    $header = [
      $this->t('Flight #'),
      $this->t('Departure Airport'),
      $this->t('Scheduled'),
      $this->t('Arrival Airport'),
      $this->t('Scheduled'),
    ];

    // Generate itinerary.
    $itinerary = [];
    $date_format = DateFormat::load('time')->getPattern();
    foreach ($this->reservation['journeys'] as $key => &$journey) {
      $leg_number = $key + 1;
      $from = $journey['segments'][0]['departure']['airport']['name'];
      end($journey['segments']);
      $last_key = key($journey['segments']);
      $to = $journey['segments'][$last_key]['arrival']['airport']['name'];

      // Only used for sorting. Timezone alteration is not needed here.
      $actual_departure_time = strtotime($journey['segments'][0]['departure']['scheduledTime']);
      $actual_arrival_time = strtotime($journey['segments'][0]['arrival']['scheduledTime']);

      $table = [
        'canceled' => $journey['reservationStatus']['cancelled'],
        'actual_departure' => $actual_departure_time,
        'actual_arrival' => $actual_arrival_time,
        '#theme' => 'table',
        '#caption' => [
          '@from' => $from,
          '@to' => $to,
          '@canceled' => $journey['reservationStatus']['cancelled'] ? $this->t('(Canceled)') : '',
        ],
        '#header' => $header,
      ];

      $rows = [];
      foreach ($journey['segments'] as &$segment) {
        $flight_number = $segment['flight']['airlineCode']['code'] . $segment['flight']['flightNumber'];
        foreach ($segment['legs'] as &$leg) {
          $rows[] = [
            $flight_number,
            $leg['departure']['airport']['name'],
            TimeHelper::getLocalTime($leg['departure'], $date_format),
            $leg['arrival']['airport']['name'],
            TimeHelper::getLocalTime($leg['arrival'], $date_format),
          ];
        }
      }

      $table['#rows'] = $rows;
      $itinerary[] = $table;
    }

    // Sort legs.
    usort($itinerary, '_aco_core_sort_flights');

    // Prepare rows for output.
    foreach ($itinerary as $key => &$leg) {
      $leg['#caption'] = $this->t('Leg: @leg_number, From: @from, To: @to @canceled', [
        '@leg_number' => $key + 1,
      ] + $leg['#caption']);

      // Remove sorting columns.
      unset($leg['canceled']);
      unset($leg['actual_departure']);
      unset($leg['actual_arrival']);
    }

    $build = [
      '#cache' => ['max-age' => 0],
      '#theme' => 'manage_reservation',
      '#sections' => [
        [
          'title' => $this->t('Reservation @locator Itinerary', [
            '@locator' => $this->reservation['locator'],
          ]),
          'attributes' => new Attribute(['class' => ['reservation_itinerary_page']]),
          'content' => $itinerary,
        ],
      ],
      '#actions' => [
        [
          '#theme' => 'item_list',
          '#items' => [
            [
              '#type' => 'link',
              '#title' => $this->t('View Reservation'),
              '#url' => Url::fromRoute('aco_manage_flight.reservation'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Email Itinerary'),
              '#url' => Url::fromRoute('aco_manage_flight.reservation.itinerary.email'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Print'),
              '#url' => Url::fromRoute('<current>'),
              '#attributes' => [
                'onclick' => 'javascript:window.print();return false',
              ],
            ],
          ],
        ],
      ],
    ];

    return $build;
  }

}
