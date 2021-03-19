<?php

namespace Drupal\aco_edit_leg\Form;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_core\Traits\TempstoreTrait;
use Drupal\aco_edit_leg\Traits\EditLegTrait;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * Implements a select new leg select form.
 */
class SelectForm extends FormBase {
  use AddServiceTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use ReservationTrait;
  use TempstoreTrait;
  use EditLegTrait;

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
    return 'aco_edit_leg_select_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'select');

    // Check if the leg is canceled.
    $journey = &$this->reservation['journeys'][$this->editedLegIndex];
    if ($journey['reservationStatus']['cancelled']) {
      $form['description'] = [
        '#type' => 'container',
        '#markup' => $this->t('<p>You may not edit a canceled leg.</p>'),
      ];
      return $form;
    }

    $form['description'] = [
      '#type' => 'container',
      '#markup' => $this->t('<p>Reservation Number: @locator, Leg number: @leg</p>', [
        '@locator' => $this->reservation['locator'],
        '@leg' => $this->editedLegIndex + 1,
      ]),
    ];

    $this->getBookingFields($form, $form_state, $this->values);
    unset($form['from']['#ajax']);
    unset($form['to']);
    unset($form['adultCount']);
    unset($form['childCount']);
    unset($form['infantCount']);
    unset($form['promoCode']);
    unset($form['isRoundtrip']);

    end($journey['segments']);
    $last_key = key($journey['segments']);

    $time_format = DateFormat::load('short_time')->getPattern();
    $date_format = DateFormat::load('medium_date')->getPattern();

    $form['edited_leg'] = [
      '#theme' => 'table',
      '#attributes' => ['class' => ['table-detail', 'table-thirds']],
      '#header' => [
        $this->t('Date'),
        $this->t('From'),
        $this->t('To'),
      ],
      '#rows' => [
        [
          TimeHelper::getLocalTime($journey['segments'][0]['departure'], $date_format),
          $journey['segments'][0]['departure']['airport']['name'],
          $journey['segments'][$last_key]['arrival']['airport']['name'],
        ],
      ],
    ];

    $rows = [];
    foreach ($journey['segments'] as $segment_index => &$segment) {
      $flight_number = $segment['flight']['airlineCode']['code'] . $segment['flight']['flightNumber'];
      foreach ($segment['legs'] as &$leg) {
        $rows[] = [
          $flight_number,
          TimeHelper::getLocalTime($leg['departure'], $time_format) . ' ' . $leg['departure']['airport']['code'],
          TimeHelper::getLocalTime($leg['arrival'], $time_format) . ' ' . $leg['arrival']['airport']['code'],
        ];
      }
    }

    $form['edited_leg_segments'] = [
      '#theme' => 'table',
      '#attributes' => ['class' => ['table-detail', 'table-thirds']],
      '#header' => [
        $this->t('Flight'),
        $this->t('Departure'),
        $this->t('Arrival'),
      ],
      '#rows' => $rows,
    ];

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

    $values = $form_state->getValues();
    $this->values['departure'] = $values['departure'];
    $this->values['arrival'] = $values['arrival'];
    $this->values['from'] = $values['from'];
    $travel_options = $this->getTravelOptions();

    if (FALSE === $travel_options) {
      $form_state->setError($form, $this->t('An error occurred while retrieving your travel options. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    // Prevent the next step if there are no available travel options.
    elseif (empty($travel_options)) {
      $form_state->setError($form, $this->t('Sorry, there are no available flights for your search criteria. Please try again.'));
    }
    else {
      // Clear cached values on a new search.
      $form_state->setTemporaryValue('wizard', []);
      $this->clearTempstore();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
