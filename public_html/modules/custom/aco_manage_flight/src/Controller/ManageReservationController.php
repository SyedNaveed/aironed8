<?php

namespace Drupal\aco_manage_flight\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;
use Drupal\Core\Render\Markup;
use Drupal\Core\Template\Attribute;
use Drupal\Component\Utility\Html;
use Drupal\intelisys\Utility\Currency;
use Drupal\aco_core\Controller\ReservationController;

/**
 * A manage reservation controller.
 */
class ManageReservationController extends ReservationController {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * Page title callback.
   */
  public function getTitle() {
    return $this->t('Manage Reservation @locator', [
      '@locator' => $this->reservation['locator'],
    ]);
  }

  /**
   * Returns a render-able array for a manage reservation page.
   */
  public function build() {
    if ($output = parent::build()) {
      return $output;
    }

    // Handle canceled reservations.
    if (NULL == \Drupal::request()->query->get('force_view') && $this->canceled) {
      return $this->buildCanceled();
    }

    $booking_info = &$this->reservation['bookingInformation'];
    $total_charges = $this->getTotalCharges();
    $total_payments = $this->getTotalPayments();

    $build = [
      '#cache' => ['max-age' => 0],
      '#theme' => 'manage_reservation',
      '#description' => $this->getDescription(),
      '#sections' => [
        [
          'title' => $this->t('Passenger Details'),
          'attributes' => new Attribute(),
          'content' => \Drupal::formBuilder()->getForm('Drupal\aco_manage_flight\Form\SelectPassengerForm'),
        ],
        [
          'title' => $this->t('Reservation Contact Information'),
          'attributes' => new Attribute(['class' => ['reservation_contact_information']]),
          'content' => [
            'contact_information' => [
              '#theme' => 'table',
              '#header' => [
                'name' => $this->t('Name'),
                'phone' => $this->t('Phone'),
                'email' => $this->t('Email'),
              ],
              '#rows' => [
                [
                  'name' => $booking_info['contactInformation']['name'],
                  'phone' => $booking_info['contactInformation']['phoneNumber'],
                  'email' => $booking_info['contactInformation']['email'],
                ],
              ],
            ],
            'notes' => [
              '#theme' => 'table',
              '#header' => [
                $this->t('Notes'),
              ],
              '#rows' => empty($booking_info['notes']) ? [] : [
                'data' => [
                  '#markup' => Markup::create(nl2br(Html::escape($booking_info['notes']))),
                ],
              ],
              '#empty' => $this->t('No notes currently posted.'),
            ],
          ],
          'actions' => [
            '#theme' => 'item_list',
            '#items' => [
              [
                '#type' => 'link',
                '#title' => $this->t('Edit Information'),
                '#url' => Url::fromRoute('aco_manage_flight.reservation.edit_contact_information'),
              ],
            ],
          ],
        ],
        [
          'title' => $this->t('Charge Summary'),
          'attributes' => new Attribute(),
          'content' => [
            '#theme' => 'table',
            '#rows' => [
              [
                'title' => $this->t('Total Charges'),
                'amount' => Currency::toPrice($total_charges, Currency::US_CURRENCY_CODE),
              ], [
                'title' => $this->t('Total Payments'),
                'amount' => Currency::toPrice($total_payments, Currency::US_CURRENCY_CODE),
              ], [
                'title' => $this->t('Balance Due'),
                'amount' => Currency::toPrice($total_charges - $total_payments, Currency::US_CURRENCY_CODE),
              ],
            ],
          ],
          'actions' => [
            '#theme' => 'item_list',
            '#items' => [
              [
                '#type' => 'link',
                '#title' => $this->t('Display Charges'),
                '#url' => Url::fromRoute('aco_manage_flight.reservation.charge_summary'),
                '#attributes' => [
                  'class' => ['use-ajax'],
                  'data-dialog-type' => 'modal',
                  'data-dialog-options' => Json::encode([
                    'width' => 700,
                  ]),
                ],
              ],
            ],
          ],
        ],
        [
          'title' => $this->t('Reservation'),
          'attributes' => new Attribute(),
          'content' => \Drupal::formBuilder()->getForm('Drupal\aco_manage_flight\Form\SelectLegForm'),
        ],
      ],
      '#actions' => [
        [
          '#theme' => 'item_list',
          '#items' => [
            [
              '#type' => 'link',
              '#title' => $this->t('New Search'),
              '#url' => Url::fromRoute('aco_manage_flight.manage_flight'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Email Itinerary'),
              '#url' => Url::fromRoute('aco_manage_flight.reservation.itinerary.email'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('View Itinerary'),
              '#url' => Url::fromRoute('aco_manage_flight.reservation.itinerary'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Book Another Flight'),
              '#url' => Url::fromRoute('aco_book_flight.book_flight'),
            ],
          ],
        ],
        [
          '#theme' => 'item_list',
          '#items' => [
            [
              '#type' => 'link',
              '#title' => $this->t('Add-On Services'),
              '#url' => Url::fromRoute('aco_add_services.form_wizard', [
                'step' => 'select',
              ]),
            ],
          ],
        ],
      ],
    ];

    return $build;
  }

  /**
   * View a canceled reservation.
   */
  private function buildCanceled() {
    return [
      '#cache' => ['max-age' => 0],
      '#theme' => 'manage_reservation',
      '#sections' => [
        [
          'title' => $this->t('Reservation Number: @locator', ['@locator' => $this->reservation['locator']]),
          'content' => [
            '#markup' => $this->t('<p>All legs of reservation @locator have been canceled.</p><p><strong>All segments on this reservation have been canceled.</strong></p>', ['@locator' => $this->reservation['locator']]),
          ],
        ],
      ],
      '#actions' => [
        [
          '#theme' => 'item_list',
          '#items' => [
            [
              '#type' => 'link',
              '#title' => $this->t('View Reservation'),
              '#url' => Url::fromRoute('aco_manage_flight.reservation', [], [
                'query' => ['force_view' => 1],
              ]),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('New Search'),
              '#url' => Url::fromRoute('aco_manage_flight.manage_flight'),
            ],
            [
              '#type' => 'link',
              '#title' => $this->t('Book Flight'),
              '#url' => Url::fromRoute('aco_book_flight.book_flight'),
            ],
          ],
        ],
      ],
    ];
  }

  /**
   * Get description.
   */
  private function getDescription() {
    $build = [];
    if ($this->expired) {
      $build = [
        '#markup' => $this->t('<p>The editing functionality has been removed due to the following reason(s):<br><strong>This reservation contains an expired leg.</strong></p>'),
      ];
    }
    return $build;
  }

}
