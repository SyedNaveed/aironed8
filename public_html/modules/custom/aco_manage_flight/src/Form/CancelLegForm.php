<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\intelisys\Utility\Charges;
use Drupal\intelisys\Utility\Currency;
use Drupal\intelisys\Utility\TimeHelper;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements a cancel leg confirmation form.
 */
class CancelLegForm extends ConfirmFormBase {
  use IntelisysTrait;
  use ReservationTrait;

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
    return 'aco_manage_flight_cancel_leg_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Cancel Leg');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('<p><strong>Reservation Number: @locator</strong></p>', [
      '@locator' => $this->reservation['locator'],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $form['#cache'] = ['max-age' => 0];
    $is_leg_active = FALSE;
    $leg_index = $this->getRequest()->getSession()->get('leg_index');
    if (is_numeric($leg_index)) {
      $form_state->set('leg_index', $leg_index);

      // Check if the leg is active.
      $journey = &$this->reservation['journeys'][$leg_index];
      if ($this->isJourneyActive($journey)) {
        $is_leg_active = TRUE;
      }
    }

    if ($is_leg_active) {
      end($journey['segments']);
      $last_key = key($journey['segments']);
      $time_format = DateFormat::load('time')->getPattern();
      $date_format = DateFormat::load('medium_date')->getPattern();

      $form['body'] = ['#type' => 'container'];
      $form['body']['cancel'] = [
        '#markup' => $this->t('<p>Canceling Leg Number: @leg</p>', [
          '@leg' => $leg_index + 1,
        ]),
      ];
      $form['body']['leg'] = [
        '#theme' => 'table',
        '#rows' => [
          [
            $this->t('From: @airport', [
              '@airport' => $journey['departure']['airport']['name'],
            ]),
            $this->t('To: @airport', [
              '@airport' => $journey['segments'][$last_key]['arrival']['airport']['name'],
            ]),
          ],
          [
            $this->t('Date: @date', [
              '@date' => TimeHelper::getLocalTime($journey['departure'], $date_format),
            ]),
            $this->t('Flight: @airline@flight', [
              '@airline' => $journey['segments'][0]['flight']['airlineCode']['code'],
              '@flight' => $journey['segments'][0]['flight']['flightNumber'],
            ]),
          ],
          [
            $this->t('Departure: @time @airport_code', [
              '@time' => TimeHelper::getLocalTime($journey['departure'], $time_format),
              '@airport_code' => $journey['departure']['airport']['code'],
            ]),
            $this->t('Arrival: @time @airport_code', [
              '@time' => TimeHelper::getLocalTime($journey['segments'][$last_key]['arrival'], $time_format),
              '@airport_code' => $journey['segments'][$last_key]['arrival']['airport']['code'],
            ]),
          ],
        ],
      ];

      // Get current charges.
      $current_leg_charges = 0;
      foreach ($this->reservation['charges'] as &$charge) {
        if ($charge['journey']['key'] == $journey['key']) {
          foreach ($charge['currencyAmounts'] as &$amount) {
            if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
              $current_leg_charges += $amount['totalAmount'];
            }
          }
        }
      }

      $form['body']['current_charges'] = [
        '#theme' => 'table',
        '#caption' => $this->t('Current Charges'),
        '#rows' => [
          [
            $this->t('Current Leg Charges:'),
            Currency::toPrice($current_leg_charges, Currency::US_CURRENCY_CODE),
          ],
        ],
      ];

      // Get leg cancellation quote.
      $reservation = $this->getReservation();
      $journeys = $reservation['journeys'];
      $journeys[$leg_index]['reservationStatus'] = [
        'cancelled' => TRUE,
        'open' => FALSE,
        'finalized' => FALSE,
        'external' => FALSE,
      ];
      $quote = $this->callEndpoint('putQuotations', [
        'httpMethod' => 'PUT',
        'requestUri' => "/reservations/{$this->reservation['key']}/journeys/{$journey['key']}",
        'journeys' => $journeys,
      ]);

      // Get cancellation charges.
      $cancellation_charges = [
        'cancelation' => 0,
        'taxes' => 0,
        'non-refundable' => 0,
        'total' => 0,
      ];
      foreach ($quote['charges'] as &$charge) {
        if ($charge['journey']['key'] == $journey['key']
          && $charge['chargeType']['code'] == Charges::CANCELLATION_CODE
        ) {
          foreach ($charge['currencyAmounts'] as &$amount) {
            if (Currency::US_CURRENCY_CODE == $amount['currency']['code']) {
              $cancellation_charges['cancelation'] += $amount['baseAmount'];
              $cancellation_charges['taxes'] += $amount['taxAmount'];
              // @todo Not sure how to get non-refundable amount. The training
              // API site never has a value for this so assume zero for now.
              $cancellation_charges['total'] += $amount['totalAmount'];
            }
          }
        }
      }

      $form['body']['cancellation_charges'] = [
        '#theme' => 'table',
        '#caption' => $this->t('Cancellation Charges'),
        '#rows' => [
          [
            $this->t('Cancellation:'),
            Currency::toPrice($cancellation_charges['cancelation'], Currency::US_CURRENCY_CODE),
          ],
          [
            $this->t('Taxes:'),
            Currency::toPrice($cancellation_charges['taxes'], Currency::US_CURRENCY_CODE),
          ],
          [
            $this->t('Non-Refundable:'),
            Currency::toPrice($cancellation_charges['non-refundable'], Currency::US_CURRENCY_CODE),
          ],
          [
            $this->t('<strong>Total charges:</strong>'),
            Currency::toPrice($cancellation_charges['total'], Currency::US_CURRENCY_CODE),
          ],
        ],
      ];
      $form['body']['confirm'] = [
        '#markup' => $this->t('<p>Please confirm cancellation.</p>'),
      ];
    }
    else {
      $form['description'] = [
        '#markup' => $this->t('<p>Please select an active leg to cancel.</p>'),
      ];
      unset($form['actions']['submit']);
      $form['actions']['cancel']['#title'] = $this->t('View Reservation');
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('I Agree');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return $this->t('I Decline');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('aco_manage_flight.reservation');
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $result = FALSE;
    $leg_index = $form_state->get('leg_index');

    // Cancel the leg.
    if (is_numeric($leg_index)) {
      $journey = &$this->reservation['journeys'][$leg_index];
      if ($this->isJourneyActive($journey)) {
        $result = $this->callEndpoint('putReservationJourney', [
          'reservationKey' => $this->reservation['key'],
          'journeyKey' => $journey['key'],
          'index' => $leg_index + 1,
          'reservationStatus' => [
            'cancelled' => TRUE,
            'open' => FALSE,
            'finalized' => FALSE,
            'external' => FALSE,
          ],
        ]);
      }
    }

    if (FALSE === $result) {
      $form_state->setError($form, $this->t('An error occurred while attempting to cancel your selected leg. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The selected leg has been canceled.'));
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
