<?php

namespace Drupal\aco_book_flight\Controller;

use Drupal\Core\Url;
use Drupal\aco_core\Controller\ReservationController;
use Drupal\aco_core\Traits\ItineraryTrait;

/**
 * A confirmed itinerary controller.
 */
class ConfirmedItineraryController extends ReservationController {
  use ItineraryTrait;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * Returns a render-able array for a confirmed itinerary page.
   */
  public function build() {
    if ($output = parent::build()) {
      return $output;
    }

    return [
      '#cache' => ['max-age' => 0],
      '#theme' => 'confirmed_itinerary',
      '#reservation_number' => $this->reservation['locator'],
      '#authorization_number' => $this->reservation['paymentTransactions'][0]['paymentMethodCriteria']['creditCard']['transaction']['authorization'],
      '#trip_details' => $this->getTripDetails($this->reservation['journeys']),
      '#charge_summary' => $this->getChargeSummary($this->reservation['charges']),
      '#contact_information' => $this->getReservationOwnerContactInformation($this->reservation['passengers']),
      '#actions' => [
        [
          '#theme' => 'item_list',
          '#items' => [
            [
              '#type' => 'link',
              '#title' => $this->t('Print'),
              '#url' => Url::fromRoute('<current>'),
              '#attributes' => [
                'onclick' => 'javascript:window.print();return false',
              ],
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Book Another Flight'),
              '#url' => Url::fromRoute('aco_book_flight.book_flight'),
            ],
          ],
        ],
      ],
    ];
  }

}
